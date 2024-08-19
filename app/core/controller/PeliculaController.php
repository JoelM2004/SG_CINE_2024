<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\PeliculaService;

final class PeliculaController extends Controller implements InterfaceController, InterfaceControllerExtend
{

    public function __construct()
    {
        parent::__construct([
            "app/js/singleton/singletonController.js",
            "app/js/singleton/singletonService.js",
            "app/js/pelicula/peliculaService.js",
            "app/js/pelicula/peliculaController.js",
            "assets/libs/js/viewPelicula.js"
        ]);
    }

    public function index(): void
    {

        $this->view = "pelicula/index.php";
        $breadcrumbActual = "Peliculas";
        $breadcrumbLink = APP_FRONT . "inicio/index";
        $breadcrumbPasada = "Menú Principal";

        require_once APP_TEMPLATE . "template.php";
    }

    public function view($id): void
    {

        $this->view = "pelicula/view.php";
        $breadcrumbActual = "Película";
        $breadcrumbLink = APP_FRONT . "inicio/index";
        $breadcrumbPasada = "Menú Principal";
        require_once APP_TEMPLATE . "template.php";
    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response): void {
        $service = new PeliculaService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La Película se cargó correctamente");

        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id): void
    {
        $this->view = "pelicula/alta.php";

        $breadcrumbActual = "Películas";
        $breadcrumbLink = APP_FRONT . "pelicula/index";
        $breadcrumbPasada = "Inicio Películas";

        require_once APP_TEMPLATE . "template.php";
    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response): void {

        //post lo manda todo como un formulario...
        $service = new PeliculaService();
        $service->save($request->getData());
        $response->setMessage("La Película se registró correctamente");
        $response->send();

    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id): void
    {


        $this->view = "pelicula/modificar.php";

        $breadcrumbActual = "Modificar Películas";
        $breadcrumbLink = APP_FRONT . "pelicula/create";
        $breadcrumbPasada = "Todas las Películas";

        require_once APP_TEMPLATE . "template.php";
    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response): void {

        $service = new PeliculaService();

        $data= $request->getData();
 
        $service->update($data);
        $response->setMessage("La Película se actualizó correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response): void {

        $service = new PeliculaService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("La Película se eliminó con éxito");
        $response->send();


    }

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response): void {
        $service = new PeliculaService();
        $response->setResult($service->list());
        $response->setMessage("La Película se listó correctamente");
        $response->send();

    }
}
