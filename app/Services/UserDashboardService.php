<?php

namespace App\Services;


use App\Contracts\Repositories\ProcessOverallStateCountDailyRepository;
use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Services\UserDashboardContract;
use App\Enums\UserBalanceEnum;
use App\Helpers\Helper;
use App\Helpers\ResponseHelper;
use App\Traits\GenerateGraphReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserDashboardService implements UserDashboardContract
{
    use GenerateGraphReport;

    /**
     * Get user graph data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserDataGraphReport(Request $request)
    {
        try {
            $dateDurationType = $request['duration_type'];
            $singleDate = $request['singleDate'];
            $firstDate = $request['from_date'];
            $secondDate = $request['to_date'];
            $dayDifference = $request['difference'];

            $selectArray = [
                'total_process_image', 'total_clean_image'
            ];

            $selectRawQueryString = "SUM(" . $selectArray[0] . ") as " . $selectArray[0] . ",
                 SUM(" . $selectArray[1] . ") as " . $selectArray[1];

            $where = [
                'user_id' => $request['user_id']
            ];

            // Duration type : day,week,month,year . Difference : Difference between selected days
            list($dateDurationType, $dayDifference) = $this->setAndGetDifferenceAndDurationTYpe($request['difference']);
            // Format from_date ,to_date based on $dateDurationType and $difference
            list($fromDate, $toDate) = $this->getFormattedFromDateToDate($firstDate, $secondDate, $dateDurationType, $dayDifference, $singleDate);

            // Query request for graph data
            $response = App::make(ProcessOverallStateCountDailyRepository::class)->getGraphDataByConditionAndBetweenDate($where, $dateDurationType, $fromDate, $toDate, $selectRawQueryString);

            // Generate a graph report array based on $dateDurationType,$difference,$selectArray using GenerateGraphReport.php trait
            $graphReport = $this->getGraphReportData($response,$fromDate,$dateDurationType,$dayDifference,$selectArray);


            if ($graphReport) {
                return ResponseHelper::sendResponse($graphReport,'Graph report data found',Response::HTTP_OK,  );
            }

            return ResponseHelper::sendError('Graph report data not found',Response::HTTP_BAD_REQUEST, );

        } catch (\Exception $e) {
            Log::error('Error in getUserDataGraphReport', [$e->getMessage(), $e->getLine()]);

            return ResponseHelper::sendError(Response::HTTP_UNPROCESSABLE_ENTITY, 'Graph report data not found');
        }
    }

    public function getDailyTotalLimitAndUsagesData(Request $request)
    {
        try {

            $select = ['balance', 'current_balance'];
            $where = ['balance_key' => UserBalanceEnum::from(1)->value, 'user_id' => $request->user_id];//daily
            $responseData = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($select, $where);
            $data['total_limit'] = 0;
            $data['total_usages'] = 0;
            $data['percentage'] = 0;
            if ($responseData) {

                $data['total_limit'] = $responseData->balance;
                $usages = ($responseData->balance - $responseData->current_balance);
                $data['total_usages'] = $usages;

                $percentageData = 0;
                if($data['total_usages'] > 0){
                    $percentageData = (($data['total_usages']/ $responseData->balance ) * 100);
                }

                $data['percentage'] = number_format((float)$percentageData, 0 , '.', '');

            }
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Get percentage data found', $data);

        } catch (\Exception $e) {
            Log::error('error in getTotalCleanAndProcessImageDifferenceWithPercentage', [$e->getMessage(), $e->getLine()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Get User wise count report Failed');
        }
    }

    public function getMonthlyTotalLimitAndUsagesData(Request $request)
    {
        try {

            $select = ['balance', 'current_balance'];
            $where = ['balance_key' => UserBalanceEnum::from(2)->value,  'user_id' => $request->user_id];//monthly
            $responseData = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($select, $where);
            $data['total_limit'] = 0;
            $data['total_usages'] = 0;
            $data['percentage'] = 0;


            if ($responseData) {

                $data['total_limit'] = $responseData->balance;
                $usages = ($responseData->balance - $responseData->current_balance);
                $data['total_usages'] = $usages;

                $percentageData = 0;
                if($data['total_usages'] > 0){
                    $percentageData = (( $data['total_usages'] / $responseData->balance ) * 100);
                }
                $data['percentage'] = number_format((float)$percentageData, 0 , '.', '');


            }
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Get percentage data found', $data);


        } catch (\Exception $e) {
            Log::error('error in getTotalCleanAndProcessImageDifferenceWithPercentage', [$e->getMessage(), $e->getLine()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Get User wise count report Failed');
        }
    }

}
