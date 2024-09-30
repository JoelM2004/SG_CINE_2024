<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\ProgramacionDTO;
use app\core\model\dao\ProgramacionDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class ProgramacionService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        $dao->save(new ProgramacionDTO($object));
    }

    public function load($id):ProgramacionDTO{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        return $dao->load($id);
    }

    public function loadByVigencia($vigencia):array{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        return $dao->loadByVigencia($vigencia);
    }

    public function loadByFecha($fechaInicio,$fechaFin):array{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        return $dao->loadByFecha($fechaInicio,$fechaFin);
    }
    
    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        $dao->update(new ProgramacionDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        $dao->delete($id);

    }

    public function list():array{
        $conn= Connection::get();
        $dao= new ProgramacionDAO($conn);
        return $dao->list();
    }

   
}