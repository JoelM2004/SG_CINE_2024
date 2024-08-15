<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\service\PerfilService;

final class PerfilController extends Controller implements InterfaceController
{


    public function __construct()
    {
        parent::__construct([
            "app/js/perfil/perfilController.js",
            "app/js/perfil/perfilService.js",
            "app/js/singleton/singletonController.js",
            "app/js/singleton/singletonService.js"
        ]);
    }


    public function index(): void
    { //listo

        $this->view = "perfil/index.php";
        $breadcrumbActual="Perfiles";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menu Principal";
        
        require_once APP_TEMPLATE . "template.php";
    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response): void
    { //listo
        $service = new PerfilService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }

    // public function loadByName(Request $request, Response $response) : void {
    //     $service = new PerfilService();
    //     $info = $service->loadByName($request->getData());
    //     // $info=$info->toArray();
    //     $response->setResult($info);
    //     $response->setMessage("La cuenta se cargó correctamente");
    //     $response->send();

    // }
     
    public function loadByName(Request $request, Response $response): void {
        $service = new PerfilService();
        $nombre = $request->getParam('nombre'); 
        $perfil = $service->loadByName($nombre);
    
        if (!$perfil) {
            $response->setError("No se encontró el perfil con el nombre proporcionado.");
        } else {
            $response->setResult($perfil->toArray()); // Convierte el objeto PerfilDTO a un array
            $response->setMessage("Perfil cargado correctamente");
        }
    
        $response->send();
    }


    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id): void
    { //listo
        $this->view="perfil/alta.php";

        $breadcrumbActual="Perfiles";
        $breadcrumbLink=APP_FRONT."perfil/index";
        $breadcrumbPasada="Inicio Perfiles";
        
        require_once APP_TEMPLATE."template.php";
    }

    public function loadPerfil(Request $request, Response $response): void
    { //listo
        $service = new PerfilService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }

    public function listPerfil(Request $request, Response $response): void
    {
        $service = new PerfilService();
        $response->setResult($service->list());
        $response->setMessage("El perfil se listó correctamente");
        $response->send();
    }


    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response): void
    { //listo

        $service = new PerfilService();
        $service->save($request->getData());
        $response->setMessage("La cuenta se registró correctamente");
        $response->send();
    }

    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id): void
    { //listo

        $this->view="perfil/modificar.php";

        $breadcrumbActual="Modificar Perfiles";
        $breadcrumbLink=APP_FRONT."perfil/create";
        $breadcrumbPasada="Todas los Perfiles";
        
        require_once APP_TEMPLATE."template.php";
    }

    /*
    Gestiona los servicios correspondietes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response): void
    { //en proceso y consultar
        $service = new PerfilService();

        $data= $request->getData();
        
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        // var_dump($data);
        $service->update($data);
        $response->setMessage("El perfil se actualizó correctamente");
        $response->send();
    }

    /*
    Gestiona los servicios correspondietes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response): void
    { //listo
        $service = new PerfilService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Perfil se eliminó con éxito");
        $response->send();
    }

    public function list(Request $request, Response $response): void
    {
        $service = new PerfilService();
        $response->setResult($service->list());
        $response->setMessage("El perfil se listó correctamente");
        $response->send();
    }
}