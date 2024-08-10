<?php

namespace app\core\model\base;

use app\core\model\base\InterfaceDTO;

interface InterfaceDAO{

    public function save(InterfaceDTO $object): void;

    public function load($id): InterfaceDTO;

    public function update(InterfaceDTO $object): void;

    public function delete($id): void;

}