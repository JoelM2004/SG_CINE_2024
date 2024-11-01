<?php

namespace app\core\model\validation;
use app\core\model\dto\SalaDTO;
use app\core\model\base\Validation;

final class SalaValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "salas");
    }


    public function validate(SalaDTO $object): void
    {
        // Lista de métodos a verificar y sus mensajes de error
        $atributos = [
            'getCapacidad' => 'Capacidad',
            'getEstado' => 'Estado',
            'getNumeroSala' => 'Número de Sala'
        ];
    
        foreach ($atributos as $metodo => $nombre) {
            if (method_exists($object, $metodo)) {
                $valor = $object->{$metodo}();
    
                // Validar que el valor no esté vacío y sea entero
                if (!is_int($valor) || $valor < 0) {
                    throw new \Exception("El valor de {$nombre} debe ser un número entero positivo.");
                }
    
                // Validar que 'estado' solo pueda ser 0 o 1
                if ($metodo === 'getEstado' && !in_array($valor, [0, 1], true)) {
                    throw new \Exception("El valor de {$nombre} debe ser 0 o 1.");
                }
            }
        }
    }
    
    public function validateNumeroSala(SalaDTO $object): void
    {
            $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE numeroSala = :numeroSala AND id != :id";
            $stmt = $this->conn->prepare($sql);
    
            // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
            $params = [
                ':numeroSala' => $object->getNumeroSala(),
                ':id' => $object->getId()
            ];
    
            $stmt->execute($params);
            $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba
    
            if ($result->cantidad > 0) {
                throw new \Exception("El dato Número de sala ({$object->getNumeroSala()}) ya existe en la base de datos");
            }
    }

    public function validatefunciones($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM funciones f WHERE f.salaId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Existe una función que está utilizando está sala, elimine la función/funciones para poder eliminar ésta sala");
        }
    }


}