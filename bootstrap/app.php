<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middlewares\RoleMiddleware; // Import Spatie's Role Middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register global middleware
        $middleware->push(\App\Http\Middleware\CheckForMaintenanceMode::class);
        $middleware->push(\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class);
        $middleware->push(\Illuminate\Auth\Middleware\Authenticate::class);
        // Add other global middleware here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Register custom exception handling logic if needed
    })
    ->create()
    ->middleware([
        'role' => RoleMiddleware::class,  // Register role middleware here
        // You can add more route-specific middleware here if needed
    ]);
