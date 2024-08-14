<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAOsimple;
use app\core\model\dto\GeneroDTO;

final class GeneroDAO extends DAO implements InterfaceDAOsimple
{
    public function __construct($conn)
    {
        parent::__construct($conn,'generos');
    }

    public function load($id):GeneroDTO {
        
        $sql="SELECT id,nombre FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El género no se cargó correctamente");

        }

        return new GeneroDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    public function list():array{

        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
    }
}