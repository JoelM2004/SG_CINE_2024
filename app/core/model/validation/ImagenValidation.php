<?php

namespace app\core\model\validation;
use app\core\model\dto\ImagenDTO;
use app\core\model\base\Validation;

final class ImagenValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "imagenes");
    }

    public function validate(ImagenDTO $object): void
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

    public function validateEstado(ImagenDTO $object): void
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

}