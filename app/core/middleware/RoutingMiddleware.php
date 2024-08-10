<?php

namespace app\core\middleware;

use app\core\controller\AutenticacionController;
use app\core\controller\UsuarioController;
use app\core\middleware\base\InterfaceMiddleware;
use app\core\middleware\base\Middleware;
use app\libs\request\Request;
use app\libs\response\Response;

final class RoutingMiddleware extends Middleware implements InterfaceMiddleware{

    public function handler(Request $request, Response $response): void{

        $controllerName = 'app\\core\\controller\\' . ucfirst($request->getController()) . 'Controller';

        if(!class_exists($controllerName) || !method_exists($controllerName, $request->getAction())){

            header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
        
        }


        $response->setController($request->getController());
        $response->setAction($request->getAction());

        call_user_func_array(
            array(new $controllerName, $request->getAction()),
            array($request, $response)
        );

    }

}