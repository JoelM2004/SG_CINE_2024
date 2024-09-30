<?php


namespace app\core\model\dao;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//use Exception;
//use Swift_SmtpTransport;
//use Swift_Mailer;
//use Swift_Message;
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
        $this->existePerfil($object->getPerfilId());
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
        $this->existePerfil($object->getPerfilId());
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
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP para Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';           
        $mail->SMTPAuth = true;
        $mail->Username = CORREO;                 // Tu correo de Gmail
        $mail->Password = CLAVECORREO;            // Tu contraseña de Gmail o contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el correo emisor y el destinatario
        $mail->setFrom(CORREO, 'Soporte Los Pollos Hermanos');
        $mail->addAddress($email);

        // Configuración del contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nueva Clave - Los Pollos Hermanos';
        $mail->Body = '
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <style>
                @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Lobster&display=swap");
                body {
                    font-family: "Roboto", sans-serif;
                    background-color: #f3f4f6;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 40px auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    font-family: "Lobster", cursive;
                    color: #ff4c29;
                    text-align: center;
                    font-size: 2.4em;
                    margin-bottom: 20px;
                }
                .hero {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .hero img {
                    max-width: 100%;
                    border-radius: 12px;
                }
                p {
                    color: #333;
                    font-size: 1.1em;
                    margin-bottom: 20px;
                    text-align: center;
                }
                .password {
                    font-size: 1.5em;
                    font-weight: bold;
                    color: #ff4c29;
                    text-align: center;
                    margin-bottom: 30px;
                }
                .button {
                    display: inline-block;
                    padding: 15px 25px;
                    background-color: #ff4c29;
                    color: #fff;
                    font-size: 1.2em;
                    text-align: center;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: bold;
                    margin: 0 auto;
                    display: block;
                    width: fit-content;
                }
                .footer {
                    text-align: center;
                    font-size: 0.9em;
                    color: #666;
                    margin-top: 30px;
                }
                .footer p {
                    margin: 0;
                }
                .footer .logo {
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Los Pollos Hermanos</h1>
                <div class="hero">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSientdDH2E2U01fPNX8TtIw9S8Sd2gVDk_9g&s" alt="Los Pollos Hermanos Banner">
                </div>
                <p>Hola,</p>
                <p>Has solicitado recuperar tu contraseña. Aquí está tu nueva contraseña:</p>
                <div class="password">' . htmlspecialchars($password) . '</div>
                <p>Por favor, cámbiala después de iniciar sesión.</p>
                <a href="' . APP_FRONT . 'autentication/index" class="button">Iniciar Sesión</a>
                <div class="footer">
                    <p>Saludos,</p>
                    <p>El equipo de soporte de <strong>Los Pollos Hermanos</strong></p>
                </div>
            </div>
        </body>
        </html>';

        // Enviar el correo
        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar el correo: {$mail->ErrorInfo}");
    }
}


    private function generateRandomPassword(int $minLength, int $maxLength): string
    {
        $length = rand($minLength, $maxLength);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
            
        where u.cuenta like :id

        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $cuenta."%"]);
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
        $stmt->execute(["id" => $perfil]);
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

        if ($object->getCorreo() == "") {
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

    private function existePerfil($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad 
            FROM perfiles f
            WHERE f.id = :id";

        $stmt = $this->conn->prepare($sql);

        // Parámetro id
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        // Retorna true si la función existe y está vigente
        if ($result->cantidad == 0) throw  new \Exception("No existe esté perfil");
    }
}
