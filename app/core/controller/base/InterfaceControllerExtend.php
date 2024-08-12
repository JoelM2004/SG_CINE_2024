<?php

namespace app\core\controller\base;

use app\libs\request\Request;

use app\libs\response\Response;

interface InterfaceControllerExtend{

    /*Invoca la vista principal del módulo
    */
    
    public function view($id):void;

    
}