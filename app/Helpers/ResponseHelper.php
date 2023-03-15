<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{

    //200	Ok	The request was successfully completed.
    //201	Created	A new reesource was successfully created.
    //400	Bad Request	The request was invalid.
    //401	Unauthorized	Invalid login credentials.
    //403	Forbidden	You do not have enough permissions to perform this action.
    //404	Not Found	The requested resource/page not found.
    //405	Method Not Allowed	This request is not supported by the resource.
    //409	Conflict	The request could not be completed due to a conflict.
    //500	Internal Server Error	The request was not completed due to an internal error on the server side.
    //503	Service Unavailable	The server was unavailable.
    //

    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public static function sendResponse($result, $message, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public static function sendError($error, array $errorMessages = [], int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
