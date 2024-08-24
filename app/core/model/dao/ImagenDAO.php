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

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT, :peliculaId, :imagen)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute($data);
        $object->setId((int)$this->conn->lastInsertId());
    }

    public function load($id): ImagenDTO
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La imagen no se cargó correctamente");
        }

        return new ImagenDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function update(InterfaceDTO $object): void
    {
        $this->validate($object);

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

        // // Validar que no haya más de una imagen por película
        // $sql = "SELECT COUNT(*) FROM {$this->table} WHERE peliculaId = :peliculaId";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->execute(['peliculaId' => $object->getPeliculaId()]);
        // $count = $stmt->fetchColumn();

        // // Si existe al menos una imagen con el mismo peliculaId, lanzar una excepción
        // if ($count > 0) {
        //     throw new \Exception("Ya existe una imagen para la película con ID {$object->getPeliculaId()}. Cada película debe tener una única imagen.");
        // }
    }
}
