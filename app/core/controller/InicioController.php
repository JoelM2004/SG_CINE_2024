<?php

namespace app\core\controller;
use app\core\controller\base\Controller;

final class InicioController extends Controller
{


    public function __construct()
    {
        parent::__construct([
            
        ]);
    }


    public function index(): void
    { //listo

        $this->view = "inicio/index.php";
        $titulo = "Menú Principal Perfil";

        $breadcrumbActual="";
        $breadcrumbLink=APP_FRONT."usuario/index";
        $breadcrumbPasada="Menu Principal";
        
        require_once APP_TEMPLATE . "template.php";
    }
}