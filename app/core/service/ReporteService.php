<?php

namespace app\core\service;

use app\core\service\base\Service;
use app\libs\Connection\Connection;
use app\core\model\dao\ReporteDAO;

final class ReporteService extends Service  {

    public function __construct()
    {
        parent::__construct();
    }

   public function reporteUsuario($user):array{
        $conn=Connection::get();
        $dao= new ReporteDAO($conn);
        return $dao->reporteUsuario($user);
    }

    public function reporteFuncion($id):array{
        $conn=Connection::get();
        $dao= new ReporteDAO($conn);
        return $dao->reporteFuncion($id);
    }

    public function reporteProgramacion($id):array{
        $conn=Connection::get();
        $dao= new ReporteDAO($conn);
        return $dao->reporteProgramacion($id);
    }

    public function reportePelicula($id):array{
        $conn=Connection::get();
        $dao= new ReporteDAO($conn);
        return $dao->reportePelicula($id);
    }

   
}