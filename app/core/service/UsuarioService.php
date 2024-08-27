<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\UsuarioDTO;
use app\core\model\dao\UsuarioDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class UsuarioService  extends Service implements InterfaceService {

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->save(new UsuarioDTO($object));
    }

    public function load($id):UsuarioDTO{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->load($id);
    }

    public function loadByNameAccount($nombre):UsuarioDTO{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->loadByNameAccount($nombre);
    }

    public function loadByPerfil($nombre):array{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->loadByPerfil($nombre);
    }

    public function changePassword(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->changePassword($object);
    }

    public function forgetPassword(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->forgetPassword($object);
    }


    public function update(array $object):void{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->update(new UsuarioDTO($object));
    }

    public function delete($id):void{

        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        $dao->delete($id);

    }

    public function list():array{
        $conn= Connection::get();
        $dao= new UsuarioDAO($conn);
        return $dao->list();
    }

   
}