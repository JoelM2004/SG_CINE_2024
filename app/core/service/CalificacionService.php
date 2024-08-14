<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\CalificacionDTO;
use app\core\model\dao\CalificacionDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class CalificacionService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):CalificacionDTO{
        $conn= Connection::get();
        $dao= new CalificacionDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new CalificacionDAO($conn);
        return $dao->list();
    }

   
}