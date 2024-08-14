<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceControllerSimple;
use app\core\service\GeneroService;

final class GeneroController extends Controller implements InterfaceControllerSimple
{

    public function __construct()
    {
        parent::__construct([
            "app/js/singleton/singletonController.js",
            "app/js/singleton/singletonService.js"
        ]);
    }

    public function load(Request $request, Response $response): void
    { //listo
        $service = new GeneroService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("El género se cargó correctamente");

        $response->send();
    }

    public function list(Request $request, Response $response): void
    {
        $service = new GeneroService();
        $response->setResult($service->list());
        $response->setMessage("El género se listó correctamente");
        $response->send();
    }
}