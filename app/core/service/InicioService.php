<?php

namespace app\core\service;

use app\core\service\base\Service;
use app\libs\Connection\Connection;
use app\core\model\dao\InicioDAO;

final class InicioService extends Service  {

    public function __construct()
    {
        parent::__construct();
    }

   public function list():array{
        $conn=Connection::get();
        $dao= new InicioDAO($conn);
        return $dao->list();
    }

   
}