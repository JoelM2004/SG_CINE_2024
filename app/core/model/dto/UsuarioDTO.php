<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class UsuarioDTO implements InterfaceDTO
{

    private $id, $apellido, $nombres, $cuenta, $clave, $correo, $perfilId;

    public function __construct($data = [])
    {

        $this->setId($data["id"] ?? 0);
        $this->setApellido($data["apellido"] ?? "");
        $this->setNombres($data["nombres"] ?? "");
        $this->setCuenta($data["cuenta"] ?? "");
        $this->setClave($data["clave"] ?? "");
        $this->setCorreo($data["correo"] ?? "");
        $this->setPerfilId($data["perfilId"] ?? 0);

    }

    //Getters//
    public function getId(): int
    {
        return $this->id;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getNombres(): string
    {
        return $this->nombres;
    }

    public function getCuenta(): string
    {
        return $this->cuenta;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function getPerfilId(): int
    {
        return $this->perfilId;
    }


    //Setters//
    public function setId($id): void
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    public function setApellido($apellido): void
    {
        $this->apellido = is_string($apellido) && (strlen(trim($apellido)) <= 45) ? trim($apellido) : "";
    }

    public function setNombres($nombres): void
    {
        $this->nombres = is_string($nombres) && (strlen(trim($nombres)) <= 45) ? trim($nombres) : "";
    }

    public function setCorreo($correo): void
    {
        $patron = '/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if (preg_match($patron, $correo) && (strlen(trim($correo)) <= 255)) {
            $this->correo = trim($correo);
        } else {
            $this->correo = "";
        }
    }

    public function setCuenta($cuenta): void
    {
        $this->cuenta = is_string($cuenta) && (preg_match('/^[a-zA-Z0-9]{6,45}$/', $cuenta)) && (strlen(trim($cuenta)) <= 45)
            ? $cuenta
            : "";
    }

    public function setClave($clave): void
    {
        $this->clave = is_string($clave)&&(preg_match('/^[a-zA-Z0-9]{6,255}$/', $clave)) && (strlen(trim($clave)) <= 255) ? trim($clave) : "";
    }

    public function setPerfilId($clave): void // consultar
    {
        $this->perfilId = (is_integer($clave) && $clave > 0) ? $clave : 0;
    }

    //Metodos Publicos//
    //dentro del mismo sistema, con objetos o con arrays

    public function toArray(): array
    {

        return [
            
            "id" => $this->getId(),
            "apellido" => $this->getApellido(),
            "nombres" => $this->getNombres(),
            "cuenta" => $this->getCuenta(),
            "correo" => $this->getCorreo(),
            "clave" => $this->getClave(),
            "perfilId" => $this->getPerfilId(),

        ];
    }
};