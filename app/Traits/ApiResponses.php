<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\AbstractCursorPaginator;

trait ApiResponses
{
    /**
     * 🟢 Unified success response (auto-detect data type)
     */
    public function sendResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!is_null($data)) {
            [$payload, $meta] = $this->normalizeData($data);

            $response['data'] = $payload;

            if (!empty($meta)) {
                $response['meta']  = $meta['meta'] ?? [];
                $response['links'] = $meta['links'] ?? [];
            }
        }

        return response()->json($response, $code);
    }


    /**
     * 🔴 Unified error response
     */
    public function sendError(string $message, array|string $errors = [], int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors'  => is_array($errors) ? $errors : [$errors],
        ], $code);
    }


    /**
     * 🟠 Validation response
     */
    public function sendValidationError($validator): JsonResponse
    {
        return $this->sendError('Validation Error', $validator->errors()->toArray(), 422);
    }


    /**
     * 🔧 Normalize & shape API data
     * - Handles: ResourceCollection, JsonResource with pagination, Paginator, CursorPaginator, arrays
     */
   private function normalizeData($data): array
{
    // 📌 Resource Collection (auto meta & links)
    if ($data instanceof ResourceCollection) {
        $arrayData = $data->toArray(request());
        $resourceArray = is_object($data->resource) ? $data->resource->toArray() : [];

        return [
            $arrayData['data'] ?? [],
            [
                'meta'  => $data->additional['meta'] ?? $resourceArray['meta'] ?? [],
                'links' => $data->additional['links'] ?? $resourceArray['links'] ?? [],
            ]
        ];
    }

    // 📌 JsonResource + Pagination
    if ($data instanceof JsonResource && $data->resource instanceof AbstractPaginator) {
        return [$data, ['meta' => $this->paginationMeta($data->resource)]];
    }

    // 📌 paginate() / cursorPaginate()
    if ($data instanceof AbstractPaginator || $data instanceof AbstractCursorPaginator) {
        return [$data->items(), ['meta' => $this->paginationMeta($data)]];
    }

    // 📌 Normal data (Array / Model / Scalar)
    return [$data, []];
}



    /**
     * 📄 Unified pagination meta extractor
     */
    private function paginationMeta($paginator): array
    {
        return [
            'total'          => $paginator->total()         ?? null,
            'count'          => $paginator->count()         ?? null,
            'per_page'       => $paginator->perPage()       ?? null,
            'current_page'   => $paginator->currentPage()   ?? null,
            'last_page'      => $paginator->lastPage()      ?? null,
            'from'           => $paginator->firstItem()     ?? null,
            'to'             => $paginator->lastItem()      ?? null,
            'next_page_url'  => $paginator->nextPageUrl()   ?? null,
            'prev_page_url'  => $paginator->previousPageUrl() ?? null,
            'path'           => $paginator->path()          ?? null,
        ];
    }
}
