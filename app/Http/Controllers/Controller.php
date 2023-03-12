<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $message
     * @param array $data
     * @param bool $status
     * @param int $response
     * @return JsonResponse
     */
    public function returnJsonResponse(string $message, array $data=[], bool $status=TRUE, int $response= Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message'           =>$message,
            'data'              => $data,
            'status'            =>$status,
        ], $response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Content-Type', 'application/json;charset=UTF-8')
            ->header('Access-Control-Allow-Methods', 'POST, GET, PATCH, PUT, OPTIONS')
            ->header('Charset', 'utf-8');
    }
}
