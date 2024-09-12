<?php

namespace app\core\controller;
use app\core\controller\base\Controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\service\ReporteService;
final class ReporteController extends Controller
{

    public function __construct()
    {
        parent::__construct([
            "app/js/reporte/reporteService.js",
             "app/js/reporte/reporteController.js",
             "app/js/singleton/singletonService.js",
             "app/js/singleton/singletonController.js",
             "assets/libs/js/viewReporte.js",
             
        ]);
    }

    public function index(): void
    { //listo

        $this->view = "reporte/index.php";
        
        $breadcrumbActual="Reportes";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        
        require_once APP_TEMPLATE . "template.php";
    }

    public function reporteProgramacion(Request $request, Response $response):void{

        $service = new ReporteService();
        $programacion = $request->getParam('programacion');

        $reporteProgramacion = $service->reporteProgramacion($programacion);

        $response->setResult($reporteProgramacion);
        $response->setMessage("El/los reportes fueron listados");
        $response->send();

    }

    public function reporteFuncion(Request $request, Response $response):void{

        $service = new ReporteService();
        $funcion = $request->getParam('funcion');

        $reporteFuncion = $service->reporteFuncion($funcion);

        $response->setResult($reporteFuncion);
        $response->setMessage("El/los reportes fueron listados");
        $response->send();

    }


    public function reporteUsuario(Request $request, Response $response):void{

        $service = new ReporteService();
        $usuario = $request->getParam('usuario');

        $reporteUsuario = $service->reporteUsuario($usuario);

        $response->setResult($reporteUsuario);
        $response->setMessage("El/los reportes fueron listados");
        $response->send();

    }

    public function reportePelicula(Request $request, Response $response):void{

        $service = new ReporteService();
        $pelicula = $request->getParam('pelicula');

        $reportePelicula = $service->reportePelicula($pelicula);

        $response->setResult($reportePelicula);
        $response->setMessage("El/los reportes fueron listados");
        $response->send();

    }
}