<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\service\ProgramacionService;

final class ProgramacionController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "app/js/programacion/programacionController.js",
            "app/js/programacion/programacionService.js",
            "assets/libs/js/viewProgramacion.js"
        ]);
    }

    public function index():void{

        $this->view = "programacion/index.php";
        $breadcrumbActual="Programaciones";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        $service = new ProgramacionService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La Programación se cargó correctamente");

        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="programacion/alta.php";

        $breadcrumbActual="Programaciones";
        $breadcrumbLink=APP_FRONT."programacion/index";
        $breadcrumbPasada="Inicio Programaciones";
        
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{

        $service = new ProgramacionService();
        $service->save($request->getData());
        $response->setMessage("La Programación se registró correctamente");
        $response->send();

    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{

        $this->view="programacion/modificar.php";

        $breadcrumbActual="Modificar Programación";
        $breadcrumbLink=APP_FRONT."programacion/create";
        $breadcrumbPasada="Todas las Programaciones";
        
        require_once APP_TEMPLATE."template.php";


    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{

        $service = new ProgramacionService();

        $data= $request->getData();

        $service->update($data);
        $response->setMessage("La Programación se actualizó correctamente");
        $response->send();


    }

    public function loadByVigencia(Request $request, Response $response):void{

        $service = new ProgramacionService();
        $vigencia = $request->getParam('vigencia');

        $programaciones = $service->loadByVigencia($vigencia);

        $programacionesArray = array_map(function($programacion) {
        return $programacion->toArray(); // Convierte el objeto UsuarioDTO a un array
        }, $programaciones);

        $response->setResult($programacionesArray);
        $response->setMessage("La/las programaciones se listaron correctamente");
        $response->send();

    }


    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{

        $service = new ProgramacionService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("La Programación se eliminó con éxito");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{
        $service = new ProgramacionService();
        $response->setResult($service->list());
        $response->setMessage("El usuario se listó correctamente");
        $response->send();


    }

    


}