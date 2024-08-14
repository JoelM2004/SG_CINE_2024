<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class PaisDTO implements InterfaceDTO{

    private $id, $nombre;

    public function __construct($data=[])
    {
        $this->setId($data["id"]??0);
        $this->setNombre($data["nombre"]??"");
    }



    public function getId():int{

        return $this->id;

    }

    public function getNombre():string{

        return $this->nombre;

    }


    public function setId($id):void{

        $this->id=(is_integer($id)&& $id>0)?$id:0;

    }

    public function setNombre($nombre):void{

        // $this->nombre=(is_string($nombre)&&strlen(trim($nombre)<=45) ? trim($nombre):"";
        $this->nombre=(preg_match('/^[\p{L}\s]{1,45}$/u', $nombre)) ? $nombre : "";
    }

    public function toArray(): array
    {
        return[

            "id"=>$this->getId(),
            "nombre"=>$this->getNombre()

        ];
    }
}