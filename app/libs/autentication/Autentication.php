<?php

namespace app\libs\autentication;

use app\libs\connection\Connection;

final class Autentication
{
    public static function login($user, $pass): void
    {
        $conn = Connection::get();

        $sql = "SELECT CONCAT(u.nombres,'.', u.apellido) AS usuario,
        
               u.cuenta,
               u.contrasena,
               u.perfilId,
               p.nombre AS perfilNombre,
               u.id
        FROM usuarios u

        INNER JOIN perfiles p ON u.perfilId = p.id

        WHERE u.cuenta = :cuenta";

        $stmt = $conn->prepare($sql);

        if (!$stmt->execute(["cuenta" => $user])) {
            throw new \Exception("No se pudo <i>ejecutar</i> la consulta");
        }

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La contraseña o usuario es inválido usuario");
        }

        $cuenta = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!password_verify($pass, $cuenta['contrasena'])) {
            throw new \Exception("La contraseña o usuario es inválido contraseña");
        }

        // Pasó las validaciones, la cuenta es válida
        // se crean las variables de sesión;
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuario"] = $cuenta['usuario'];
        $_SESSION["perfil"] = $cuenta['perfilNombre'];
        $_SESSION["id"] = $cuenta['id'];

    }





    public static function logout(): void
    {

        session_unset();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}