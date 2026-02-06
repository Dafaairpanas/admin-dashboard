<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->alias([
            'role.uac' => \App\Http\Middleware\UserAccessControl::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle View Not Found errors
        $exceptions->render(function (\Illuminate\View\ViewException $e, $request) {
            if (str_contains($e->getMessage(), 'View') && str_contains($e->getMessage(), 'not found')) {
                return response()->view('errors.404', [], 404);
            }
        });
    })->create();
