<?php

namespace app\core\model\dao;
use app\core\model\base\DAO;


final class ReporteDAO extends DAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, '');
    }

    public function reporteUsuario($user): array
    {

        $this->existeUsuario($user);

        $sql = "SELECT 
        e.numeroTicket,
        e.precio,
        u.cuenta,
        f.numeroFuncion,
        f.fecha,
        f.horaInicio,
        p.nombre
        FROM 
        entradas e
        INNER JOIN 
        usuarios u ON e.usuarioId = u.id
        INNER JOIN 
        funciones f ON e.funcionId = f.id
        inner join 
        peliculas p on f.peliculaId=p.id

        WHERE 
        u.cuenta = :cuenta AND e.estado=1
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(

            ["cuenta" => $user]

        );

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function reporteFuncion($id): array
    {
        $sql = "SELECT 
        e.numeroTicket,
        e.precio,
        u.cuenta,
        f.numeroFuncion,
        f.fecha,
        f.horaInicio,
        p.nombre
        FROM 
        entradas e
        INNER JOIN 
        usuarios u ON e.usuarioId = u.id
        INNER JOIN 
        funciones f ON e.funcionId = f.id
        inner join 
        peliculas p on f.peliculaId=p.id
        inner join
        programaciones pr on f.programacionId=pr.id
        WHERE 
        f.id = :id AND e.estado=1
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(

            ["id" => $id]

        );

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function reporteProgramacion($id): array
    {

        $sql = "SELECT 
        e.numeroTicket,
        e.precio,
        u.cuenta,
        f.numeroFuncion,
        f.fecha,
        f.horaInicio,
        p.nombre
        FROM 
        entradas e
        INNER JOIN 
        usuarios u ON e.usuarioId = u.id
        INNER JOIN 
        funciones f ON e.funcionId = f.id
        inner join 
        peliculas p on f.peliculaId=p.id
        inner join
        programaciones pr on f.programacionId=pr.id
        WHERE 
        pr.id = :id AND e.estado=1
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(

            ["id" => $id]

        );

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function reportePelicula($id): array
    {
        $sql = "SELECT 
        e.numeroTicket,
        e.precio,
        u.cuenta,
        f.numeroFuncion,
        f.fecha,
        f.horaInicio,
        p.nombre
        FROM 
        entradas e
        INNER JOIN 
        usuarios u ON e.usuarioId = u.id
        INNER JOIN 
        funciones f ON e.funcionId = f.id
        inner join 
        peliculas p on f.peliculaId=p.id
        inner join
        programaciones pr on f.programacionId=pr.id
        WHERE 
        p.id = :id AND e.estado=1
        ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(

            ["id" => $id]

        );

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function existeUsuario($id): void{
        $sql = "SELECT count(id) AS cantidad FROM usuarios WHERE cuenta = :id";
        $stmt = $this->conn->prepare($sql);
    
        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];
    
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba
    
        if ($result->cantidad <= 0) {
            throw new \Exception("No existe el Usuario.");
       } 
    } 
}
