<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web', [
        ]);

        $middleware->group('api', [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
             'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $handler = new class {
            use ApiResponseTrait;
        };
        $exceptions->render(function (ValidationException $e) use ($handler) {
            return $handler->responseError($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $exceptions->render(function (UnauthorizedHttpException $e) use ($handler) {
            return $handler->responseError($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (NotFoundHttpException $e) use ($handler) {
            return $handler->responseError($e->getMessage(), Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (BadRequestHttpException $e) use ($handler) {
            return $handler->responseError($e->getMessage(), Response::HTTP_BAD_REQUEST);
        });

        $exceptions->render(function (Exception $e) use ($handler) {
            return $handler->responseError($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        //
    })->create();
