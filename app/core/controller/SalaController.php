<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\SalaService;

final class SalaController extends Controller implements InterfaceController, InterfaceControllerExtend{

    public function __construct()
    {
        parent::__construct([
            
              "app/js/sala/salaService.js",
              "app/js/sala/salaController.js",
            "assets/libs/js/viewSala.js"
        ]); 
    }

    public function index():void{

        $this->view = "index.php";
        $breadcrumbActual="Salas";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $redireccion=APP_FRONT . "sala/create";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function view($id):void{

       

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        $service = new SalaService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();


    }

    public function loadByNumeroSala(Request $request, Response $response): void {
        $service = new SalaService();
        $numeroSala = $request->getParam('numeroSala'); 
        $sala = $service->loadByNumeroSala($numeroSala);

        $response->setResult($sala->toArray()); // Convierte el objeto PerfilDTO a un array
        $response->setMessage("Sala cargada correctamente");
        $response->send();
    }

    public function loadByEstado(Request $request, Response $response):void{

        $service = new salaService();
        $perfil = $request->getParam('estado');

        $salas = $service->loadByEstado($perfil);

        $salasArray = array_map(function($sala) {
        return $sala->toArray(); // Convierte el objeto salaDTO a un array
        }, $salas);

        $response->setResult($salasArray);
        $response->setMessage("La/las salas se listaron correctamente");
        $response->send();

    }

    public function loadByCapacidad(Request $request, Response $response):void{

        $service = new salaService();
        $min = $request->getParam('min');
        $max = $request->getParam('max');

        $salas = $service->loadByCapacidad($min,$max);

        $salasArray = array_map(function($sala) {
        return $sala->toArray(); // Convierte el objeto salaDTO a un array
        }, $salas);

        $response->setResult($salasArray);
        $response->setMessage("El/los salas se listaron correctamente");
        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="sala/alta.php";

        $breadcrumbActual="Salas";
        $breadcrumbLink=APP_FRONT."sala/index";
        $breadcrumbPasada="Inicio Salas";
        
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{

        $service = new SalaService();
        $service->save($request->getData());
        $response->setMessage("La sala se registró correctamente");
        $response->send();

    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{
        $this->view="sala/modificar.php";
        $breadcrumbActual="Modificar Sala";
        $breadcrumbLink=APP_FRONT."sala/create";
        $breadcrumbPasada="Todas las Salas";
        require_once APP_TEMPLATE."template.php";

    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{

        $service = new SalaService();
        $data= $request->getData();
        $service->update($data);
        $response->setMessage("La sala se actualizó correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new SalaService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("La sala se eliminó con éxito");
        $response->send();
    }

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{
        $service = new SalaService();
        $response->setResult($service->list());
        $response->setMessage("La sala se listó correctamente");
        $response->send();
    }

}