<?php

namespace app\core\middleware;

use app\core\middleware\base\Middleware;
use app\core\middleware\base\InterfaceMiddleware;
use app\libs\request\Request;
use app\libs\response\Response;

final class PerfilMiddleware extends Middleware implements InterfaceMiddleware {

    public function handler(Request $request, Response $response): void {
        // Verificar si la variable de sesión 'perfilId' existe
        if (isset($_SESSION["token"]) && $_SESSION["token"] == APP_TOKEN) {
            $perfil = $_SESSION["perfil"];
        } else {
            $this->next($request, $response);
            return;
        }

        // Obtener la ruta actual
        $ruta = $request->getController()."/";
        $rutaAccion=$request->getController()."/".$request->getAction();

        // Verificación para redireccionar si ya está autenticado y está intentando acceder a autenticación
        if (isset($_SESSION["token"]) && $_SESSION["token"] === APP_TOKEN && $request->getController() == "autentication" &&$request->getAction()!="logout") {
            header("Location: " . APP_FRONT . "inicio/index");
            die();
        }

        // Verificar si el usuario tiene permisos para la ruta específica
        if ($this->tienePermisoController($perfil, $ruta)||$this->tienePermisoAccion($perfil, $rutaAccion)) {
            // Pasar el control al siguiente middleware
            $this->next($request, $response);
        } else {
            // Si no tiene permiso, redirigir a la página de inicio
            header("Location: " . APP_FRONT . "inicio/index");
            die();
        }
    }

    private function tienePermisoController(string $tipoUsuario, string $ruta): bool {
        $permisos = [
            'Administrador' => ['*'], // El administrador tiene acceso a todas las rutas
            'Operador' => ["inicio/", "autentication/","entrada/","imagen/", "programacion/","funcion/","info/","comentario/"], 
            'Externos' => ["inicio/", "autentication/","info/","imagen/","comentario/"]
        ];

        // Asegurarse de que el tipo de usuario se ajuste a uno de los permitidos
        if (!in_array($tipoUsuario, array_keys($permisos))) {
            $tipoUsuario = "Externos";
        }

        // Comprobar permisos
        return in_array('*', $permisos[$tipoUsuario]) || in_array($ruta, $permisos[$tipoUsuario]);
    }

    private function tienePermisoAccion(string $tipoUsuario, string $ruta): bool {
        $permisos = [
            'Administrador' => ['*'], // El administrador tiene acceso a todas las rutas
            'Operador' => ["usuario/view","usuario/changePassword","pelicula/view","pelicula/load"], 
            'Externos' => ["usuario/view","usuario/changePassword","pelicula/view","entrada/view","funcion/view","funcion/listFunciones","entrada/saveCliente"]
        ];
        // Asegurarse de que el tipo de usuario se ajuste a uno de los permitidos
        if (!in_array($tipoUsuario, array_keys($permisos))) {
            $tipoUsuario = "Externos";
        }
        // Comprobar permisos
        return in_array('*', $permisos[$tipoUsuario]) || in_array($ruta, $permisos[$tipoUsuario]);

    }


}
