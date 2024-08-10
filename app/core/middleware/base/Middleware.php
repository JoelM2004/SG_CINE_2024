<?php

namespace app\core\middleware\base;

use app\libs\request\Request;
use app\libs\response\Response;

class Middleware{

    protected $next;

    public function __construct(){
        $this->next = null;
    }

    public function setNext(InterfaceMiddleware $next): void{
        $this->next = $next;
    }

    public function next(Request $request, Response $response): void{
        if($this->next !== null){
            $this->next->handler($request, $response);
        }
    }

}