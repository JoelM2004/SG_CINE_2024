<?php

namespace app\core\model\base;

use app\core\model\base\InterfaceDTO;


interface InterfaceDAOsimple{

    public function load($id): InterfaceDTO;

    public function list():array;
}