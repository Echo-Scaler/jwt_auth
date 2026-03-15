<?php

use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Register custom middleware alias
        $middleware->alias([
            'jwt' => JWTMiddleware::class,
            'admin' => AdminMiddleware::class,
            'user' => UserMiddleware::class,
        ]);

    })
  ->withExceptions(function (Exceptions $exceptions): void {
    // can user model , etc ..
    $exceptions->render(function (\Illuminate\Http\Exceptions\ThrottleRequestsException $e, $request) {
        return response()->json([
            'message' => 'Too many requests. Please try again later.',
            'status' => 429,
        ], 429);
    });

})
->create();
