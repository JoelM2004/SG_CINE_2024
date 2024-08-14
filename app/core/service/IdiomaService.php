<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\IdiomaDTO;
use app\core\model\dao\IdiomaDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class IdiomaService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):IdiomaDTO{
        $conn= Connection::get();
        $dao= new IdiomaDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new IdiomaDAO($conn);
        return $dao->list();
    }

   
}