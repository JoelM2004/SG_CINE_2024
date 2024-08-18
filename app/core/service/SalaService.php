<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\SalaDTO;
use app\core\model\dao\SalaDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class SalaService extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new SalaDAO($conn);
        $dao->save(new SalaDTO($object));
    }

    public function load($id):SalaDTO{
        $conn= Connection::get();
        $dao= new SalaDAO($conn);
        return $dao->load($id);
    }

    public function loadByCapacidad($min,$max):array{
          $conn= Connection::get();
         $dao= new SalaDAO($conn);
         return $dao->loadByCapacidad($min,$max);
     }

    public function loadByEstado($estado):array{
        $conn= Connection::get();
       $dao= new SalaDAO($conn);
        return $dao->loadByEstado($estado);
   }

    public function loadByNumeroSala($numeroSala):SalaDTO{
        $conn= Connection::get();
        $dao= new SalaDAO($conn);
         return $dao->loadByNumeroSala($numeroSala);
     }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new SalaDAO($conn);
        $dao->update(new SalaDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new SalaDAO($conn);
        $dao->delete($id);

    }

    public function list():array{
        $conn= Connection::get();
        $dao= new SalaDAO($conn);
        return $dao->list();
    }

   
}