<?php

namespace app;

use app\core\middleware\AuthenticationMiddleware;
use app\core\middleware\ExceptionHandlerMiddleware;
use app\core\middleware\PerfilMiddleware;
use app\core\middleware\Pipeline;
use app\core\middleware\RoutingMiddleware;
use app\libs\request\Request;
use app\libs\response\Response;

final class App{

    private function __construct(){}

    public static function run(){
        $pipeline = new Pipeline();

        $pipeline->pipe(new ExceptionHandlerMiddleware());
        $pipeline->pipe(new AuthenticationMiddleware());
        // $pipeline->pipe(new PerfilMiddleware());
        $pipeline->pipe(new RoutingMiddleware());
        $pipeline->process(new Request(), new Response());

    }

}