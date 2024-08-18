<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class SalaDTO implements InterfaceDTO
{

    private $id, $capacidad, $estado, $numeroSala;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setCapacidad($data["capacidad"] ?? 0);
        $this->setEstado($data["estado"] ?? 0);
        $this->setNumeroSala($data["numeroSala"] ?? 0);
    }

    //Getters//
    public function getId(): int
    {
        return $this->id;
    }

    public function getCapacidad(): int
    {
        return $this->capacidad;
    }

    public function getEstado(): int
    {
        return $this->estado;
    }

    public function getNumeroSala(): int
    {
        return $this->numeroSala;
    }

    //Setters//
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setCapacidad($capacidad): void
    {
        $this->capacidad = (is_integer($capacidad) && $capacidad > 0) ? $capacidad : 0;
    }

    public function setEstado($estado): void
    {
        $this->estado = ($estado === 0 || $estado === 1) ? trim($estado) : 1;
    }

    public function setNumeroSala($numero_sala): void // consultar
    {
        $this->numeroSala = (is_integer($numero_sala) && $numero_sala > 0) ? $numero_sala : 0;
    }

    //Metodos Publicos//
    //dentro del mismo sistema, con objetos o con arrays

    public function toArray(): array
    {

        return [
            
            "id" => $this->getId(),
            "capacidad" => $this->getCapacidad(),
            "estado" => $this->getEstado(),
            "numeroSala" => $this->getNumeroSala()

        ];
    }
};