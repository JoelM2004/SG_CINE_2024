<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

use app\core\model\dto\ProgramacionDTO;

final class ProgramacionDAO extends DAO implements InterfaceDAO

{

    public function __construct($conn)
    {
        parent::__construct($conn, "programaciones");
    }

    public function save(InterfaceDTO $object): void
    {

        $this->validate($object);

        $this->validateFechasUnicas($object);

        $this->validateVigencia($object);
        
        $this->validateFechas($object);

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
        
        $this->validateVigencia($object);
        $this->validate($object);
        
        $this->validateFechasUnicas($object);
        
        $this->validateFechas($object);

        $sql = "UPDATE {$this->table} 
            SET fechaInicio=:fechaInicio, fechaFin=:fechaFin, vigente=:vigente WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        // Asegúrate de que el array de datos tenga las claves correctas
        $data = $object->toArray();

        // Ejecutar la consulta con los datos del objeto
        $stmt->execute($data);
    } //revisar

    public function loadByVigencia($Vigencia): array {
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

    public function listVigente():ProgramacionDTO{

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

    private function validate(ProgramacionDTO $object): void
    {
        // Lista de métodos a verificar
        $atributos = [
            'getFechaInicio',
            'getFechaFin',
            'getVigente'
        ];

        foreach ($atributos as $atributo) {
            if (method_exists($object, $atributo) && $object->{$atributo}() === "") {
                throw new \Exception("El dato del usuario es obligatorio: " . $atributo);
            }
        }
    }

    private function validateVigencia(ProgramacionDTO $object): void
    {
        // Consultar si ya existe una programación vigente (vigente = 1), excluyendo el id actual
        $sql = "SELECT COUNT(id) AS cantidad 
            FROM {$this->table} 
            WHERE vigente = 1 AND id != :id";
        $stmt = $this->conn->prepare($sql);

        $params = [
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if (($object->getVigente()==1) && ($result->cantidad > 0)) {
            throw new \Exception("Ya hay una cartelera/programación vigente, asegúrate de desactivarla para activar ésta.");
        }
    } //revisar

    private function validateFechas(ProgramacionDTO $object): void
    {

        if ($object->getFechaInicio() > $object->getFechaFin()) {
            throw new \Exception("La fecha de inicio no puede ser mayor a la fecha de fin.");
        }
    }

    private function validateFechasUnicas(ProgramacionDTO $object): void
{
    // Valida que ni la fecha de inicio ni la fecha de fin sean duplicadas en otro registro
    $sql = "SELECT count(id) AS cantidad 
            FROM {$this->table} 
            WHERE (fechaInicio = :fechaInicio OR fechaFin = :fechaFin) 
            AND id != :id";
    $stmt = $this->conn->prepare($sql);

    $params = [
        ':id' => $object->getId(),
        ':fechaInicio' => $object->getFechaInicio(),
        ':fechaFin' => $object->getFechaFin(),
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ);

    if ($result->cantidad > 0) {
        throw new \Exception("La combinación de fecha inicio ({$object->getFechaInicio()}) y fecha fin ({$object->getFechaFin()}) ya existe en la base de datos");
    }
}
public function existe($id): bool{
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
