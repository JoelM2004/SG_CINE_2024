<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\AudioDTO;
use app\core\model\dao\AudioDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class AudioService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):AudioDTO{
        $conn= Connection::get();
        $dao= new AudioDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new AudioDAO($conn);
        return $dao->list();
    }

   
}