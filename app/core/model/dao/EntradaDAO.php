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
        // $this->validate($object);
        // $this->validateNumeroEntrada($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:horarioFuncion,:horaVenta,:precio,:numeroTicket,:estado,:funcionId,:EntradaId)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute($data);
        $object->setId((int)$this->conn->lastInsertId());
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
        $sql = "UPDATE {$this->table} SET estado = :estado WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':estado' => $object->getEstado(),
            ':id' => $object->getId()
        ]);

    }

     public function loadByCuenta($cuentaId): array {
         $sql = "SELECT * FROM {$this->table} WHERE cuentaId = :cuentaId";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute(["cuentaId" => $cuentaId]);
             // Recuperar todos los resultados y convertirlos a objetos EntradaDTO
         $Entradas = [];
         while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
             $Entradas[] = new EntradaDTO($row);
         }
         return $Entradas;
        }

        public function loadByNumeroTicket($numeroTicket):EntradaDTO{
            $sql = "SELECT *  FROM {$this->table} WHERE numeroTicket = :numeroTicket";
           $stmt = $this->conn->prepare($sql);
   
           $stmt->execute(["numeroTicket" => $numeroTicket]);
   
           if ($stmt->rowCount() !== 1) {
   
               throw new \Exception("La Entrada no se cargó correctamente");
           }
   
           return new EntradaDTO($stmt->fetch(\PDO::FETCH_ASSOC));
   
       }
        

        public function loadByFuncion($funcionId): array {
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

    private function validate(EntradaDTO $object): void
    {
        // Lista de métodos a verificar
        $atributos = [
            'getCapacidad',
            'getEstado',
            'getNumeroEntrada'
        ];

        foreach ($atributos as $atributo) {
            if (method_exists($object, $atributo) && $object->{$atributo}() === "") {
                throw new \Exception("El dato de la Entrada es obligatorio: " . $atributo);
            }
        }
    }

    private function validateNumeroEntrada(EntradaDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE numeroEntrada = :numeroEntrada AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':numeroEntrada' => $object->getNumeroEntrada(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato Número de Entrada ({$object->getNumeroEntrada()}) ya existe en la base de datos");
        }
    }


}