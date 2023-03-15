<?php

namespace App\Services;


use App\Contracts\Repositories\ProcessOverallStateCountDailyRepository;
use App\Contracts\Services\AdminDashboardContract;
use App\Helpers\Helper;
use App\Traits\GenerateGraphReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardService implements AdminDashboardContract
{
    use GenerateGraphReport;

    /**
     * Get Dashborad State Count Data
     * @param Request $request
     * @return array
     */
    public function getDashboardStateDataCountReport(Request $request)
    {
        try {

            $selectArray = [
                'total_project', 'total_user', 'total_notification'
            ];

            $selectRawQueryString = "SUM(" . $selectArray[0] . ") as " . $selectArray[0] . ",
                 SUM(" . $selectArray[1] . ") as " . $selectArray[1] . ",
                 SUM(" . $selectArray[2] . ") as " . $selectArray[2];

            $where = [];
            if (isset($request->user_id) and !empty($request->user_id)) {
                $where = [
                    'user_id' => $request->user_id,
                ];
            }

            $fromDate = $this->changeFormat($request->from_date);
            $toDate = $this->changeFormat($request->to_date);

            // Query request for graph data
            $responseData = App::make(ProcessOverallStateCountDailyRepository::class)->getAllUserOverallCount($where, $fromDate, $toDate, $selectRawQueryString);
            $data = [];
            if ($responseData) {

                $total_project = isset($responseData->total_project) ? $responseData->total_project : 0;
                $total_user = isset($responseData->total_user) ? $responseData->total_user : 0;
                $total_notification = isset($responseData->total_notification) ? $responseData->total_notification : 0;

                $data['total_project'] = $total_project;
                $data['total_user'] = $total_user;
                $data['total_notification'] = $total_notification;

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Count report data found', $data,);
            } else {
                $data['total_project'] = 0;
                $data['total_user'] = 0;
                $data['total_notification'] = 0;

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Count report data found', $data,);
            }

        } catch (\Exception $e) {
            Log::error('Error in getUserDataGraphReport', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNPROCESSABLE_ENTITY,'Count report data not found');
        }
    }


}
