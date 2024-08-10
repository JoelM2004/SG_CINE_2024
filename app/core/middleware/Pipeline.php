<?php

namespace app\core\middleware;

use app\core\middleware\base\InterfaceMiddleware;
use app\libs\request\Request;
use app\libs\response\Response;

final class Pipeline{

    private ?InterfaceMiddleware $first;
    private ?InterfaceMiddleware $last;

    public function __construct(){
        $this->first = $this->last = null;
    }

    public function pipe(InterfaceMiddleware $middleware){
        if($this->first === null){
            $this->first = $this->last = $middleware;
        }
        else{
            $this->last->setNext($middleware);
            $this->last = $middleware;
        }
    }

    public function process(Request $request, Response $response){
        $this->first->handler($request, $response);
    }

}