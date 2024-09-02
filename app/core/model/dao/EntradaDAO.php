<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;


use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\EntradaDTO;


final class EntradaDAO extends DAO implements InterfaceDAO
{

    public function __construct($conn)
    {
        parent::__construct($conn, "entradas");
    }


    public function save(InterfaceDTO $object): void
    {
        $data = $object->toArray();

        $capacidadDisponible = $this->cantidadEntradasDisponibles($data["funcionId"]);
        if ($capacidadDisponible <= 0) {
            throw new \Exception("No hay suficientes entradas disponibles para esta función.");
        }
        // Generar un número de ticket único
        $data['numeroTicket'] = $this->generateUniqueTicketNumber();
        $data['precio'] = (float)$data['precio'];
        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:horarioFuncion,:horarioVenta,:precio,:numeroTicket,1,:funcionId,:usuarioId)";
        $stmt = $this->conn->prepare($sql);

        // Eliminar el id del array de datos
        unset($data["id"]);
        unset($data["estado"]);

        // Ejecutar la consulta
        $stmt->execute($data);

        // Establecer el ID en el objeto
        $object->setId((int)$this->conn->lastInsertId());
    }
    private function cantidadEntrada(int $funcionId): int
    {
        $sql = "SELECT count(e.id) AS cantidad 
            FROM {$this->table} e
            INNER JOIN funciones f ON e.funcionId = f.id
            WHERE f.id = :funcionId AND e.estado = 1"; // Asegúrate de que 'estado' es una columna de la tabla 'entradas'

        $stmt = $this->conn->prepare($sql);

        // Asignar el valor de $funcionId al parámetro :funcionId
        $stmt->bindParam(':funcionId', $funcionId, \PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_OBJ); // Trae el resultado como un objeto

        return $result ? $result->cantidad : 0; // Asegúrate de manejar el caso en que no hay resultados
    }

    public function cantidadEntradasDisponibles(int $funcionId): int
    {
        $cantidadCompradas = $this->cantidadEntrada($funcionId);

        $sql = "SELECT s.capacidad  
            FROM salas s
            INNER JOIN funciones f ON s.id = f.salaId
            WHERE f.id = :funcionId";

        $stmt = $this->conn->prepare($sql);

        // Asignar el valor de $funcionId al parámetro :funcionId
        $stmt->bindParam(':funcionId', $funcionId, \PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_OBJ); // Trae el resultado como un objeto

        if (!$result) {
            throw new \Exception("No se pudo encontrar la capacidad de la sala para la función especificada.");
        }

        $capacidadDisponible = $result->capacidad - $cantidadCompradas;

        if ($capacidadDisponible < 0) {
            throw new \Exception("La cantidad de entradas compradas excede la capacidad disponible.");
        }

        return $capacidadDisponible;
    }

    public function load($id): EntradaDTO
    {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("La Entrada no se cargó correctamente");
        }

        return new EntradaDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA


    }

    public function update(InterfaceDTO $object): void
    {
        
        $capacidadDisponible = $this->cantidadEntradasDisponibles($object->getFuncionId());
        if ($capacidadDisponible <= 0 && $object->getEstado()==1) {
            throw new \Exception("No hay suficientes entradas disponibles para esta función.");
        }


        $sql = "UPDATE {$this->table} SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':estado' => $object->getEstado(),
            ':id' => $object->getId()
        ]);
    }

    public function loadByCuenta($usuarioId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE usuarioId = :usuarioId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["usuarioId" => $usuarioId]);
        // Recuperar todos los resultados y convertirlos a objetos EntradaDTO
        $Entradas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Entradas[] = new EntradaDTO($row);
        }
        return $Entradas;
    }

    public function loadByNumeroTicket($numeroTicket): EntradaDTO
    {
        $sql = "SELECT *  FROM {$this->table} WHERE numeroTicket = :numeroTicket";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(["numeroTicket" => $numeroTicket]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("La Entrada no se cargó correctamente");
        }

        return new EntradaDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function loadByFuncion($funcionId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE funcionId = :funcionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["funcionId" => $funcionId]);
        // Recuperar todos los resultados y convertirlos a objetos EntradaDTO
        $Entradas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Entradas[] = new EntradaDTO($row);
        }
        return $Entradas;
    }

    public function loadByProgramacion($programacionId): array
    {
        $sql = "SELECT * FROM {$this->table} e
        Inner join funciones f on f.id= e.funcionId
        inner join programaciones p on f.programacionId=p.id
        WHERE programacionId = :programacionId";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["programacionId" => $programacionId]);
        // Recuperar todos los resultados y convertirlos a objetos EntradaDTO
        $Entradas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Entradas[] = new EntradaDTO($row);
        }
        return $Entradas;
    }

    public function loadByPelicula($peliculaId): array
    {
        $sql = "SELECT * FROM {$this->table} e
        Inner join funciones f on f.id= e.funcionId
        inner join peliculas p on f.peliculaId=p.id

        WHERE peliculaId = :peliculaId";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["peliculaId" => $peliculaId]);
        // Recuperar todos los resultados y convertirlos a objetos EntradaDTO
        $Entradas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Entradas[] = new EntradaDTO($row);
        }
        return $Entradas;
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

    private function generateUniqueTicketNumber(): string
    {
        do {
            // Generar un número aleatorio de 10 dígitos
            $ticketNumber = str_pad(mt_rand(0, 999999999), 10, '0', STR_PAD_LEFT);

            // Verificar si el número ya existe en la base de datos
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE numeroTicket = :numeroTicket";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['numeroTicket' => $ticketNumber]);
            $count = $stmt->fetchColumn();
        } while ($count > 0);

        return $ticketNumber;
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
