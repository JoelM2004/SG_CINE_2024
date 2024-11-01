<?php

namespace app\core\model\validation;
use app\core\model\dto\FuncionDTO;
use app\core\model\base\Validation;

final class FuncionValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "funciones");
    }

    
    public function validateFuncion(FuncionDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE numeroFuncion = :numeroFuncion AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':numeroFuncion' => $object->getNumeroFuncion(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("El dato número de función ({$object->getNumeroFuncion()}) ya existe en la base de datos");
        }
    }

    public function validateFechaYSala(FuncionDTO $object): void
    {
        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE salaId = :salaId AND fecha=:fecha AND horaInicio=:horaInicio AND id != :id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':salaId' => $object->getSalaId(),
            ':fecha' => $object->getFecha(),
            ':horaInicio' => $object->getHoraInicio(),
            ':id' => $object->getId()
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Ya existe una función que comenzará a ésta hora, día y número de sala");
        }
    }

    public function validateProgramacion(FuncionDTO $object): void {
        $sql = "SELECT count(id) AS cantidad 
                FROM programaciones 
                WHERE :fecha BETWEEN fechaInicio AND fechaFin 
                AND id = :id";
                
        $stmt = $this->conn->prepare($sql);
    
        $params = [
            ':fecha' => $object->getFecha(),
            ':id' => $object->getProgramacionId()
        ];
    
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if ($result->cantidad == 0) { // Si la cantidad es 0, significa que la fecha no está dentro del rango
            throw new \Exception("La fecha de la función no está dentro del rango de fechas de la cartelera seleccionada.");
        }
    }
    
    public function validateSala(FuncionDTO $object): void {
        $sql = "SELECT count(id) AS cantidad 
                FROM salas 
                WHERE estado != 1
                AND id = :id";
                
        $stmt = $this->conn->prepare($sql);
    
        $params = [
            ':id' => $object->getSalaId()
        ];
    
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if ($result->cantidad > 0) {
            throw new \Exception("La sala que usted seleccionó no se encuentra disponible.");
        }
    }
    
    public function validatePelicula(FuncionDTO $object): void {
        $sql = "SELECT count(id) AS cantidad 
                FROM peliculas 
                WHERE disponibilidad != 1
                AND id = :id";
                
        $stmt = $this->conn->prepare($sql);
    
        $params = [
            ':id' => $object->getPeliculaId()
        ];
    
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if ($result->cantidad > 0) {
            throw new \Exception("La película que usted seleccionó no se encuentra disponible.");
        }
    }

    public function validate(FuncionDTO $object): void
{

    // Validar Fecha
    if ($object->getFecha() == "") {
        throw new \Exception("La fecha no es válida.");
    }

    // Validar Hora de Inicio
    if ($object->getHoraInicio() == "") {
        throw new \Exception("La hora de inicio no es válida.");
    }

    // Validar Duración
    if ($object->getDuracion() <= 0) {
        throw new \Exception("La duración debe ser mayor a 0.");
    }

    // Validar Número de Función
    if ($object->getNumeroFuncion() <= 0) {
        throw new \Exception("El número de función no es válido.");
    }

    // Validar Película ID
    if ($object->getPeliculaId() <= 0) {
        throw new \Exception("El ID de la película no es válido.");
    }

    // Validar Sala ID
    if ($object->getSalaId() <= 0) {
        throw new \Exception("El ID de la sala no es válido.");
    }

    // Validar Programación ID
    if ($object->getProgramacionId() <= 0) {
        throw new \Exception("El ID de la programación no es válido.");
    }

    // Validar Precio
    if ($object->getPrecio() <= 0) {
        throw new \Exception("El precio debe ser mayor a 0.");
    }
}

public function validateentradas($id): void
{
    $sql = "SELECT count(f.id) AS cantidad FROM entradas f WHERE f.funcionId =:id";
    $stmt = $this->conn->prepare($sql);

    // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
    $params = [
        ':id' => $id
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

    if ($result->cantidad > 0) {
        throw new \Exception("Debido a que ya se vendieron entradas, usted no puede borrar la función");
    }
}

public function existeSala($id): void
{
    $sql = "SELECT count(f.id) AS cantidad 
        FROM salas f
        WHERE f.id = :id";

    $stmt = $this->conn->prepare($sql);

    // Parámetro id
    $params = [
        ':id' => $id
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ);

    // Retorna true si la función existe y está vigente
    if($result->cantidad == 0) throw  new \Exception("No existe esta sala");
}

public function existeProgramacion($id): void
{
    $sql = "SELECT count(f.id) AS cantidad 
        FROM programaciones f
        WHERE f.id = :id";

    $stmt = $this->conn->prepare($sql);

    // Parámetro id
    $params = [
        ':id' => $id
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ);

    // Retorna true si la función existe y está vigente
    if($result->cantidad == 0) throw  new \Exception("No existe esta programacion");
}

public function existePelicula($id): void
{
    $sql = "SELECT count(f.id) AS cantidad 
        FROM peliculas f
        WHERE f.id = :id AND disponibilidad=1";

    $stmt = $this->conn->prepare($sql);

    // Parámetro id
    $params = [
        ':id' => $id
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ);

    // Retorna true si la función existe y está vigente
    if($result->cantidad == 0) throw  new \Exception("No existe esta pelicula");
}




}