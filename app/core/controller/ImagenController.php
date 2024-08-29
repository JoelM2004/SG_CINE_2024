<?php

namespace app\core\controller;

use app\libs\request\Request;
use app\libs\response\Response;
use app\core\controller\base\Controller;
use app\core\controller\base\InterfaceController;
use app\core\service\ImagenService;

final class ImagenController extends Controller implements InterfaceController
{


    public function __construct()
    {
        parent::__construct([
            "app/js/imagen/imagenController.js",
            "app/js/imagen/imagenService.js",
            "app/js/singleton/singletonController.js",
            "app/js/singleton/singletonService.js"
        ]);
    }


    public function index(): void
    { //listo

        // $this->view = "perfil/index.php";
        // $breadcrumbActual="Imagenes";
        // $breadcrumbLink=APP_FRONT."inicio/index";
        // $breadcrumbPasada="Menu Principal";
        
        // require_once APP_TEMPLATE . "template.php";
    }

    /*
    *Gestiona los servicios correspondientes, para la busqueda de una entidad existente en el sistema, se debe enviar el id en la petición del cliente de la petición
    */
    public function load(Request $request, Response $response): void
    { //listo
        $service = new ImagenService();
        $info = $service->load($request->getId());
        $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }
    



    /*
    *Invoca la vista correspondientem para el alta de una nueva entidad
    *@param int id parametro opcional que permite la conación del registro
     */
    public function create($id): void
    { //listo
        // $this->view="perfil/alta.php";

        // $breadcrumbActual="Imagenes";
        // $breadcrumbLink=APP_FRONT."perfil/index";
        // $breadcrumbPasada="Inicio Imagenes";
        
        // require_once APP_TEMPLATE."template.php";
    }

    /*
    *Gestiona los servicios correspondientes, para el alta de una nueva entidad en el sistema
    */
    public function save(Request $request, Response $response): void
    {
        $peliculaId = isset($_POST['peliculaId']) ? intval($_POST['peliculaId']) : 0;
        $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;
        $file = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;
        $tipo=isset($_POST['tipo']) ? $_POST['tipo'] : null;

        $imageData = file_get_contents($file['tmp_name']);

        $service = new ImagenService();
            $service->save([
                'id' => 0,
                'peliculaId' => $peliculaId,
                'imagen' => $imageData,
                'estado' => $estado,
                'tipo'=>$tipo
            ]);
            $response->setMessage("La imagen se registró correctamente");
        

        $response->send();
    }


    /*
    Invoca la vista corerspondiente para poder modificar los datos de una entidad existente
    */
    public function edit($id): void
    { //listo

        // $this->view="perfil/modificar.php";

        // $breadcrumbActual="Modificar Imagenes";
        // $breadcrumbLink=APP_FRONT."perfil/create";
        // $breadcrumbPasada="Todas los Imagenes";
        
        // require_once APP_TEMPLATE."template.php";
    }

    /*
    Gestiona los servicios correspondietes apra la actualización de datos de una entidad existente
    */
    public function update(Request $request, Response $response): void
    { //en proceso y consultar
        $service = new ImagenService();

        $data= $request->getData();
        
        $info = $service->load($data["id"]);

        $info=$info->toArray();
        // var_dump($data);
        $service->update($data);
        $response->setMessage("El imagen se actualizó correctamente");
        $response->send();
    }

    /*
    Gestiona los servicios correspondietes, para la eliminación fisica de la entidad
    */
    public function delete(Request $request, Response $response): void
    { //listo
        $service = new ImagenService();
        $info=$request->getData();
        $service->delete($info["id"]);
        $response->setMessage("El Imagen se eliminó con éxito");
        $response->send();
    }

    public function list(Request $request, Response $response): void
    {
        $service = new ImagenService();
        $response->setResult($service->list());
        $response->setMessage("El perfil se listó correctamente");
        $response->send();
    }

    public function loadImagen(Request $request, Response $response): void
    { //listo
        $service = new ImagenService();
        $info = $service->loadImagen($request->getId());
        // $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }

    public function listImagenes(Request $request, Response $response): void
    { //listo
        $service = new ImagenService();
        $info = $service->listImagenes($request->getId());
        // $info=$info->toArray();
        $response->setResult($info);
        $response->setMessage("La cuenta se cargó correctamente");

        $response->send();
    }

}