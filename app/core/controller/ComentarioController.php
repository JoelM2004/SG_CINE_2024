<?php

namespace app\core\controller;
use app\core\controller\base\Controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\core\service\ComentarioService;


final class ComentarioController extends Controller 
{


    public function __construct()
    {
        parent::__construct([
            "assets/libs/js/viewComentario.js",
            "app/js/comentario/comentarioService.js",
            "app/js/comentario/comentarioController.js",
            "app/js/singleton/singletonService.js",
            "app/js/singleton/singletonController.js"
        ]);
    }

    public function index(): void
    { //listo

        $this->view = "comentario/index.php";
        
        $breadcrumbActual="Tu Opinión";
        $breadcrumbLink=APP_FRONT."pelicula/view/".$_GET["id"];
        $breadcrumbPasada="Pelicula";
        
        require_once APP_TEMPLATE . "template.php";
    }

    public function load(Request $request, Response $response):void{
        $service = new ComentarioService();
        $info = $service->load($request->getId());
        $info->toArray();
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("El Comentario se cargó correctamente");

        $response->send();

    }

    public function list(Request $request, Response $response):void{

        $service = new ComentarioService();
        $pelicula = $request->getParam('pelicula');

        $comentarios = $service->listPeli($pelicula);

        $comentariosArray = array_map(function($comentario) {
        return $comentario->toArray(); // Convierte el objeto UsuarioDTO a un array
        }, $comentarios);

        $response->setResult($comentariosArray);
        $response->setMessage("El/los comentarios se listaron correctamente");
        $response->send();

    }
    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response):void{
        $service = new ComentarioService();
        $service->save($request->getData());
        $response->setMessage("El Comentario se registró correctamente");
        $response->send();



    }

    /*
    Gestiona los servicios correspondientes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response):void{
        $service = new ComentarioService();

        $data= $request->getData();

        $service->update($data);
        $response->setMessage("El Comentario se actualizó correctamente");
        $response->send();

    }

    /*
    Gestiona los servicios correspondientes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response):void{
        $service = new ComentarioService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Comentario se eliminó con éxito");
        $response->send();

    }
}