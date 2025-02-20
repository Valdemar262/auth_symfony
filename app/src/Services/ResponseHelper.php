<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * @param mixed|null $data
     * @param int $status
     * @return JsonResponse
     */
    public function createSuccessResponse(
        mixed $data = null,
        int $status = Response::HTTP_OK
    ): JsonResponse {
        $response = [
            'data' => $data
        ];

        return new JsonResponse($response, $status);
    }
}
