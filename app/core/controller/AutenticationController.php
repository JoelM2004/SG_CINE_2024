<?php

namespace app\core\controller;

use app\core\controller\base\Controller;
use app\libs\autentication\Autentication;
use app\libs\request\Request;
use app\libs\response\Response;

final class AutenticacionController extends Controller
{

    public function __construct()
    {
        parent::__construct([
            "app/js/autentication/authController.js",
             "app/js/autentication/authService.js"
        ]);
    }


    public function index(): void
    {
        $this->view = "autenticacion/index.php";
        $titulo = "Bienvenido";
        $breadcrumb = "Menú Principal";
        require_once APP_TEMPLATE . "template.php";
    }

    public function login(Request $request, Response $response): void{
        $data = $request->getData();

        Autentication::login($data["usuario"], $data["clave"]);
        $response->setMessage("OK");

        $response->send();
    }

    public function logout(): void{
        
        Autentication::logout();

        $this->view = "autenticacion/logout.php";
        $titulo = "Cerrando Sesión";
        
        require_once APP_TEMPLATE . "template.php";
        header("refresh:5;url=" . APP_FRONT . "autenticacion/index");
    }
}