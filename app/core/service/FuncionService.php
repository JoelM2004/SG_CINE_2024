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

    // public function loadByName($nombre): FuncionDTO {
    //     $conn = Connection::get();
    //     $dao = new FuncionDAO($conn);
    //     return $dao->loadByName($nombre); // Retorna un único FuncionDTO
    // }

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

   
}