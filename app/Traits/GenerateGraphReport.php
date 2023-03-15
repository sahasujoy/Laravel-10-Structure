<?php

namespace App\Traits;

use App\Helpers\ResponseHelper;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

trait GenerateGraphReport
{
    public function getGraphReportData($response,$fromDate,$durationType,$difference,$columnArray)
    {
        try {
            $theTime = DateTime::createFromFormat('Y-m-d', $fromDate); // from date = current date of last month

            $dataCount = 0;
            $labelFormat = $this->getLabelFormat($durationType); //Which format we just need to assign on label. //d-M
            $formatForTimeFramed = $this->getTimeFramedFormat($durationType); //Date format what comes from db. // Y-n-j
            $modify = $this->getModifyValue($durationType); //How much we increasing // +1 day

            for ($i = 0; $i < $difference; $i++) {

                $theTime->format($labelFormat); // 19-Jul
                $timeFramedFormat = $theTime->format($formatForTimeFramed); // 2021-07-19

                if (isset($response[$dataCount]) && $response[$dataCount]['time_frame'] == $timeFramedFormat) {
                    foreach ($columnArray as $column) {
                        $data[$column][]= $response[$dataCount][$column];
                    }

                    $data['date_format'][] = $theTime->format($labelFormat);

                    $dataCount++;
                } else {
                    $data['date_format'][] = $theTime->format($labelFormat);
                    foreach ($columnArray as $column) {
                        $data[$column][] = 0;
                    }
                }
                $theTime->modify($modify);
            }

            return $data;

        } catch (\Exception $e) {
            Log::error('Error in getGraphReportData', [$e->getMessage(), $e->getLine()]);
            return ResponseHelper::sendError(Response::HTTP_UNPROCESSABLE_ENTITY, 'Generate graph data failed');
        }
    }

    public function getDuration($type): int
    {
        return match ($type) {
            'hour' => 24,
            'week' => 7,
            'day' => 30,
            'month' => 12,
            default => 10,
        };
    }

    public function getFormattedFromDateToDate($fromDate, $toDate, $durationType = 'week', $difference = 7, $singleDate = null): array
    {
        if ($difference != null) {
            if ($singleDate != null) {
                $singleDate = $this->changeFormat($singleDate);
                $fromDate = $singleDate;
                $toDate = $singleDate;
            } else if ($fromDate != null && $toDate != null) {
                $fromDate = $this->changeFormat($fromDate);
                $toDate = $this->changeFormat($toDate);
            } else {
                $fromDate = $this->fromDate($durationType);
                $toDate = $this->toDate($durationType, $fromDate);
            }
        } else {
            $fromDate = $this->fromDate($durationType);  // 2021-07-19 00:00:00
            $toDate = $this->toDate($durationType, $fromDate); // 2021-08-17 23:59:59
        }

        return array($fromDate, $toDate);
    }

    public function changeFormat($dateString): ?string
    {
        if ($dateString != null) {
            $date = Carbon::parse($dateString);
            return $date->format('Y-m-d');
        }
        return null;
    }

    public function fromDate($type)
    {
        if ($type == 'hour') {
            $date = (new \DateTime())->modify('-23 hour');
            $dateString = $date->format('Y-m-d H');
            $date = DateTime::createFromFormat('Y-m-d H', $dateString);

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'week') {
            $date = (new \DateTime())->modify('-6 day');
            $dateString = $date->format('Y-m-d');
            $dateString .= ' 00:00:00';
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'day') {
            $date = (new \DateTime())->modify('-29 day');
            $dateString = $date->format('Y-m-d');
            $dateString .= ' 00:00:00';
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'month') {
            $date = (new \DateTime())->modify('-11 month');
            $dateString = $date->format('Y-m');
            $dateString .= '-1 00:00:00';
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'year') {
            $date = (new \DateTime())->modify('-10 year');
            $dateString = $date->format('Y-m');
            $dateString .= '-1 00:00:00';
            $date = DateTime::createFromFormat('Y', $dateString);

            return $date->format('Y');
        }
    }

    public function toDate($type, $fromDate)
    {
        if ($type == 'hour') {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $fromDate);
            $date = $date->modify('+24 hour');

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'week') {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $fromDate);
            $date = $date->modify('+7 day');
            $date = $date->modify('-1 second');

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'month') {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $fromDate);
            $date = $date->modify('+30 day');
            $date = $date->modify('-1 second');

            return $date->format('Y-m-d H:i:s');
        } else if ($type == 'year') {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $fromDate);
            $date = $date->modify('+12 month');
            $date = $date->modify('-1 second');

            return $date->format('Y-m-d H:i:s');
        }
    }

    public function setAndGetDifferenceAndDurationTYpe($difference): array
    {
        $durationType = "";
        if ($difference > 0 and $difference <= 7) {
            $durationType = "week";
            $difference = 7;
        } elseif ($difference > 7 and $difference <= 30) {
            $durationType = "day";
            $difference = 30;
        } elseif ($difference > 30 and $difference <= 365) {
            $durationType = "month";
            $difference = 12;
        } elseif ($difference > 365) {
            $durationType = "year";
            $difference = 10;
        }

        return array($durationType, $difference);
    }

    public function getLabelFormat($type): string
    {
        return match ($type) {
            'hour' => 'g a',
            'week' => 'D',
            'day' => 'd-M',
            'month' => 'M-Y',
            default => 'y',
        };
    }

    public function getTimeFramedFormat($type): string
    {
        return match ($type) {
            'hour' => 'Y-n-j-G',
            'day' => 'Y-m-d',
            'month' => 'Y-m',
            'week' => 'Y-n-j',
            default => 'Y',
        };
    }

    public function getModifyValue($type): string
    {
        return match ($type) {
            'hour' => '+1 hour',
            'day', 'week' => '+1 day',
            'month' => '+1 month',
            default => '+1 year',
        };
    }
}
