<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class PeliculaDTO implements InterfaceDTO
{

    private $id, $nombre, $tituloOriginal, $duracion, $anoEstreno, $disponibilidad, $fechaIngreso, $sitioWebOficial, $sinopsis, $actores, $generoId, $paisId, $idiomaId, $calificacionId, $tipoId, $audioId;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setNombre($data["nombre"] ?? "");
        $this->setTituloOriginal($data["tituloOriginal"] ?? "");
        $this->setDuracion($data["duracion"] ?? 0);
        $this->setAnoEstreno($data["anoEstreno"] ?? 0);
        $this->setDisponibilidad($data["disponibilidad"] ?? 0);
        $this->setFechaIngreso($data["fechaIngreso"] ?? "");
        $this->setSitioWebOficial($data["sitioWebOficial"] ?? "");
        $this->setSinopsis($data["sinopsis"] ?? "");
        $this->setActores($data["actores"] ?? "");
        $this->setGeneroId($data["generoId"] ?? 0);
        $this->setPaisId($data["paisId"] ?? 0);
        $this->setIdiomaId($data["idiomaId"] ?? 0);
        $this->setCalificacionId($data["calificacionId"] ?? 0);
        $this->setTipoId($data["tipoId"] ?? 0);
        $this->setAudioId($data["audioId"] ?? 0);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getTituloOriginal(): string
    {
        return $this->tituloOriginal;
    }

    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function getAnoEstreno(): int
    {
        return $this->anoEstreno;
    }

    public function getDisponibilidad(): int
    {
        return $this->disponibilidad;
    }

    public function getFechaIngreso(): string
    {
        return $this->fechaIngreso;
    }

    public function getSitioWebOficial(): string
    {
        return $this->sitioWebOficial;
    }

    public function getSinopsis(): string
    {
        return $this->sinopsis;
    }

    public function getActores(): string
    {
        return $this->actores;
    }

    public function getGeneroId(): int
    {
        return $this->generoId;
    }

    public function getPaisId(): int
    {
        return $this->paisId;
    }

    public function getIdiomaId(): int
    {
        return $this->idiomaId;
    }

    public function getCalificacionId(): int
    {
        return $this->calificacionId;
    }

    public function getTipoId(): int
    {
        return $this->tipoId;
    }

    public function getAudioId(): int
    {
        return $this->audioId;
    }

    // Setters
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = (preg_match('/^[\p{L}\p{N}\s]{1,255}$/u', $nombre)) ? $nombre : "";
    }
    
    public function setTituloOriginal($tituloOriginal): void
{
    $this->tituloOriginal = (preg_match('/^[\p{L}\p{N}\s\p{P}\p{S}]{1,255}$/u', $tituloOriginal)) ? $tituloOriginal : "";
}


    public function setDuracion($duracion): void
    {
        $this->duracion = (is_integer($duracion) && $duracion > 0) ? $duracion : 0;
    }

    public function setAnoEstreno($anoEstreno): void
    {
        $this->anoEstreno = (is_integer($anoEstreno) && $anoEstreno > 0) ? $anoEstreno : 0;
    }

    public function setDisponibilidad($disponibilidad): void
    {
        $this->disponibilidad = ($disponibilidad === 0 || $disponibilidad === 1) ? trim($disponibilidad) : 1;
    }

    public function setFechaIngreso($fechaIngreso): void
    {
        $this->fechaIngreso = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaIngreso)) ? $fechaIngreso : "";
    }

    public function setSitioWebOficial($sitioWebOficial): void
    {
        $this->sitioWebOficial = (is_string($sitioWebOficial) && strlen(trim($sitioWebOficial)) <= 255) ? trim($sitioWebOficial) : "";
    }

    public function setSinopsis($sinopsis): void
{
    // Expresión regular para permitir letras, números, espacios, puntuación y otros símbolos
    $this->sinopsis = (preg_match('/^[\p{L}\p{N}\s\p{P}\p{S}]{1,1000}$/u', $sinopsis)) ? $sinopsis : "";
}


public function setActores($actores): void
{
    // Expresión regular para permitir letras, números, espacios, puntuación y símbolos, hasta 255 caracteres
    $this->actores = (preg_match('/^[\p{L}\p{N}\s\p{P}\p{S}]{1,255}$/u', $actores)) ? trim($actores) : "";
}



    public function setGeneroId($generoId): void
    {
        $this->generoId = (is_integer($generoId) && $generoId > 0) ? $generoId : 0;
    }

    public function setPaisId($paisId): void
    {
        $this->paisId = (is_integer($paisId) && $paisId > 0) ? $paisId : 0;
    }

    public function setIdiomaId($idiomaId): void
    {
        $this->idiomaId = (is_integer($idiomaId) && $idiomaId > 0) ? $idiomaId : 0;
    }

    public function setCalificacionId($calificacionId): void
    {
        $this->calificacionId = (is_integer($calificacionId) && $calificacionId > 0) ? $calificacionId : 0;
    }

    public function setTipoId($tipoId): void
    {
        $this->tipoId = (is_integer($tipoId) && $tipoId > 0) ? $tipoId : 0;
    }

    public function setAudioId($audioId): void
    {
        $this->audioId = (is_integer($audioId) && $audioId > 0) ? $audioId : 0;
    }

    // Convertir a array
    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "tituloOriginal" => $this->getTituloOriginal(),
            "duracion" => $this->getDuracion(),
            "anoEstreno" => $this->getAnoEstreno(),
            "disponibilidad" => $this->getDisponibilidad(),
            "fechaIngreso" => $this->getFechaIngreso(),
            "sitioWebOficial" => $this->getSitioWebOficial(),
            "sinopsis" => $this->getSinopsis(),
            "actores" => $this->getActores(),
            "generoId" => $this->getGeneroId(),
            "paisId" => $this->getPaisId(),
            "idiomaId" => $this->getIdiomaId(),
            "calificacionId" => $this->getCalificacionId(),
            "tipoId" => $this->getTipoId(),
            "audioId" => $this->getAudioId(),
        ];
    }
}
