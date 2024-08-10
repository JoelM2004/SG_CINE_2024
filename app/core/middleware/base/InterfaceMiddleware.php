<?php

namespace app\core\middleware\base;

use app\libs\request\Request;
use app\libs\response\Response;

interface InterfaceMiddleware{

    public function handler(Request $request, Response $response): void;

    public function setNext(InterfaceMiddleware $next): void;

    public function next(Request $request, Response $response): void;

}