<?php

namespace app\core\service\base;

use app\core\model\base\InterfaceDTO;

interface InterfaceServicesimple
{

    public function load($id): InterfaceDTO;

    public function list(): array;
}