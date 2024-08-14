<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceControllerSimple;
use app\core\service\TipoService;

final class TipoController extends Controller implements InterfaceControllerSimple
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
        $service = new TipoService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("El tipo se cargó correctamente");

        $response->send();
    }

    public function list(Request $request, Response $response): void
    {
        $service = new TipoService();
        $response->setResult($service->list());
        $response->setMessage("El tipo se listó correctamente");
        $response->send();
    }
}