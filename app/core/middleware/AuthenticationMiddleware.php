<?php

namespace app\core\middleware;

use app\core\middleware\base\InterfaceMiddleware;
use app\core\middleware\base\Middleware;
use app\libs\request\Request;
use app\libs\response\Response;

final class AuthenticationMiddleware extends Middleware implements InterfaceMiddleware{

    public function handler(Request $request, Response $response): void{
        session_start();

        if (!isset($_SESSION["token"]) || $_SESSION["token"] !== APP_TOKEN) {
            if($request->getController() !== "autenticacion" || $request->getAction() !== "login"){
                $request->setController("autenticacion");
                $request->setAction("index");
            }
        }

        $this->next($request, $response);
    }

}