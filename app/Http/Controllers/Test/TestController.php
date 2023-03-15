<?php

namespace App\Http\Controllers\Test;


use App\Contracts\Services\BackendProcessContract;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    private BackendProcessContract $backendProcessService;

    public function __construct(BackendProcessContract $backendProcessService)
    {
        $this->backendProcessService = $backendProcessService;
    }

    public function testAppsWiseData()
    {
        dd($this->backendProcessService->processBroadcastPushNotification());
    }



}
