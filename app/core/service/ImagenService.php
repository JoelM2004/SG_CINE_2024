<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\ImagenDTO;
use app\core\model\dao\ImagenDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class ImagenService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new ImagenDAO($conn);
        $dao->save(new ImagenDTO($object));
    }

    public function load($id):ImagenDTO{
        $conn= Connection::get();
        $dao= new ImagenDAO($conn);
        return $dao->load($id);   
    }

    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new ImagenDAO($conn);
        $dao->update(new ImagenDTO($object)); 
    }

    public function delete($id):void{
        $conn= Connection::get();
        $dao= new ImagenDAO($conn);
        $dao->delete($id);
    
    }

    public function list():array{
        $conn=Connection::get();
        $dao= new ImagenDAO($conn);
        return $dao->list();
    }

   
}