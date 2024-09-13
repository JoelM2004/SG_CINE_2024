<?php

namespace app\core\middleware;

use app\core\middleware\base\Middleware;
use app\core\middleware\base\InterfaceMiddleware;
use app\core\model\dao\EntradaDAO;
use app\libs\request\Request;
use app\libs\response\Response;

use app\core\model\dao\PerfilDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dao\SalaDAO;
use app\libs\Connection\Connection;



final class IdMiddleware extends Middleware implements InterfaceMiddleware {

    public function handler(Request $request, Response $response): void {
        // Obtener datos del request
        $id = $request->getId();
        $controlador = $request->getController();
        $accion = $request->getAction();
        
        // Verificar si es una acción de edición de perfil
        if ($controlador === "perfil" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new PerfilDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "perfil/create");
            die();
        }

        if ($controlador === "usuario" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new UsuarioDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "usuario/create");
            die();
        }

        if ($controlador === "funcion" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new FuncionDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "funcion/create");
            die();
        }

        if ($controlador === "sala" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new SalaDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "sala/create");
            die();
        }

        if ($controlador === "entrada" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new EntradaDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "entrada/create");
            die();
        }

        if ($controlador === "pelicula" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new PeliculaDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "pelicula/create");
            die();
        }
        
        if ($controlador === "pelicula" && $accion === "view") {
            $conn = Connection::get();
            $dao = new PeliculaDAO($conn);
            if($dao->existeCartelera($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
            die();
        }

        if ($controlador === "comentario" && $accion === "index") {
            $conn = Connection::get();
            $dao = new PeliculaDAO($conn);
            if($dao->existeCartelera($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
            die();
        }

        if ($controlador === "funcion" && $accion === "view") {
            $conn = Connection::get();
            $dao = new PeliculaDAO($conn);
            if($dao->existeCartelera($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
            die();
        }

        if ($controlador === "entrada" && $accion === "view") {
            $conn = Connection::get();
            $dao = new FuncionDAO($conn);

            

            if($dao->existeCartelera($id)){
                $this->next($request, $response);   
            }else header("refresh:0.1;url=" . APP_FRONT . "inicio/index");
            die();
        }

        if ($controlador === "programacion" && $accion === "edit") {
            $conn = Connection::get();
            $dao = new ProgramacionDAO($conn);
            if($dao->existe($id)){
                $this->next($request, $response);
            }else header("refresh:0.1;url=" . APP_FRONT . "programacion/create");
            die();
        }

        // Pasar el control al siguiente middleware si el ID es válido o no es necesario verificar
        $this->next($request, $response);
    
    }
}