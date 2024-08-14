<?php

namespace app\core\controller\base;

use app\libs\request\Request;

use app\libs\response\Response;

interface InterfaceControllerSimple{

    /*Invoca la vista principal del módulo
    */
    
    public function load(Request $request, Response $response):void;

    public function list(Request $request, Response $response):void;

}