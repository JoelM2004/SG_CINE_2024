<?php
namespace app\core\model\dao;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ImagenDTO;

use app\core\model\validation\ImagenValidation;

final class ImagenDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "imagenes");
    }

    public function save(InterfaceDTO $object): void
    {
        $validation= new ImagenValidation($this->conn);

        $validation->validate($object);
        $validation->validateEstado($object);
        
        $sql = "INSERT INTO {$this->table} (id, peliculaId, imagen, estado,tipo) VALUES (DEFAULT, :peliculaId, :imagen, :estado,:tipo)";

        
        $stmt = $this->conn->prepare($sql);
        
        $data = [
            ':peliculaId' => $object->getPeliculaId(),
            ':imagen' => $object->getImagen(),
            ':estado' => $object->getEstado(),
            ':tipo'=>$object->getTipo()
        ];
        
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $stmt->bindValue($key, $value, (\PDO::PARAM_STR));
            } elseif (is_int($value)) {
                $stmt->bindValue($key, $value, (\PDO::PARAM_INT));
            } else {
                $stmt->bindValue($key, $value, (\PDO::PARAM_LOB));
            }
        }
        
        $stmt->execute();
        
        $object->setId((int)$this->conn->lastInsertId());
    }

    public function load($id): ImagenDTO
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id AND estado=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La imagen no se cargó correctamente");
        }

        return new ImagenDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function loadImagen($id): string
{
    $sql = "SELECT * FROM {$this->table} WHERE peliculaId = :peliculaId AND estado=1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["peliculaId" => $id]);

    if ($stmt->rowCount() !== 1) {
        // En lugar de lanzar una excepción, puedes manejarlo de otra manera
        return ''; // Devuelve una cadena vacía si no hay imagen
    }

    $imageData = $stmt->fetch(\PDO::FETCH_ASSOC);

    // Verifica que 'imagen' y 'tipo' están presentes
    if (!empty($imageData["imagen"]) && !empty($imageData["tipo"])) {
        return "data:" . $imageData["tipo"] . ";base64," . base64_encode($imageData["imagen"]);
    } else {
        return ''; // Devuelve una cadena vacía si no hay datos de imagen
    }
}

public function listImagenes($id): array
{
    $sql = "SELECT * FROM {$this->table} WHERE peliculaId = :peliculaId";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["peliculaId" => $id]);

    $Imagenes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if (!empty($row["imagen"]) && !empty($row["tipo"])) {
                $Imagenes[]= ["imagen"=>("data:" . $row["tipo"] . ";base64," . base64_encode($row["imagen"])),"id"=>$row["id"],"peliculaId"=>$row["peliculaId"]];
            } 
        }
        return $Imagenes;

    
}



public function update(InterfaceDTO $object): void
{
    $sqlReset = "UPDATE {$this->table} SET estado = 0 WHERE peliculaId = :peliculaId";
    $stmtReset = $this->conn->prepare($sqlReset);
    $stmtReset->execute([
        ':peliculaId' => $object->getPeliculaId()
    ]);

    $sqlUpdate = "UPDATE {$this->table} SET estado = 1 WHERE id = :id";
    $stmtUpdate = $this->conn->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':id' => $object->getId()
    ]);
}


    public function delete($id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);
    }

    public function list(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
