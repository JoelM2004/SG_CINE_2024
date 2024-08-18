<?php
require_once "../app/config/DBConfig.php";
require_once "../app/vendor/autoload.php";

use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;


try{
    $conexion = Connection::get();
    echo "Conexion establecida";


    try{
    $perfil= new PerfilDTO($dataPerfil);
    $daoPerfil= new PerfilDAO($conexion);
    // $daoPerfil->save($perfil);
    $perfilCargado=$daoPerfil->load(1);
    }catch(PDOException $ex){
        echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
    }

    $data=[
        "id"=>4,
        "apellido"=>"Mercado",
        "nombres"=>"Joel",
        "cuenta"=>"Joel1234",
        "correo"=>"joel@gmail.com",
        "clave" => "joel1234",
        "perfilId" => $perfilCargado->getId(),
        "estado" => 1,
        "horaEntrada" => "14:20:00",
        "horaSalida" => "14:20:22",
        "fechaAlta" => "2022/12/12",
        "resetear" => 1
    ]
    ;
    $usuario = new UsuarioDTO($data);
    // print_r($usuario->toArray());

    $dao = new UsuarioDAO($conexion);
    // print_r($usuario->toArray());
    echo "<br>";
    echo "<br>";
    print_r($dao->load(46)->toArray());

    $usuario2=$dao->load(46);

    $usuario2->setApellido("NUEVOAPELLIDO");

    try{
            $dao->save($usuario);
        // $dao->delete(42);
        // $dao->update($usuario2);
    }

    catch(Exception $ex){
        print_r($ex->getMessage());
        echo "<br>";
    }
}
catch(PDOException $ex){
    echo '<p>Error de conexión ' . $ex->getMessage() . '</p>';
}