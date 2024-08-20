<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\FuncionDTO;

final class FuncionDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn,'funciones');
    }

    public function save(InterfaceDTO $object):void{

        $this->validate($object);
        $this->validateFuncion($object);

        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:fecha,:horaInicio,duracion,numeroFuncion,peliculaId,salaId,programacionId,precio)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
        // $stmt->execute(["nombre"=>$object->getNombre()]);// esto es una forma...
        // $this->conn->exec($sql);
    }

    public function load($id):FuncionDTO {
        
        $sql="SELECT * FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El Funcion no se cargó correctamente");

        }

        return new FuncionDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    // public function loadByName($nombre): ?FuncionDTO {
    //     $sql = "SELECT id, nombre FROM {$this->table} WHERE nombre = :nombre";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute(["nombre" => $nombre]);
    
    //     $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
    //     if (!$result) {
    //         throw new \Exception("No se encontró un Funcion con el nombre proporcionado.");
    //     }
    
    //     return new FuncionDTO($result); // Devuelve solo un objeto FuncionDTO
    // }

    public function update(InterfaceDTO $object):void{
        $this->validate($object);
        $this->validateFuncion($object);

        $sql="UPDATE {$this->table} SET 
        fecha=:fecha,
        horaInicio=:horaInicio, 
        duracion=:duracion, 
        numeroFuncion=:numeroFuncion, 
        peliculaId=:peliculaId, 
        salaId=:salaId, 
        programacionId=:programacionId,
        precio=:precio  
        
        WHERE id=:id";
        $stmt=$this ->conn->prepare($sql);
        $stmt->execute($object->toArray());

    }

    public function delete($id):void{

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


    private function validateFuncion($id): void {
        $sql = "SELECT COUNT(id) AS cantidad FROM {$this->table} WHERE FuncionId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if ($result->cantidad > 0) {
            throw new \Exception("No se puede eliminar ya que hay algun usuario que tiene este Funcion");
        }
    }



    private function validate(FuncionDTO $object):void{

        if($object->getNombre()==""){
            throw new \Exception("El campo está vacio, o puede ser que está introduciendo números en el campo");
        }

    }


}