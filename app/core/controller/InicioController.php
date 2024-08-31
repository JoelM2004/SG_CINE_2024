<?php

namespace app\core\controller;
use app\core\controller\base\Controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\service\InicioService;
use app\core\service\ImagenService;
final class InicioController extends Controller
{


    public function __construct()
    {
        parent::__construct([
            "app/js/inicio/inicioService.js",
             "app/js/inicio/inicioController.js",
             "app/js/singleton/singletonService.js",
             "app/js/singleton/singletonController.js",
             "assets/libs/css/viewInicio.css",
             
        ]);
    }



    public function index(): void
    { //listo

        $this->view = "inicio/index.php";
        
        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        
        require_once APP_TEMPLATE . "template.php";
    }

    public function list(Request $request, Response $response):void{
        $service = new InicioService();
        $response->setResult($service->list());
        $response->setMessage("El Inicio se listó correctamente");
        $response->send();
    }

    public function loadImagen(Request $request, Response $response):void{
        $service = new ImagenService();
        $info = $service->loadImagen($request->getId());
        // $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }
}