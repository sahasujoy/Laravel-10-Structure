<?php

namespace App\Http\Controllers\V1\User\Segment;

use App\Contracts\Services\SegmentContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SegmentController extends Controller
{
    private $segmentService;

    public function __construct(SegmentContract $segmentService)
    {
        $this->segmentService = $segmentService;
    }
    public function createSegment(Request $request)
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->segmentService->createSegment($request));
    }

    public function getSegmentCreateModalForm(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return response()->json([
            'html' => view('web-app.segment.segment-modal-form')->render(),
            'status' => Response::HTTP_OK
        ]);
    }

    public function getSegmentFilters(Request $request)
    {
        return response()->json($this->segmentService->getSegmentFilterInput($request));
    }

    public function segmentView($appId)
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Web Apps"],
            ['name' => $app->app_name ]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'Segment'];

        $button = '<a type="button" class="btn btn-primary waves-effect waves-float waves-light create_segment">
                    <i class="mr-50" data-feather="plus-circle"></i>
                    <span>New Segment</span>
                </a>';

        return view('user.segment.segment')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

    public function segmentList(Request $request)
    {
        $request['user_id'] = auth()->id();

        return $this->segmentService->segmentList($request['user_id'], $request['app_id']);
    }

    public function getAllSegmentList(Request $request)
    {
        $request['user_id'] = auth()->id();

        return $this->segmentService->getAllSegmentList($request['user_id'], $request['app_id']);
    }

    /**
     * Delete segment
     * @param Request $request
     * @return JsonResponse
     */
    public function segmentDelete(Request $request)
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->segmentService->segmentDelete($request['user_id'], $request['id']));
    }

    /**
     * Get specific segment data
     * @param Request $request
     * @return JsonResponse
     */
    public function getSpecificSegmentData(Request $request)
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->segmentService->getSpecificSegmentData($request['user_id'], $request['id']));
    }

    public function segmentModalTwo($appId)
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Web Apps"],
            ['name' => $app->app_name ]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'Segment'];

        $button = '<a type="button" class="btn btn-primary waves-effect waves-float waves-light create_segment">
                    <i class="mr-50" data-feather="plus-circle"></i>
                    <span>New Segment</span>
                </a>';

        return view('web-app.segment.designSegment-modal')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

    public function updateSegment(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->segmentService->updateSegment($request));
    }
}
