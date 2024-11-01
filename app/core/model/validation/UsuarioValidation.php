<?php

namespace app\core\model\validation;
use app\core\model\dto\UsuarioDTO;
use app\core\model\base\Validation;

final class UsuarioValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "usuarios");
    }

    public function validateComentarios($id): void
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

    public function validateEntradas($id): void
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

    public function existePerfil($id): void
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

    public function validate(UsuarioDTO $object): void
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

    public function validateCorreo(UsuarioDTO $object): void
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

    public function validateCorreoExiste(array $object): void
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

    public function validateCuenta(UsuarioDTO $object): void
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

}