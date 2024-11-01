<?php
namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\validation\SalaValidation;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\SalaDTO;

final class SalaDAO extends DAO implements InterfaceDAO
{

    public function __construct($conn)
    {
        parent::__construct($conn, "salas");
    }

    public function save(InterfaceDTO $object): void
    {

        $validation= new SalaValidation($this->conn);
        $validation->validate($object);
        $validation->validateNumeroSala($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:capacidad,:estado,:numeroSala)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute($data);
        $object->setId((int)$this->conn->lastInsertId());
    }

    public function load($id): SalaDTO
    {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("La sala no se cargó correctamente");
        }

        return new SalaDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void
    {

        $validation= new SalaValidation($this->conn);
        $validation->validate($object);
        $validation->validateNumeroSala($object);

        $sql = "UPDATE {$this->table} 
                SET capacidad = :capacidad, 
                    estado = :estado, 
                    numeroSala = :numeroSala
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $data = $object->toArray();

    // Ejecutar la consulta con los datos del objeto
        $stmt->execute($data);
    }

    public function loadByEstado($estado): array {
        $sql = "SELECT * FROM {$this->table} WHERE estado = :estado";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["estado" => $estado]);
    
        // Recuperar todos los resultados y convertirlos a objetos UsuarioDTO
        $salas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $salas[] = new SalaDTO($row);
        }
    
        return $salas;
    }

    public function loadByCapacidad($min,$max): array {
        $sql = "SELECT * FROM {$this->table} WHERE capacidad <= :max AND capacidad>= :min";
         $stmt = $this->conn->prepare($sql);
        $stmt->execute(["max" => $max,
                         "min"=>$min]);
    
         // Recuperar todos los resultados y convertirlos a objetos UsuarioDTO
         $salas = [];
         while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
             $salas[] = new SalaDTO($row);
        }
    
         return $salas;
     }



    
     public function loadByNumeroSala($numeroSala):SalaDTO{
        $sql = "SELECT * FROM {$this->table} WHERE numeroSala = :numeroSala";
       $stmt = $this->conn->prepare($sql);

      $stmt->execute(["numeroSala" => $numeroSala]);

       if ($stmt->rowCount() !== 1) {

           throw new \Exception("La sala no se cargaron correctamente");
       }

      return new SalaDTO($stmt->fetch(\PDO::FETCH_ASSOC));

    }

    public function delete($id): void
    {
        $validation= new SalaValidation($this->conn);
        $validation->validatefunciones($id);
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