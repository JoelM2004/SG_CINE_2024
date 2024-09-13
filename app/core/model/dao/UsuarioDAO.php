<?php


namespace app\core\model\dao;

use Exception;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\UsuarioDTO;

final class UsuarioDAO extends DAO implements InterfaceDAO
{

    public function __construct($conn)
    {
        parent::__construct($conn, "usuarios");
    }


    public function save(InterfaceDTO $object): void
    {

        $this->validate($object);
        $clave = password_hash($object->getClave(), PASSWORD_DEFAULT);
        $this->validateCuenta($object);
        $this->validateCorreo($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:cuenta,:nombres,:clave,:correo,:perfilId,:apellido)"; //:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $data["clave"] = $clave;
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());

        // $this->conn->exec($sql);
    }

    public function load($id): UsuarioDTO
    {

        $sql = "SELECT id,cuenta,nombres,clave,correo,perfilId,apellido  FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("El perfil no se cargó correctamente");
        }

        return new UsuarioDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void
    {
        $this->validate($object);
        $this->validateCorreo($object);
        $this->validateCuenta($object);
        // $object =parse_ini_file(UsuarioDTO,$object);

        $sql = "UPDATE {$this->table} 
                SET nombres = :nombres, 
                    apellido = :apellido, 
                    cuenta = :cuenta, 
                    correo = :correo, 
                    perfilId = :perfilId
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $data = $object->toArray();

        unset($data["clave"]);
        // Ejecutar la consulta con los datos del objeto
        $stmt->execute($data);
    }

    public function changePassword(array $object): void
    {

        $this->verificarPassword($object);
        $clave = password_hash($object["nueva"], PASSWORD_DEFAULT);

        $sql = "UPDATE {$this->table} SET clave = :clave WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':clave' => $clave,
            ':id' => $object["id"]
        ]);
    }

    public function forgetPassword(array $object): void
    {
        $this->validateCorreoExiste($object);
        $clave = $this->generateRandomPassword(8, 44);
        $claveHash = password_hash($clave, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE {$this->table} SET clave = :clave WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':clave' => $claveHash,
            ':correo' => $object["correo"],
        ]);

        // Enviar el correo con la nueva contraseña
        $this->sendPasswordByEmail($object["correo"], $clave);
    }

    function sendPasswordByEmail(string $email, string $password): void
    {
        // Configuración del transporte SMTP para Hotmail/Outlook
        $transport = (new Swift_SmtpTransport('smtp.office365.com', 587, 'tls'))
            ->setUsername(CORREO) // Tu correo de Hotmail/Outlook
            ->setPassword(CLAVECORREO); // Tu contraseña de Hotmail/Outlook
        // Crear el mailer usando el transporte SMTP
        $mailer = new Swift_Mailer($transport);

        // Crear un mensaje
        $message = (new Swift_Message('Recuperación de Contraseña'))
            ->setFrom([CORREO => 'Soporte'])
            ->setTo([$email])
            ->setBody(
                '<html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 0; background-color: #f4f4f4; }
                        .container { width: 90%; max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; }
                        h1 { color: #007bff; }
                        p { margin: 10px 0; }
                        .password { font-size: 1.2em; font-weight: bold; color: #007bff; }
                        .footer { font-size: 0.9em; color: #666; margin-top: 20px; }
                        .button { display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
                        .logo { display: block; margin: 0 auto; max-width: 200px; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Recuperación de Contraseña</h1>
                        <p>Hola,</p>
                        <p>Has solicitado recuperar tu contraseña. Aquí está tu nueva contraseña:</p>
                        <p class="password"><strong>' . htmlspecialchars($password) . '</strong></p>
                        <p>Por favor, cámbiala después de iniciar sesión.</p>
                        <a href="' . APP_FRONT . 'autentication/index" class="button">Iniciar Sesión</a>
                        <div class="footer">
                            <p>Saludos,</p>
                            <p>El equipo de soporte de <strong>Los Pollos Hermanos</strong></p>
                        </div>
                    </div>
                </body>
            </html>',
                'text/html'
            );

        try {
            $result = $mailer->send($message);
        } catch (Exception $e) {
            error_log("Error al enviar el correo: " . $e->getMessage());
        }
    }

    private function generateRandomPassword(int $minLength, int $maxLength): string
    {
        $length = rand($minLength, $maxLength);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=<>?';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }


    private function verificarPassword(array $object): void
    {
        // Consultar el hash de la contraseña actual desde la base de datos
        $sql = "SELECT clave FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $object["id"]]);

        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if (!$result) {
            throw new \Exception("El usuario no existe.");
        }

        $claveAlmacenada = $result->clave;

        // Verificar la contraseña ingresada con el hash almacenado
        if (!password_verify($object["actual"], $claveAlmacenada)) {
            throw new \Exception("La contraseña actual es incorrecta, asegúrate de introducir la contraseña correcta para continuar.");
        }
    }


    public function loadByNameAccount($cuenta): array
    {
        $sql = "SELECT
        u.id, 
        u.cuenta,
        u.nombres,
        u.correo,
        u.apellido,
        p.nombre as perfil

        FROM {$this->table} u
        inner join perfiles p on u.perfilId=p.id
            
        where u.cuenta = :id

        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$cuenta]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByPerfil($perfil): array
    {
        $sql = "SELECT
        u.id, 
        u.cuenta,
        u.nombres,
        u.correo,
        u.apellido,
        p.nombre as perfil

        FROM {$this->table} u
        inner join perfiles p on u.perfilId=p.id

        where p.id = :id

        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$perfil]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id): void
    {
        $this->validateComentarios($id);
        $this->validateEntradas($id);
        $sql = "DELETE FROM {$this->table} WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([

            "id" => $id

        ]);
    }

    public function list(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listUsu(): array
    {
        $sql = "SELECT
        u.id, 
        u.cuenta,
        u.nombres,
        u.correo,
        u.apellido,
        p.nombre as perfil

        FROM {$this->table} u
        inner join perfiles p on u.perfilId=p.id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function validate(UsuarioDTO $object): void
    {
        if ($object->getNombres() == "") {
            throw new \Exception("El campo 'Nombres' está vacío o contiene caracteres no permitidos.");
        }

        if ($object->getApellido() == "") {
            throw new \Exception("El campo 'Apellido' está vacío o contiene caracteres no permitidos.");
        }

        if ($object->getCuenta() == "") {
            throw new \Exception("El campo 'Cuenta' está vacío o contiene caracteres no permitidos.");
        }

        if ($object->getClave() == "") {
            throw new \Exception("El campo 'Clave' está vacío o contiene caracteres no permitidos.");
        }

        if ($object->getCorreo()=="") {
            throw new \Exception("El campo 'Correo' no es válido.");
        }

        if ($object->getPerfilId() <= 0) {
            throw new \Exception("El campo 'Perfil ID' debe ser un número mayor que cero.");
        }
    }


    private function validateCorreo(UsuarioDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE correo = :correo AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':correo' => $object->getCorreo(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato correo ({$object->getCorreo()}) ya existe en la base de datos");
        }
    }

    private function validateCorreoExiste(array $object): void
    {
        $sql = "SELECT count(u.id) AS cantidad FROM {$this->table} u
        inner join perfiles p on u.perfilId=p.id
        WHERE u.correo = :correo AND p.nombre='Externos'";
        $stmt = $this->conn->prepare($sql);

        $params = [
            ':correo' => $object["correo"]
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if ($result->cantidad == 0) {
            throw new \Exception("El dato correo ({$object["correo"]}) no existe en la base de datos o usted está deseando cambiar la contraseña de un tipo de cuenta que no está permitido, en este caso, comuníquese con un Administrador");
        }
    }

    private function validateCuenta(UsuarioDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE cuenta = :cuenta AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':cuenta' => $object->getCuenta(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato cuenta ({$object->getCuenta()}) ya existe en la base de datos");
        }
    }

    public function existe($id): bool
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            return true;
        } else return false;
    }

    private function validateComentarios($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM comentarios f WHERE f.usuarioId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El usuario tiene un comentario en una o más películas, deberá eliminarlos para poder seguir");
        }
    }

    private function validateEntradas($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM entradas f WHERE f.usuarioId = :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El usuario tiene comprada una o más entradas, no lo podrá eliminar");
        }
    }
}
