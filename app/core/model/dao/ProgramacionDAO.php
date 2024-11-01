<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

use app\core\model\dto\ProgramacionDTO;

use app\core\model\validation\ProgramacionValidation;

final class ProgramacionDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "programaciones");
    }

    public function save(InterfaceDTO $object): void
    {
        $validation= new ProgramacionValidation($this->conn);
        $validation->validate($object);
        $validation->validateVigencia($object);

        $validation->validateFechasInicio($object);
        $validation->validateFechasFin($object);


        $validation->validateFechas($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT, :fechaInicio, :fechaFin, :vigente)";

        $stmt = $this->conn->prepare($sql);

        $data = $object->toArray();

        unset($data["id"]);

        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());

        // $this->conn->exec($sql);
    }

    public function load($id): ProgramacionDTO
    {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La programación no se cargó correctamente");
        }

        return new ProgramacionDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void
    {
        $validation= new ProgramacionValidation($this->conn);
        $validation->validateVigencia($object);
        $validation->validate($object);

        $validation->validateFechasInicio($object);
        $validation->validateFechasFin($object);

        // $this->validateFechasUnicas($object);

        $validation->validateFechas($object);

        $sql = "UPDATE {$this->table} 
            SET fechaInicio=:fechaInicio, fechaFin=:fechaFin, vigente=:vigente WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        // Asegúrate de que el array de datos tenga las claves correctas
        $data = $object->toArray();

        // Ejecutar la consulta con los datos del objeto
        $stmt->execute($data);
    } //revisar

    public function loadByVigencia($Vigencia): array
    {
        $sql = "SELECT id, fechaInicio, fechaFin, vigente FROM {$this->table} WHERE vigente = :vigente";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["vigente" => $Vigencia]);

        // Recuperar todos los resultados y convertirlos a objetos UsuarioDTO
        $Programaciones = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Programaciones[] = new ProgramacionDTO($row);
        }

        return $Programaciones;
    }

    public function loadByFecha($fechaInicio, $fechaFin): array
    {
        // Selecciona las programaciones cuyo inicio está dentro del rango de fechas
        $sql = "SELECT id, fechaInicio, fechaFin, vigente 
            FROM {$this->table} 
            WHERE fechaInicio >= :fechaInicio 
            AND fechaFin <= :fechaFin"; // Incluimos la condición de fechaFin

        // Prepara la consulta
        $stmt = $this->conn->prepare($sql);

        // Ejecuta la consulta con los valores de fechaInicio y fechaFin
        $stmt->execute([
            "fechaInicio" => $fechaInicio,
            "fechaFin" => $fechaFin
        ]);

        // Recuperar todos los resultados y convertirlos a objetos ProgramacionDTO
        $Programaciones = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Programaciones[] = new ProgramacionDTO($row);
        }

        return $Programaciones;
    }

    public function listVigente(): ProgramacionDTO
    {

        $sql = "SELECT * FROM {$this->table} WHERE vigente = 1";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La programación no se cargó correctamente");
        }

        return new ProgramacionDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function delete($id): void
    {
        $validation= new ProgramacionValidation($this->conn);
        $validation->validatefunciones($id);
        $sql = "DELETE FROM {$this->table} WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([

            "id" => $id

        ]);
    }

    public function list(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function existe($id): bool
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            return true;
        } else return false;
    }
    
}
