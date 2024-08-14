<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\PaisDTO;
use app\core\model\dao\PaisDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class PaisService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):PaisDTO{
        $conn= Connection::get();
        $dao= new PaisDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new PaisDAO($conn);
        return $dao->list();
    }

   
}