<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\FuncionService;

final class FuncionController extends Controller implements InterfaceController,InterfaceControllerExtend{

    public function __construct()
    {
        parent::__construct([
             "app/js/funcion/funcionController.js",
              "app/js/funcion/funcionService.js",
            //  "app/js/perfil/perfilService.js",
            //  "app/js/perfil/perfilController.js"
            "assets/libs/js/viewFuncion.js",
            "app/js/singleton/singletonController.js",
              "app/js/singleton/singletonService.js"
        ]);
    }

    public function index():void{

        $this->view = "index.php";
        $breadcrumbActual="Funciones";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $redireccion=APP_FRONT . "funcion/create";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function view($id):void{

        $this->view="funcion/view.php";
        $breadcrumbActual="Funciones";
        $breadcrumbLink=APP_FRONT."pelicula/view/".$_GET["id"];
        $breadcrumbPasada="Película";
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        $service = new FuncionService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La Función se cargó correctamente");

        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="funcion/alta.php";

        $breadcrumbActual="Funciones";
        $breadcrumbLink=APP_FRONT."funcion/index";
        $breadcrumbPasada="Inicio Funciones";
        
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{

        $service = new FuncionService();
        $service->save($request->getData());
        $response->setMessage("La función se registró correctamente");
        $response->send();

    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{

        $this->view="funcion/modificar.php";

        $breadcrumbActual="Modificar Función";
        $breadcrumbLink=APP_FRONT."funcion/create";
        $breadcrumbPasada="Todas las Funciones";
        
        require_once APP_TEMPLATE."template.php";


    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{

        $service = new FuncionService();

        $data= $request->getData();
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        $service->update($data);
        $response->setMessage("La función se actualizó correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{

        $service = new FuncionService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("La función se eliminó con éxito");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{

        $service = new FuncionService();
        $response->setResult($service->list());
        $response->setMessage("La función se listó correctamente");
        $response->send();

    }

    public function listF(Request $request, Response $response):void{

        $service = new FuncionService();
        $response->setResult($service->listF());
        $response->setMessage("La función se listó correctamente");
        $response->send();

    }

    public function listFunciones(Request $request, Response $response):void{

        $service = new FuncionService();
        $id = $request->getParam("id");
        $funciones = $service->listFunciones($id);

        $response->setResult($funciones); // Convierte el objeto PerfilDTO a un array
        $response->setMessage("Función cargada correctamente");
        $response->send();

    }

    public function loadByNumeroFuncion(Request $request, Response $response): void {
        $service = new FuncionService();
        $numeroFuncion = $request->getParam('numeroFuncion'); 
        $funcion = $service->loadByNumeroFuncion($numeroFuncion);

        $response->setResult($funcion); // Convierte el objeto PerfilDTO a un array
        $response->setMessage("Función cargada correctamente");
        $response->send();
    }

    public function loadByNombrePelicula(Request $request, Response $response):void{

        $service = new FuncionService();
        $pelicula = $request->getParam('pelicula');
        $funciones = $service->loadByNombrePelicula($pelicula);

        $response->setResult($funciones);
        $response->setMessage("La/las funciones se listaron correctamente");
        $response->send();
    }

    public function loadByNumeroSala(Request $request, Response $response):void{

        $service = new FuncionService();
        $sala = $request->getParam('sala');
        $funciones = $service->loadByNumeroSala($sala);

        $response->setResult($funciones);
        $response->setMessage("La/las funciones se listaron correctamente");
        $response->send();
    }

    public function loadByFechaProgramacion(Request $request, Response $response):void{

        $service = new FuncionService();
        $programacion = $request->getParam('programacion');
        $funciones = $service->loadByFechaProgramacion($programacion);

        $response->setResult($funciones);
        $response->setMessage("La/las funciones se listaron correctamente");
        $response->send();
    }



}