<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ImagenDTO implements InterfaceDTO
{
    private $id, $peliculaId, $imagen, $estado,$tipo;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setPeliculaId($data["peliculaId"] ?? 0);
        $this->setImagen($data["imagen"] ?? "");
        $this->setEstado($data["estado"] ?? 0);
        $this->setTipo($data["tipo"]??0);
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

    public function getEstado(): int
    {
        return $this->estado;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function getTipo(): string
    {
        return $this->tipo;
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
        
        $this->imagen = (is_string($imagen) && !empty($imagen)) ? $imagen : "";
    }
    
    public function setTipo($imagen): void
    {
        
        $this->tipo = (is_string($imagen) && !empty($imagen)) ? $imagen : "";
    }

    public function setEstado($estado): void
    {
        $this->estado = ($estado === 0 || $estado === 1) ? trim($estado) : 1;
    }
    // Métodos Públicos //
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "peliculaId" => $this->getPeliculaId(),
            "imagen" => $this->getImagen(),
            "estado"=>$this->getEstado(),
            "tipo"=>$this->getTipo()
        ];
    }
}
