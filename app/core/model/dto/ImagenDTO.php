<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ImagenDTO implements InterfaceDTO
{
    private $id, $peliculaId, $imagen;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setPeliculaId($data["peliculaId"] ?? 0);
        $this->setImagen($data["imagen"] ?? "");
    }

    // Getters //
    public function getId(): int
    {
        return $this->id;
    }

    public function getPeliculaId(): int
    {
        return $this->peliculaId;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    // Setters //
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setPeliculaId($peliculaId): void
    {
        $this->peliculaId = (is_integer($peliculaId) && $peliculaId > 0) ? $peliculaId : 0;
    }

    public function setImagen($imagen): void
    {
        // Validar si imagen es una cadena binaria no vacía
        $this->imagen = (is_string($imagen) && !empty($imagen)) ? $imagen : "";
    }

    // Métodos Públicos //
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "peliculaId" => $this->getPeliculaId(),
            "imagen" => $this->getImagen()
        ];
    }
}
