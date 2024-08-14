<?php

namespace app\core\service;

use app\core\service\base\InterfaceServicesimple;
use app\core\model\dto\GeneroDTO;
use app\core\model\dao\GeneroDAO;
use app\core\service\base\Service;
use app\libs\Connection\Connection;

final class GeneroService extends Service implements InterfaceServicesimple {

    public function __construct()
    {
        parent::__construct();
    }

    public function load($id):GeneroDTO{
        $conn= Connection::get();
        $dao= new GeneroDAO($conn);
        return $dao->load($id);   
    }


   public function list():array{
        $conn=Connection::get();
        $dao= new GeneroDAO($conn);
        return $dao->list();
    }

   
}