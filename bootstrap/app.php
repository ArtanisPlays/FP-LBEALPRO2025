<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Sebelumnya, ini dilakukan di dalam file app/Http/Kernel.php
        // di properti $middlewareAliases.
        
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            // Anda bisa menambahkan alias lain di sini jika perlu
            // 'admin' => \App\Http\Middleware\AdminMiddleware::class, 
        ]);

        // Anda juga bisa menambahkan middleware global, dll di sini
        // $middleware->append(MyMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
