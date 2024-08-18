<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ProgramacionDTO implements InterfaceDTO
{

    private $id, $fechaInicio, $fechaFin, $vigente;

    public function __construct($data = [])
    {

        $this->setId($data["id"] ?? 0);
        $this->setFechaInicio($data["fechaInicio"] ?? "");
        $this->setFechaFin($data["fechaFin"] ?? "");
        $this->setVigente($data["vigente"] ?? "");
    }

    //Getters//
    public function getId(): int
    {
        return $this->id;
    }

    public function getFechaInicio(): string
    {
        return $this->fechaInicio;
    }

    public function getFechaFin(): string
    {
        return $this->fechaFin;
    }

    public function getVigente(): string
    {
        return $this->vigente;
    }

    //Setters//
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setFechaInicio($fecha): void
    {
        // Patrón para "año-mes-día"
        $pattern = '/^(19|20)\d\d\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01])$/';

        if (is_string($fecha) && preg_match($pattern, $fecha)) {
            list($año, $mes, $dia) = explode('-', $fecha);

            // Verificar si la fecha es válida
            if (checkdate($mes, $dia, $año)) {
                $this->fechaInicio = "$año-$mes-$dia";
            } else {
                $this->fechaInicio = ""; // Asignar un valor vacío si la fecha no es válida
            }
        } else {
            $this->fechaInicio = ""; // Asignar un valor vacío si no cumple el patrón
        }
    }

    public function setFechaFin($fecha): void
    {
        // Patrón para "año-mes-día"
        $pattern = '/^(19|20)\d\d\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01])$/';

        if (is_string($fecha) && preg_match($pattern, $fecha)) {
            list($año, $mes, $dia) = explode('-', $fecha);

            // Verificar si la fecha es válida
            if (checkdate($mes, $dia, $año)) {
                $this->fechaFin = "$año-$mes-$dia";
            } else {
                $this->fechaFin = ""; // Asignar un valor vacío si la fecha no es válida
            }
        } else {
            $this->fechaFin = ""; // Asignar un valor vacío si no cumple el patrón
        }
    }

    public function setVigente($vigente): void
    {
        $this->vigente = ($vigente === 0 || $vigente === 1) ? $vigente : 0;
    }

    //Metodos Publicos//
    //dentro del mismo sistema, con objetos o con arrays

    public function toArray(): array
    {

        return [

            "id" => $this->getId(),
            "fechaInicio" => $this->getFechaInicio(),
            "fechaFin" => $this->getFechaFin(),
            "vigente" => $this->getVigente()

        ];
    }
};
