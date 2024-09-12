<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\EntradaService;
use app\core\service\FuncionService;

final class EntradaController extends Controller implements InterfaceController,InterfaceControllerExtend{

    public function __construct()
    {
        parent::__construct([
            // "app/js/usuario/usuarioController.js",
            //  "app/js/usuario/usuarioService.js",
            "app/js/entrada/entradaService.js",
            "app/js/singleton/singletonController.js",
              "app/js/singleton/singletonService.js",
              "app/js/entrada/entradaController.js",
                "assets/libs/js/viewEntrada.js"
                
        ]);
    }

    public function index():void{

        $this->view = "entrada/index.php";
        $breadcrumbActual="Entradas";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function view($id):void{

        $this->view="entrada/view.php";
        $breadcrumbActual="Entradas";

        $service = new FuncionService();
        $info = $service->load($_GET["id"]);

        $breadcrumbLink=APP_FRONT."funcion/view/".$info->getPeliculaId();
        $breadcrumbPasada="Funciones";
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        $service = new EntradaService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La Entrada se cargó correctamente");

        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="entrada/alta.php";

        $breadcrumbActual="Entradas";
        $breadcrumbLink=APP_FRONT."entrada/index";
        $breadcrumbPasada="Inicio Entradas";
        
        require_once APP_TEMPLATE."template.php";


    }

    public function cantidadEntradasDisponibles(Request $request, Response $response):void{
        $service = new EntradaService();
        $funcion = $request->getParam('funcion'); 
        $entrada = $service->cantidadEntradasDisponibles($funcion);

        $response->setResult($entrada); // Convierte el objeto PerfilDTO a un array
        $response->setMessage("Entrada cargada correctamente");
        $response->send();
    }


    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{
        $service = new EntradaService();
        $service->save($request->getData());
        $response->setMessage("La Entrada se registró correctamente");
        $response->send();
    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{
        $this->view="entrada/modificar.php";

        $breadcrumbActual="Modificar Entrada";
        $breadcrumbLink=APP_FRONT."entrada/create";
        $breadcrumbPasada="Todas las Entradas";
        
        require_once APP_TEMPLATE."template.php";


    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{
        $service = new EntradaService();
        $data= $request->getData();
        $service->update($data);
        $response->setMessage("La Entrada se actualizó correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new EntradaService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("La Entrada se eliminó con éxito");
        $response->send();

    }

    public function loadByNumeroTicket(Request $request, Response $response): void {
        $service = new EntradaService();
        $numeroTicket = $request->getParam('numeroTicket'); 
        $entrada = $service->loadByNumeroTicket($numeroTicket);

        $response->setResult($entrada);
        $response->setMessage("El/los entradas se listaron correctamente");
        $response->send();
    }

    public function loadByCuenta(Request $request, Response $response):void{

        $service = new EntradaService();
        $cuenta = $request->getParam('cuenta');

        $entradas = $service->loadByCuenta($cuenta);

        $response->setResult($entradas);
        $response->setMessage("El/los entradas se listaron correctamente");
        $response->send();

    }

    public function loadByFuncion(Request $request, Response $response):void{

        $service = new EntradaService();
        $funcion = $request->getParam('funcion');

        $entradas = $service->loadByFuncion($funcion);

        $response->setResult($entradas);
        $response->setMessage("El/los entradas se listaron correctamente");
        $response->send();

    }

    public function loadByProgramacion(Request $request, Response $response):void{

        $service = new EntradaService();
        $programacion = $request->getParam('programacion');

        $entradas = $service->loadByProgramacion($programacion);

        $response->setResult($entradas);
        $response->setMessage("El/los entradas se listaron correctamente");
        $response->send();

    }

    public function loadByPelicula(Request $request, Response $response):void{

        $service = new EntradaService();
        $pelicula = $request->getParam('pelicula');

        $entradas = $service->loadByPelicula($pelicula);

        $response->setResult($entradas);
        $response->setMessage("El/los entradas se listaron correctamente");
        $response->send();

    }
    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{
        $service = new EntradaService();
        $response->setResult($service->list());
        $response->setMessage("La entrada se listó correctamente");
        $response->send();
    }

    public function listEntradas(Request $request, Response $response):void{
        $service = new EntradaService();
        $response->setResult($service->listEntradas());
        $response->setMessage("La entrada se listó correctamente");
        $response->send();
    }

}