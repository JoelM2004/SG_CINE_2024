<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\TipoDTO;
use app\core\model\dao\TipoDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class TipoService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):TipoDTO{
        $conn= Connection::get();
        $dao= new TipoDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new TipoDAO($conn);
        return $dao->list();
    }

   
}