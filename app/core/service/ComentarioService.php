<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\ComentarioDTO;
use app\core\model\dao\ComentarioDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class ComentarioService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new ComentarioDAO($conn);
        $dao->save(new ComentarioDTO($object));
    }

    public function load($id):ComentarioDTO{
        $conn= Connection::get();
        $dao= new ComentarioDAO($conn);
        return $dao->load($id);   
    }

    public function update(array $object):void{
        
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new ComentarioDAO($conn);
        $dao->delete($id);
    
    }

    public function list():array{
        $conn=Connection::get();
        $dao= new ComentarioDAO($conn);
        return $dao->list();
    }

    public function listPeli($pelicula):array{
        $conn=Connection::get();
        $dao= new ComentarioDAO($conn);
        return $dao->listPeli($pelicula);
    }
}