<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\PeliculaDTO;
use app\core\model\dao\PeliculaDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class PeliculaService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new PeliculaDAO($conn);
        $dao->save(new PeliculaDTO($object));
    }

    public function load($id):PeliculaDTO{
        $conn= Connection::get();
        $dao= new PeliculaDAO($conn);
        return $dao->load($id);   
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new PeliculaDAO($conn);
        $dao->update(new PeliculaDTO($object)); 
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new PeliculaDAO($conn);
        $dao->delete($id);
    
    }

    public function list():array{
        $conn=Connection::get();
        $dao= new PeliculaDAO($conn);
        return $dao->list();
    }

   
}