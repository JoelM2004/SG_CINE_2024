<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ComentarioDTO implements InterfaceDTO{

    private $id, $usuarioId,$peliculaId,$comentario;

    public function __construct($data=[])
    {
        $this->setId($data["id"]??0);
        $this->setUsuarioId($data["usuarioId"]??0);
        $this->setPeliculaId($data["peliculaId"]??0);
        $this->setComentario($data["comentario"]??"");
    }



    public function getId():int{

        return $this->id;

    }

    public function getUsuarioId():int{

        return $this->usuarioId;

    }

    public function getPeliculaId():int{

        return $this->peliculaId;

    }

    public function getComentario():string{

        return $this->comentario;

    }


    public function setId($id):void{

        $this->id=(is_integer($id)&& $id>0)?$id:0;

    }

    public function setPeliculaId($peliculaId): void
    {
        $this->peliculaId = (is_integer($peliculaId) && $peliculaId > 0) ? $peliculaId : 0;
    }

    public function setUsuarioId($usuarioId): void
    {
        $this->usuarioId = (is_integer($usuarioId) && $usuarioId > 0) ? $usuarioId : 0;
    }

    public function setComentario($comentario):void{

        $this->comentario = (preg_match('/^[\p{L}\s]{1,255}$/u', $comentario)) ? $comentario : "";
    }

    public function toArray(): array
    {
        return[

            "id"=>$this->getId(),
            "usuarioId"=>$this->getUsuarioId(),
            "peliculaId"=>$this->getPeliculaId(),
            "comentario"=>$this->getComentario()

        ];
    }
}