<?php

namespace app\core\controller;
use app\core\controller\base\Controller;

final class InfoController extends Controller
{
    public function __construct()
    {
        parent::__construct([
            
        ]);
    }

    public function index(): void
    { //listo

        $this->view = "info/index.php";
        $titulo = "Bienvenido a Los Pollos Hermanos";

        $breadcrumbActual="Acerca de nosotros";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menu Principal";
        
        require_once APP_TEMPLATE . "template.php";
    }

    
}