<?php

use App\Http\Resources\Api\V1\ApiResource;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle ValidationException
        $exceptions->render(function (ValidationException $e) {
            return ApiResource::validationError($e->errors());
        });

        // Handle ModelNotFoundException
        $exceptions->render(function (ModelNotFoundException $e) {
            return ApiResource::notFound('Resource not found');
        });

        // Handle NotFoundHttpException
        $exceptions->render(function (NotFoundHttpException $e) {
            return ApiResource::notFound('Route not found');
        });

        // Handle AuthenticationException
        $exceptions->render(function (AuthenticationException $e) {
            return ApiResource::unauthorized('Unauthenticated');
        });

        // Handle AccessDeniedHttpException
        $exceptions->render(function (AccessDeniedHttpException $e) {
            return ApiResource::forbidden('Access denied');
        });

        // Handle other exceptions
        $exceptions->render(function (\Throwable $e) {
            if (request()->is('api/*')) {
                return ApiResource::error(
                    'Internal server error',
                    'INTERNAL_SERVER_ERROR',
                    config('app.debug') ? [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTrace(),
                    ] : null,
                    500
                );
            }
        });
    })->create();
