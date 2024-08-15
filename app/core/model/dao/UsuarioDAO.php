<?php

namespace app\core\model\dao;

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



        // $stmt->execute([
        //     ':nombres' => $object->getNombres(),
        //     ':apellido' => $object->getApellido(),
        //     ':cuenta' => $object->getCuenta(),
        //     ':correo' => $object->getCorreo(),
        //     ':perfilId' => $object->getPerfilId(),
        //     ':id' => $object->getId()
        // ]);
    }

    public function changePassword(InterfaceDTO $object): void
    {

        $clave = password_hash($object->getClave(), PASSWORD_DEFAULT);

        $sql = "UPDATE {$this->table} SET clave = :clave WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':clave' => $clave,
            ':id' => $object->getId()
        ]);
    }

    public function loadByNameAccount($cuenta):UsuarioDTO{
         $sql = "SELECT id,cuenta,nombres,clave,correo,perfilId,apellido  FROM {$this->table} WHERE cuenta = :cuenta";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(["cuenta" => $cuenta]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("El Usuario no se cargó correctamente");
        }

        return new UsuarioDTO($stmt->fetch(\PDO::FETCH_ASSOC));

    }

    public function loadByPerfil($perfil): array {
        $sql = "SELECT id, cuenta, nombres, clave, correo, perfilId, apellido FROM {$this->table} WHERE perfilId = :perfilId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["perfilId" => $perfil]);
    
        // Recuperar todos los resultados y convertirlos a objetos UsuarioDTO
        $usuarios = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $usuarios[] = new UsuarioDTO($row);
        }
    
        return $usuarios;
    }

    public function delete($id): void
    {

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

    private function validate(UsuarioDTO $object): void
    {
        // Lista de métodos a verificar
        $atributos = [
            'getNombres',
            'getApellido',
            'getCuenta',
            'getClave',
            'getCorreo',
            'getPerfilId',
        ];

        foreach ($atributos as $atributo) {
            if (method_exists($object, $atributo) && $object->{$atributo}() === "") {
                throw new \Exception("El dato del usuario es obligatorio: " . $atributo);
            }
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
}
