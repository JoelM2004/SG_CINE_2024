<?php

namespace app\core\controller;
use app\core\controller\base\Controller;

final class ComentarioController extends Controller
{


    public function __construct()
    {
        parent::__construct([
            "assets/libs/js/viewComentario.js"
        ]);
    }

    public function index(): void
    { //listo

        $this->view = "comentario/index.php";
        
        $breadcrumbActual="Tu Opinión";
        $breadcrumbLink=APP_FRONT."pelicula/view";
        $breadcrumbPasada="Pelicula";
        
        require_once APP_TEMPLATE . "template.php";
    }
}