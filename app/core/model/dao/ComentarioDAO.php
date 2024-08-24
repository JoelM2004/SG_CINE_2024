<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ComentarioDTO;

final class ComentarioDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn,'comentarios');
    }

    public function save(InterfaceDTO $object):void{
        $this->validate($object);
        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:usuarioId,:peliculaId,:comentario)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
        // $stmt->execute(["nombre"=>$object->getNombre()]);// esto es una forma...
        // $this->conn->exec($sql);
    }

    public function load($id):ComentarioDTO {
        
        $sql="SELECT * FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El comentario no se cargó correctamente");

        }

        return new ComentarioDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    public function update(InterfaceDTO $object):void{
        $this->validate($object);
        $sql="UPDATE {$this->table} SET 
        peliculaId=:peliculaId,
        usuarioId=:usuarioId,
        comentario=:comentario 
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

        $sql = "SELECT * FROM {$this->table} ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        
    }

    public function listPeli($pelicula): array
{
    $sql = "SELECT * FROM {$this->table} WHERE peliculaId = :peliculaId";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["peliculaId" => $pelicula]);

    // Recuperar todos los resultados y convertirlos en objetos ComentarioDTO
    $comentarios = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $comentarios[] = new ComentarioDTO($row);  // Aquí debes agregar a $comentarios, no a $usuarios
    }

    return $comentarios;  // Devuelve el array $comentarios
}



    private function validate(ComentarioDTO $object):void{

        if($object->getComentario()==""){
            throw new \Exception("El campo está vacio, o puede ser que está introduciendo números en el campo");
        }

    }

}