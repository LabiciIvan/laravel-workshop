<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ApiResponses {

    public static function success(mixed $data): JsonResponse {
        return response()->json([
            'data' => $data,
            'status' => 'success'
        ], 200);
    }

    public static function notFound(string $message = null): JsonResponse {

        $messageArray = $message ? ['message' => $message] : [];

        return response()->json(array_merge([
            'status' => 'fail'
        ], $messageArray), 404);
    }
}