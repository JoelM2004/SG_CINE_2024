<?php
namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ImagenDTO;

final class ImagenDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "imagenes");
    }

    public function save(InterfaceDTO $object): void
    {
        $this->validate($object);
        $this->validateEstado($object);
        
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


    private function validateEstado(ImagenDTO $object): void
    {
        // Consultar si ya existe una programación vigente (vigente = 1), excluyendo el id actual
        $sql = "SELECT COUNT(id) AS cantidad 
            FROM {$this->table} 
            WHERE estado = 1 AND peliculaId = :peliculaId";
        $stmt = $this->conn->prepare($sql);

        $params = [
            ':peliculaId' => $object->getPeliculaId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if (($object->getEstado()==1) && ($result->cantidad > 0)) {
            throw new \Exception("Ya hay una imagen determinada como portada");
        }
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
                $Imagenes[]= "data:" . $row["tipo"] . ";base64," . base64_encode($row["imagen"]);
            } 
        }
        return $Imagenes;

    
}



    public function update(InterfaceDTO $object): void
    {
        $this->validate($object);
        $this->validateEstado($object);
        $sql = "UPDATE {$this->table} SET imagen = :imagen WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        $stmt->execute($data);
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

    private function validate(ImagenDTO $object): void
    {
        // Validar el ID (opcional para nuevos registros)
        if ($object->getId() < 0) {
            throw new \Exception("El ID debe ser un número entero positivo.");
        }

        // Validar el ID de la película
        if ($object->getPeliculaId() <= 0) {
            throw new \Exception("El ID de la película debe ser un número entero positivo y mayor que cero.");
        }

        // Validar la imagen
        if (empty($object->getImagen()) || !is_string($object->getImagen())) {
            throw new \Exception("La imagen no puede estar vacía y debe ser una cadena válida.");
        }

        if (empty($object->getTipo()) || !is_string($object->getTipo())) {
            throw new \Exception("El tipo de imagen no puede estar vacía y debe ser una cadena válida.");
        }

        
    }
}
