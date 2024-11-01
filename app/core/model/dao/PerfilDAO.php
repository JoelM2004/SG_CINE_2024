<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\PerfilDTO;

use app\core\model\validation\PerfilValidation;

final class PerfilDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn,'perfiles');
    }

    public function save(InterfaceDTO $object):void{

        $validation= new PerfilValidation($this->conn);

        $validation->validate($object);
        $validation->validateName($object);

        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:nombre)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
        // $stmt->execute(["nombre"=>$object->getNombre()]);// esto es una forma...
        // $this->conn->exec($sql);
    }

    public function load($id):PerfilDTO {
        
        $sql="SELECT id,nombre FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El perfil no se cargó correctamente");

        }

        return new PerfilDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    public function loadByName($nombre): ?PerfilDTO {
        $sql = "SELECT id, nombre FROM {$this->table} WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["nombre" => $nombre]);
    
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if (!$result) {
            throw new \Exception("No se encontró un perfil con el nombre proporcionado.");
        }
    
        return new PerfilDTO($result); // Devuelve solo un objeto PerfilDTO
    }

    public function update(InterfaceDTO $object):void{
        $validation= new PerfilValidation($this->conn);
        $validation->validate($object);
        $validation->validateName($object);

        $sql="UPDATE {$this->table} SET nombre=:nombre WHERE id=:id";
        $stmt=$this ->conn->prepare($sql);
        $stmt->execute($object->toArray());

    }
    public function delete($id):void{
        
        $validation= new PerfilValidation($this->conn);
        $validation->validateUsuarios($id);
        $sql="DELETE FROM {$this->table} WHERE id= :id";
        $stmt=$this ->conn->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
    
    }

    public function list():array{

        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
    }

    public function listID():array{
        $sql = "SELECT id FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function existe($id): bool{
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
}