<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\EntradaDTO;
use app\core\model\dao\EntradaDAO;
use app\core\service\base\Service;
use app\libs\connection\Connection;

final class EntradaService  extends Service implements InterfaceService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function save(array $object): void
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        $dao->save(new EntradaDTO($object));
    }

    public function cantidadEntradasDisponibles($funcion): int
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->cantidadEntradasDisponibles($funcion);
    }

    public function load($id): EntradaDTO
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->load($id);
    }

    public function loadByNumeroTicket($numeroTicket): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->loadByNumeroTicket($numeroTicket);
    }

    public function loadByCuenta($cuenta): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->loadByCuenta($cuenta);
    }

    public function loadByFuncion($funcion): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->loadByFuncion($funcion);
    }

    public function loadByProgramacion($programacion): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->loadByProgramacion($programacion);
    }

    public function loadByPelicula($pelicula): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->loadByPelicula($pelicula);
    }

    public function update(array $object): void
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        $dao->update(new EntradaDTO($object));
    }

    public function delete($id): void
    {

        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        $dao->delete($id);
    }

    public function list(): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->list();
    }

    public function listEntradas(): array
    {
        $conn = Connection::get();
        $dao = new EntradaDAO($conn);
        return $dao->listEntradas();
    }
}
