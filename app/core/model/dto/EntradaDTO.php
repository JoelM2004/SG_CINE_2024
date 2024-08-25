<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class EntradaDTO implements InterfaceDTO
{

    private $id, $horarioFuncion, $horarioVenta, $precio,$numeroTicket,$estado,$funcionId,$usuarioId;

    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? 0);
        $this->setHoraFuncion($data["horarioFuncion"] ?? "");
        $this->setHoraVenta($data["horarioVenta"] ?? "");
        $this->setPrecio($data["precio"] ?? 0);
        $this->setNumeroTicket($data["numeroTicket"]??0);
        $this->setEstado($data["estado"]??0);
        $this->setFuncionId($data["funcionId"]??0);
        $this->setUsuarioId($data["usuarioId"]??0);
    }


    public function toArray(): array
    {

        return [
            
            "id" => $this->getId(),
            "horarioFuncion" => $this->getHoraFuncion(),
            "horarioVenta" => $this->getHoraVenta(),
            "precio" => $this->getPrecio(),
            "numeroTicket" => $this->getNumeroTicket(),
            "estado" => $this->getEstado(),
            "funcionId" => $this->getFuncionId(),
            "usuarioId" => $this->getUsuarioId()

        ];
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (is_integer($id) && $id > 0) ? $id : 0;
    }

    /**
     * Get the value of horaFuncion
     */ 
    public function getHoraFuncion()
    {
        return $this->horarioFuncion;
    }

    /**
     * Set the value of horaFuncion
     *
     *
     */ 
    public function setHoraFuncion($horaFuncion)
{
    // Patrón para "año-mes-díaThora:minuto"
    $pattern = '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/';

    // Verifica si el formato coincide con "YYYY-MM-DDTHH:MM"
    if (is_string($horaFuncion) && preg_match($pattern, $horaFuncion)) {
        // Separar fecha y hora
        list($date, $time) = explode('T', $horaFuncion);

        // Separar componentes de la fecha
        list($year, $month, $day) = explode('-', $date);

        // Verificar si la fecha es válida
        if (checkdate((int)$month, (int)$day, (int)$year)) {
            // Verificar si la hora es válida
            list($hour, $minute) = explode(':', $time);
            if ($hour >= 0 && $hour <= 23 && $minute >= 0 && $minute <= 59) {
                // Convertir a formato "YYYY-MM-DD HH:MM:SS"
                $this->horarioFuncion = "{$year}-{$month}-{$day} {$hour}:{$minute}:00";
                return;
            }
        }
    }

    // Asignar cadena vacía si la validación falla
    $this->horarioFuncion = "";
}

    /**
     * Get the value of horaVenta
     */ 
    public function getHoraVenta()
    {
        return $this->horarioVenta;
    }

    /**
     * Set the value of horaVenta
     *
     * @return  self
     */ 
    public function setHoraVenta($horaVenta)
{
    // Patrón para "año-mes-díaThora:minuto"
    $pattern = '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/';

    // Verifica si el formato coincide con "YYYY-MM-DDTHH:MM"
    if (is_string($horaVenta) && preg_match($pattern, $horaVenta)) {
        // Separar fecha y hora
        list($date, $time) = explode('T', $horaVenta);

        // Separar componentes de la fecha
        list($year, $month, $day) = explode('-', $date);

        // Verificar si la fecha es válida
        if (checkdate((int)$month, (int)$day, (int)$year)) {
            // Verificar si la hora es válida
            list($hour, $minute) = explode(':', $time);
            if ($hour >= 0 && $hour <= 23 && $minute >= 0 && $minute <= 59) {
                // Convertir a formato "YYYY-MM-DD HH:MM:SS"
                $this->horarioVenta = "{$year}-{$month}-{$day} {$hour}:{$minute}:00";
                return;
            }
        }
    }

    // Asignar cadena vacía si la validación falla
    $this->horarioVenta = "";
}



    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        // Verifica que el precio sea numérico y mayor que 0
        $this->precio = (is_numeric($precio) && $precio > 0) ? (double) $precio : 0.0;
    }
    /**
     * Get the value of numeroTicket
     */ 
    public function getNumeroTicket()
    {
        return $this->numeroTicket;
    }

    /**
     * Set the value of numeroTicket
     *
     * @return  self
     */ 
    public function setNumeroTicket($numeroTicket)
    {
        $this->numeroTicket = (is_integer($numeroTicket) && $numeroTicket > 0) ? $numeroTicket : 0;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = ($estado === 0 || $estado === 1) ? $estado : 0;

    }

    /**
     * Get the value of funcionId
     */ 
    public function getFuncionId()
    {
        return $this->funcionId;
    }

    /**
     * Set the value of funcionId
     *
     * @return  self
     */ 
    public function setFuncionId($funcionId)
    {
        $this->funcionId = (is_integer($funcionId) && $funcionId > 0) ? $funcionId : 0;
    }

    /**
     * Get the value of usuarioId
     */ 
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set the value of usuarioId
     *
     * 
     */ 
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = (is_integer($usuarioId) && $usuarioId > 0) ? $usuarioId : 0;
    }
};