<?php

namespace app\core\model\validation;
use app\core\model\dto\EntradaDTO;
use app\core\model\base\Validation;

final class EntradaValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "entradas");
    }

    public function existeUsuario($id): bool
    {
        $sql = "SELECT count(id) AS cantidad FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        // Parámetro id
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        // Comparación corregida
        if ($result->cantidad == 0) {
            return false;  // El usuario no existe
        }

        return true;  // El usuario existe
    }

    public function existeFuncion($id): bool
    {
        $sql = "SELECT count(f.id) AS cantidad 
            FROM funciones f
            INNER JOIN programaciones p ON f.programacionId = p.id
            WHERE f.id = :id AND p.vigente = 1";

        $stmt = $this->conn->prepare($sql);

        // Parámetro id
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        // Retorna true si la función existe y está vigente
        return $result->cantidad > 0;
    }



}