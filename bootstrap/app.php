<?php
// Forzar la creación de la base de datos SQLite si no existe en producción
$sqlitePath = __DIR__ . '/../storage/database.sqlite';
if (!file_exists($sqlitePath)) {
    touch($sqlitePath);
    chmod($sqlitePath, 0775);
}



use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([

            'role' => \App\Http\Middleware\RoleMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
