<?php
namespace App\Http\Middleware;
class Kernel {
    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'admin' => \App\Http\Middleware\CheckUserSession::class,
];

}

