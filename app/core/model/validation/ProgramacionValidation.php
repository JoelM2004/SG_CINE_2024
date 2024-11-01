<?php

namespace app\core\model\validation;
use app\core\model\dto\ProgramacionDTO;
use app\core\model\base\Validation;

final class ProgramacionValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "programaciones");
    }

    
    public function validate(ProgramacionDTO $object): void
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

    public function validateVigencia(ProgramacionDTO $object): void
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

        if (($object->getVigente() == 1) && ($result->cantidad > 0)) {
            throw new \Exception("Ya hay una cartelera/programación vigente, asegúrate de desactivarla para activar ésta.");
        }
    } //revisar

    public function validateFechas(ProgramacionDTO $object): void
    {

        if ($object->getFechaInicio() > $object->getFechaFin()) {
            throw new \Exception("La fecha de inicio no puede ser mayor a la fecha de fin.");
        }
    }

    public function validateFechasUnicas(ProgramacionDTO $object): void
    {
        // Valida que ni la fecha de inicio ni la fecha de fin sean duplicadas en otro registro
        $sql = "SELECT count(id) AS cantidad 
            FROM {$this->table} 
            WHERE (fechaInicio = :fechaInicio AND fechaFin = :fechaFin) 
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

    public function validateFechasInicio(ProgramacionDTO $object): void
    {
        // Valida que ni la fecha de inicio ni la fecha de fin sean duplicadas en otro registro
        $sql = "SELECT count(id) AS cantidad 
            FROM {$this->table} 
            WHERE (fechaInicio = :fechaInicio) 
            AND id != :id";
        $stmt = $this->conn->prepare($sql);

        $params = [
            ':id' => $object->getId(),
            ':fechaInicio' => $object->getFechaInicio(),
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if ($result->cantidad > 0) {
            throw new \Exception("Ya existe una cartelera que inicia este día " . $object->getFechaInicio());
        }
    }

    public function validateFechasFin(ProgramacionDTO $object): void
    {
        // Valida que ni la fecha de inicio ni la fecha de fin sean duplicadas en otro registro
        $sql = "SELECT count(id) AS cantidad 
            FROM {$this->table} 
            WHERE (fechaFin = :fechaFin) 
            AND id != :id";
        $stmt = $this->conn->prepare($sql);

        $params = [
            ':id' => $object->getId(),
            ':fechaFin' => $object->getFechaFin(),
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        if ($result->cantidad > 0) {
            throw new \Exception("Ya existe una cartelera que finaliza este día " . $object->getFechaFin());
        }
    }

    public function validatefunciones($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM funciones f WHERE f.programacionId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Existe una función que está utilizando está programación, elimine la función/funciones para poder eliminar ésta programación");
        }
    }

}