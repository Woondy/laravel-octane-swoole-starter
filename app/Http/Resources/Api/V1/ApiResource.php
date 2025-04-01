<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ApiResource
{
    /**
     * Create a success response
     *
     * @param mixed $data The data to be returned
     * @param string $message Optional success message
     * @param int $code HTTP status code
     * @return JsonResponse
     */
    public static function success(mixed $data, string $message = 'Success', int $code = 200): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'meta' => [
                'timestamp' => now()->toIso8601String(),
                'request_id' => request()->header('X-Request-ID') ?? (string) Str::uuid(),
            ],
        ];

        // Add pagination meta if data is paginated
        if ($data instanceof LengthAwarePaginator) {
            $response['meta']['pagination'] = [
                'current_page' => $data->currentPage(),
                'from' => $data->firstItem(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'to' => $data->lastItem(),
                'total' => $data->total(),
            ];
        }

        return response()->json($response, $code);
    }

    /**
     * Create an error response
     *
     * @param string $message Error message
     * @param string $code Error code
     * @param mixed $data Additional error data
     * @param int $httpCode HTTP status code
     * @return JsonResponse
     */
    public static function error(
        string $message,
        string $code = 'ERROR',
        mixed $data = null,
        int $httpCode = 400
    ): JsonResponse {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'meta' => [
                'timestamp' => now()->toIso8601String(),
                'request_id' => request()->header('X-Request-ID') ?? (string) Str::uuid(),
            ],
        ], $httpCode);
    }

    /**
     * Create a resource response
     *
     * @param JsonResource $resource The resource to be returned
     * @param int $code HTTP status code
     * @return JsonResponse
     */
    public static function resource(JsonResource $resource, int $code = 200): JsonResponse
    {
        return self::success($resource, 'Success', $code);
    }

    /**
     * Create a validation error response
     *
     * @param array $errors Validation errors
     * @return JsonResponse
     */
    public static function validationError(array $errors): JsonResponse
    {
        return self::error(
            'Validation failed',
            'VALIDATION_ERROR',
            $errors,
            422
        );
    }

    /**
     * Create a not found error response
     *
     * @param string $message Optional custom message
     * @return JsonResponse
     */
    public static function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return self::error(
            $message,
            'NOT_FOUND',
            null,
            404
        );
    }

    /**
     * Create an unauthorized error response
     *
     * @param string $message Optional custom message
     * @return JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error(
            $message,
            'UNAUTHORIZED',
            null,
            401
        );
    }

    /**
     * Create a forbidden error response
     *
     * @param string $message Optional custom message
     * @return JsonResponse
     */
    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error(
            $message,
            'FORBIDDEN',
            null,
            403
        );
    }
} 