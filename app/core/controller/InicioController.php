<?php

namespace app\core\controller;
use app\core\controller\base\Controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\service\InicioService;

final class InicioController extends Controller
{


    public function __construct()
    {
        parent::__construct([
            "app/js/inicio/inicioService.js",
             "app/js/inicio/inicioController.js",
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
}