<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        
        // Trust Railway proxies for proper HTTPS detection
        $middleware->trustProxies(at: '*');
        
        $middleware->validateCsrfTokens(except: [
            'api/logout',
            'api/cart',
            'api/orders',
            'api/location', // Also exclude location if it comes from mobile app potentially without csrf
            'stripe/*', 
        ]);
        
        // Register middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'redirect.admin' => \App\Http\Middleware\RedirectIfAdmin::class,
        ]);
    })


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
