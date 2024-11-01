<?php

namespace app\core\model\validation;
use app\core\model\dto\PerfilDTO;
use app\core\model\base\Validation;

final class PerfilValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "perfiles");
    }

    
    public function validateUsuarios($id): void {
        $sql = "SELECT COUNT(id) AS cantidad FROM usuarios WHERE perfilId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if ($result->cantidad > 0) {
            throw new \Exception("No se puede eliminar ya que hay algun usuario que tiene este perfil");
        }
    }

    public function validate(PerfilDTO $object):void{

        if($object->getNombre()==""){
            throw new \Exception("El campo está vacio, o puede ser que está introduciendo números en el campo");
        }

    }

    public function validateName(PerfilDTO $object):void{

        $sql ="SELECT count(id) AS cantidad FROM {$this->table} WHERE nombre=:nombre AND id!=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute($object->toArray());
        $result=$stmt->fetch(\PDO::FETCH_OBJ);//lo trae como un objeto a lo de arriba
        if($result->cantidad>0){

            throw new \Exception("El dato nombre ({$object->getNombre()}) ya existe en la base de datos");

        }
    }


}