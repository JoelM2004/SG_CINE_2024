<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\EntradaDTO;
use app\core\model\dao\EntradaDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class EntradaService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        $dao->save(new EntradaDTO($object));
    }

    public function cantidadEntrada($funcion):int{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        return $dao->cantidadEntrada($funcion);
    }

    public function load($id):EntradaDTO{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        return $dao->load($id);
    }

    public function loadByNumeroTicket($numeroTicket):EntradaDTO{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        return $dao->loadByNumeroTicket($numeroTicket);
    }

    public function loadByCuenta($cuenta):array{
     $conn= Connection::get();
     $dao= new EntradaDAO($conn);
     return $dao->loadByCuenta($cuenta);
    }

    public function loadByFuncion($funcion):array{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        return $dao->loadByFuncion($funcion);
       }
    
    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        $dao->update(new EntradaDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        $dao->delete($id);

    }

    public function list():array{
        $conn= Connection::get();
        $dao= new EntradaDAO($conn);
        return $dao->list();
    }

   
}