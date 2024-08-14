<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\PerfilDTO;
use app\core\model\dao\PerfilDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class PerfilService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new PerfilDAO($conn);
        $dao->save(new PerfilDTO($object));
    }

    public function load($id):PerfilDTO{
        $conn= Connection::get();
        $dao= new PerfilDAO($conn);
        return $dao->load($id);   
    }

    public function loadByName($nombre): PerfilDTO {
        $conn = Connection::get();
        $dao = new PerfilDAO($conn);
        return $dao->loadByName($nombre); // Retorna un único PerfilDTO
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new PerfilDAO($conn);
        $dao->update(new PerfilDTO($object)); 
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new PerfilDAO($conn);
        $dao->delete($id);
    
    }

    public function list():array{
        $conn=Connection::get();
        $dao= new PerfilDAO($conn);
        return $dao->list();
    }

   
}