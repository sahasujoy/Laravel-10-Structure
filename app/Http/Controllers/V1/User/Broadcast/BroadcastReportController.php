<?php

namespace App\Http\Controllers\V1\User\Broadcast;

use App\Contracts\Services\BroadcastContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BroadcastReportController extends Controller
{
    private BroadcastContract $broadcastContract;

    /**
     * @param BroadcastContract $broadcastContract
     */
    public function __construct(BroadcastContract $broadcastContract)
    {
        $this->broadcastContract = $broadcastContract;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function notificationReportView(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->broadcastContract->getBroadcastList($request['user_id']));
    }
}
