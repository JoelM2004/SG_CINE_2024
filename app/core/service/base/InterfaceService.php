<?php

namespace app\core\service\base;

use app\core\model\base\InterfaceDTO;

interface InterfaceService
{

    public function save(array $object): void;

    public function load($id): InterfaceDTO;

    public function update(array $object): void;

    public function delete($id): void;

    public function list(): array;
}