<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\FuncionDTO;
use app\core\model\dao\FuncionDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class FuncionService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        $dao->save(new FuncionDTO($object));
    }

    public function load($id):FuncionDTO{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->load($id);   
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        $dao->update(new FuncionDTO($object)); 
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        $dao->delete($id);
    
    }

    public function list():array{
        $conn=Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->list();
    }

    public function listF():array{
        $conn=Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->listF();
    }

    public function loadByNumeroFuncion($NumeroFuncio):array{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->loadByNumeroFuncion($NumeroFuncio);
    }

    public function loadByNombrePelicula($NombrePelicula):array{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->loadByNombrePelicula($NombrePelicula);
    }

    public function loadByNumeroSala($NumeroSala):array{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->loadByNumeroSala($NumeroSala);
    }

    public function loadByFechaProgramacion($FechaProgramacion):array{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->loadByFechaProgramacion($FechaProgramacion);
    }

    public function listFunciones($id):array{
        $conn= Connection::get();
        $dao= new FuncionDAO($conn);
        return $dao->listFunciones($id);
    }

}