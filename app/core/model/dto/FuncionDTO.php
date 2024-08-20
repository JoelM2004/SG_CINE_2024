<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class FuncionDTO implements InterfaceDTO
{

    private $id, $fecha, $horaInicio, $duracion, $numeroFuncion, $peliculaId, $salaId, $programacionId, $precio;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setFecha($data["fecha"] ?? "");
        $this->setHoraInicio($data["horaInicio"] ?? "");
        $this->setDuracion($data["duracion"] ?? 0);
        $this->setNumeroFuncion($data["numeroFuncion"] ?? 0);
        $this->setPeliculaId($data["peliculaId"] ?? 0);
        $this->setSalaId($data["salaId"] ?? 0);
        $this->setProgramacionId($data["programacionId"] ?? 0);
        $this->setPrecio($data["precio"] ?? 0);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getHoraInicio(): string
    {
        return $this->horaInicio;
    }

    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function getNumeroFuncion(): int
    {
        return $this->numeroFuncion;
    }

    public function getPeliculaId(): int
    {
        return $this->peliculaId;
    }

    public function getSalaId(): int
    {
        return $this->salaId;
    }

    public function getProgramacionId(): int
    {
        return $this->programacionId;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    // Setters
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) ? $fecha : "";
    }
    
    public function setHoraInicio($horaInicio): void
{
    // Verifica que la hora y los minutos estén en el formato correcto
    if (preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $horaInicio)) {
        // Agrega los segundos al final
        $horaInicio .= ":00";
        // Verifica que la hora completa sea válida
        $this->horaInicio = (strtotime($horaInicio) !== false) ? $horaInicio : "";
    } else {
        $this->horaInicio = "";
    }
}

    public function setDuracion($duracion): void
    {
        $this->duracion = (is_integer($duracion) && $duracion > 0) ? $duracion : 0;
    }

    public function setNumeroFuncion($numeroFuncion): void
    {
        $this->numeroFuncion = (is_integer($numeroFuncion) && $numeroFuncion > 0) ? $numeroFuncion : 0;
    }

    public function setPeliculaId($peliculaId): void
    {
        $this->peliculaId = (is_integer($peliculaId) && $peliculaId > 0) ? $peliculaId : 0;
    }

    public function setSalaId($salaId): void
    {
        $this->salaId = (is_integer($salaId) && $salaId > 0) ? $salaId : 0;
    }

    public function setProgramacionId($programacionId): void
    {
        $this->programacionId = (is_integer($programacionId) && $programacionId > 0) ? $programacionId : 0;
    }

    public function setPrecio($precio): void
    {
        $this->precio = (is_numeric($precio) && $precio > 0) ? (double) $precio : 0.0;
    }


    // Convertir a array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "fecha" => $this->getfecha(),
            "horaInicio" => $this->getHoraInicio(),
            "duracion" => $this->getDuracion(),
            "numeroFuncion" => $this->getNumeroFuncion(),
            "peliculaId" => $this->getPeliculaId(),
            "salaId" => $this->getSalaId(),
            "programacionId" => $this->getProgramacionId(),
            "precio" => $this->getPrecio(),
        ];
    }
}