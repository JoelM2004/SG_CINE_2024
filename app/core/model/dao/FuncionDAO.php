<?php

namespace app\core\model\dao;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\DAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\FuncionDTO;

use app\core\model\validation\FuncionValidation;

final class FuncionDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn,'funciones');
    }

    public function save(InterfaceDTO $object):void{
        $validation= new FuncionValidation($this->conn);


        $validation->existePelicula($object->getPeliculaId());
        $validation->existeProgramacion($object->getProgramacionId());
        $validation->existeSala($object->getSalaId());

        $validation->validate($object);
        $validation->validateFuncion($object);
        $validation->validateFechaYSala($object);
        $validation->validateProgramacion($object);
        $validation->validateSala($object);
        $validation->validatePelicula($object);
        $sql="INSERT INTO {$this->table} VALUES(DEFAULT,:fecha,:horaInicio,:duracion,:numeroFuncion,:peliculaId,:salaId,:programacionId,:precio)";//:apellido, variable reemplazada por un dato, o una consulta preparada
        $stmt=$this->conn->prepare($sql);
        $data=$object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
        // $stmt->execute(["nombre"=>$object->getNombre()]);// esto es una forma...
        // $this->conn->exec($sql);
    }

    public function load($id):FuncionDTO {
        
        $sql="SELECT * FROM {$this->table} WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(["id"=>$id]);

        if($stmt->rowCount()!==1){

            throw new \Exception("El Funcion no se cargó correctamente");

        }

        return new FuncionDTO($stmt->fetch(\PDO::FETCH_ASSOC));//LO DEVUELVE EN UNA MATRIZ ASOCIATIVA

    }

    public function update(InterfaceDTO $object):void{

        $validation= new FuncionValidation($this->conn);

        $validation->existePelicula($object->getPeliculaId());
        $validation->existeProgramacion($object->getProgramacionId());
        $validation->existeSala($object->getSalaId());
        
        $validation->validate($object);
        $validation->validateFuncion($object);
        $validation->validateFechaYSala($object);
        $validation->validateProgramacion($object);
        $validation->validateSala($object);
        $validation->validatePelicula($object);

        $sql="UPDATE {$this->table} SET 
        fecha=:fecha,
        horaInicio=:horaInicio, 
        duracion=:duracion, 
        numeroFuncion=:numeroFuncion, 
        peliculaId=:peliculaId, 
        salaId=:salaId, 
        programacionId=:programacionId,
        precio=:precio  
        
        WHERE id=:id";

        $stmt=$this ->conn->prepare($sql);
        $stmt->execute($object->toArray());

    }

    public function delete($id):void{

        $validation= new FuncionValidation($this->conn);
        $validation->validateentradas($id);
        $sql="DELETE FROM {$this->table} WHERE id= :id";
        $stmt=$this ->conn->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
    
    }

    public function list():array{

        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  
    }

    public function listF():array{

        $sql = "SELECT 
        f.id,
        f.fecha,
        f.horaInicio,
        f.duracion,
        f.numeroFuncion,
        f.precio,
        p.nombre,
        s.numeroSala,
        pr.fechaInicio,
        pr.fechaFin

        FROM {$this->table} f
        inner join peliculas p on f.peliculaId=p.id
        inner join salas s on f.salaId=s.id
        inner join programaciones pr on f.programacionId=pr.id
        
        
        " ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  
    }

    public function loadByNumeroSala($salaId): array {
        $sql = "SELECT 
        f.id,
        f.fecha,
        f.horaInicio,
        f.duracion,
        f.numeroFuncion,
        f.precio,
        p.nombre,
        s.numeroSala,
        pr.fechaInicio,
        pr.fechaFin

        FROM {$this->table} f
        inner join peliculas p on f.peliculaId=p.id
        inner join salas s on f.salaId=s.id
        inner join programaciones pr on f.programacionId=pr.id
        where f.salaId=:id
        
        " ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$salaId]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByNombrePelicula($peliculaId): array {
        $sql = "SELECT 
        f.id,
        f.fecha,
        f.horaInicio,
        f.duracion,
        f.numeroFuncion,
        f.precio,
        p.nombre,
        s.numeroSala,
        pr.fechaInicio,
        pr.fechaFin

        FROM {$this->table} f
        inner join peliculas p on f.peliculaId=p.id
        inner join salas s on f.salaId=s.id
        inner join programaciones pr on f.programacionId=pr.id
        where f.peliculaId=:id
        
        " ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$peliculaId]);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByFechaProgramacion($programacionId): array {
        $sql = "SELECT 
        f.id,
        f.fecha,
        f.horaInicio,
        f.duracion,
        f.numeroFuncion,
        f.precio,
        p.nombre,
        s.numeroSala,
        pr.fechaInicio,
        pr.fechaFin

        FROM {$this->table} f
        inner join peliculas p on f.peliculaId=p.id
        inner join salas s on f.salaId=s.id
        inner join programaciones pr on f.programacionId=pr.id
        where f.programacionId=:id
        
        " ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$programacionId]);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByNumeroFuncion($numeroFuncion):array{

        $this->existeF($numeroFuncion);
        $sql = "SELECT 
        f.id,
        f.fecha,
        f.horaInicio,
        f.duracion,
        f.numeroFuncion,
        f.precio,
        p.nombre,
        s.numeroSala,
        pr.fechaInicio,
        pr.fechaFin

        FROM {$this->table} f
        inner join peliculas p on f.peliculaId=p.id
        inner join salas s on f.salaId=s.id
        inner join programaciones pr on f.programacionId=pr.id
        where f.numeroFuncion=:id
        
        " ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$numeroFuncion]);
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

   }

   public function listFunciones($id): array
{
    $sql = "SELECT 
        f.id AS id,
        f.fecha AS fecha,
        f.horaInicio AS horaInicio,
        f.duracion AS duracion,
        f.numeroFuncion AS numeroFuncion,
        f.peliculaId AS peliculaId,
        f.salaId AS salaId,
        f.programacionId AS programacionId,
        f.precio AS precio,
        s.numeroSala as numeroSala,
        s.estado as estadoSala,
        pf.nombre as nombrePelicula,
        t.nombre as nombreTipo,
        a.nombre as nombreAudio

    FROM 
        funciones f
    INNER JOIN 
        peliculas pf ON pf.id = f.peliculaId
    INNER JOIN 
        programaciones p ON f.programacionId = p.id
    INNER JOIN 
        audios a ON pf.audioId = a.id
    INNER JOIN 
        tipos t ON pf.tipoId = t.id
    INNER JOIN
        salas s ON f.salaId = s.id
    WHERE 
        p.vigente = 1 AND
        f.fecha >= CURDATE() AND
        pf.id = :id AND
        f.fecha between p.fechaInicio and p.fechaFin
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["id" => $id]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function listActivas(): array
{
    $sql = "SELECT 
       f.*
    FROM 
        funciones f
    INNER JOIN 
        programaciones p ON f.programacionId = p.id
    WHERE 
        p.vigente = 1 AND
        f.fecha >= CURDATE() 
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $funciones = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $funciones[] = new FuncionDTO($row);
    }

    return $funciones;
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

public function existeCartelera($id): bool{
    $sql = "SELECT count(f.id) AS cantidad FROM {$this->table} f
    inner join programaciones p on p.id=f.programacionId
    inner join salas s on s.id=f.salaId
    WHERE f.id = :id AND p.vigente=1 AND f.fecha >= CURDATE() AND s.estado=1 
    AND f.fecha between p.fechaInicio and p.fechaFin";
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

public function existeF($id): void{
    $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE numeroFuncion = :id";
    $stmt = $this->conn->prepare($sql);

    // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
    $params = [
        ':id' => $id
    ];

    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

    if ($result->cantidad <= 0) {
        throw new \Exception("No existe está función");
        
   } 
} 

}


