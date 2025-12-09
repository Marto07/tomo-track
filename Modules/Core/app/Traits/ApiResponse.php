<?php

namespace Modules\Core\Traits;

trait ApiResponse {

    public function PaginatedResponse($data) {
        return response()->json([
            'data' => $data->items(),
            'meta' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
            ],
            'links' => [
                'first' => $data->url(1),
                'last' => $data->url($data->lastPage()),
                'prev' => $data->previousPageUrl(),
                'next' => $data->nextPageUrl(),
            ],
            'success' => true,
            'message' => 'Data retrieved successfully',
        ],200);
    }

    public function SuccessResponse($data, $message = null) {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message ?? 'Data retrieved successfully',
        ],200);
    }

    public function ErrorResponse($message = null, $code = 500) {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message ?? 'Error during request',
        ],$code);
    }

}
