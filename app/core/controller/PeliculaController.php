<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\PeliculaService;

final class PeliculaController extends Controller implements InterfaceController, InterfaceControllerExtend{

    public function __construct()
    {
        parent::__construct([
            // "app/js/usuario/usuarioController.js",
            //  "app/js/usuario/usuarioService.js",
            //  "app/js/perfil/perfilService.js",
            //  "app/js/perfil/perfilController.js"
            "assets/libs/js/viewPelicula.js"
        ]);
    }

    public function index():void{

        $this->view = "pelicula/index.php";
        $breadcrumbActual="Peliculas";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function view($id):void{

        $this->view="pelicula/view.php";
        $breadcrumbActual="Película";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{


    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="pelicula/alta.php";

        $breadcrumbActual="Películas";
        $breadcrumbLink=APP_FRONT."pelicula/index";
        $breadcrumbPasada="Inicio Películas";
        
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{}

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{


        $this->view="pelicula/modificar.php";

        $breadcrumbActual="Modificar Películas";
        $breadcrumbLink=APP_FRONT."pelicula/create";
        $breadcrumbPasada="Todas las Películas";
        
        require_once APP_TEMPLATE."template.php";


    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{}

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{}

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{}

}