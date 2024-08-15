<?php

namespace app\core\controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\controller\base\InterfaceControllerExtend;
use app\core\service\UsuarioService;

final class UsuarioController extends Controller implements InterfaceController, InterfaceControllerExtend{

    public function __construct()
    {
        parent::__construct([
             "app/js/usuario/usuarioController.js",
              "app/js/usuario/usuarioService.js",
              "app/js/singleton/singletonController.js",
              "app/js/singleton/singletonService.js",
            //  "app/js/perfil/perfilService.js",
            //  "app/js/perfil/perfilController.js"
            "assets/libs/js/viewUsuario.js"
        ]);
    }

    public function index():void{

        $this->view = "usuario/index.php";
        $breadcrumbActual="Usuarios";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";

        require_once APP_TEMPLATE."template.php";

    }

    public function view($id):void{

        $this->view="usuario/view.php";
        $breadcrumbActual="Usuario";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response):void{
        $service = new UsuarioService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();

    }

    public function loadByNameAccount(Request $request, Response $response): void {
        $service = new UsuarioService();
        $nombre = $request->getParam('nombre'); 
        $usuario = $service->loadByNameAccount($nombre);

        $response->setResult($usuario->toArray()); // Convierte el objeto PerfilDTO a un array
        $response->setMessage("Usuario cargado correctamente");
        $response->send();
    }

    public function loadByPerfil(Request $request, Response $response):void{

        $service = new UsuarioService();
        $perfil = $request->getParam('perfil');

        $usuarios = $service->loadByPerfil($perfil);

        $usuariosArray = array_map(function($usuario) {
        return $usuario->toArray(); // Convierte el objeto UsuarioDTO a un array
        }, $usuarios);

        $response->setResult($usuariosArray);
        $response->setMessage("El/los usuarios se listaron correctamente");
        $response->send();

    }

    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id):void{
        $this->view="usuario/alta.php";

        $breadcrumbActual="Usuarios";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Inicio Usuario";
        
        require_once APP_TEMPLATE."template.php";

    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{


        //post lo manda todo como un formulario...
        $service = new UsuarioService();
        $service->save($request->getData());
        $response->setMessage("El usuario se registró correctamente");
        $response->send();
    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id):void{
        $this->view="usuario/modificar.php";

        $breadcrumbActual="Modificar Usuario";
        $breadcrumbLink=APP_FRONT."usuario/create";
        $breadcrumbPasada="Todas los Usuarios";
        
        require_once APP_TEMPLATE."template.php";


    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{

        $service = new UsuarioService();

        $data= $request->getData();
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        $service->update($data);
        $response->setMessage("El Usuario se actualizó correctamente");
        $response->send();
    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new UsuarioService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Usuario se eliminó con éxito");
        $response->send();
    }

    /*
    Gestiona los servicios correspondientes, para listar todas las entidades
    */
    public function list(Request $request, Response $response):void{

        $service = new UsuarioService();
        $response->setResult($service->list());
        $response->setMessage("El usuario se listó correctamente");
        $response->send();

    }

}