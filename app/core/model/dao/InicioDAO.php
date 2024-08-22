<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;


final class InicioDAO extends DAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, 'programaciones');
    }

    public function list(): array
    {

        $sql = "SELECT 
        pf.id,
        pf.nombre,
        pf.duracion,
        pf.anoEstreno,
        pf.fechaIngreso,
        g.nombre AS genero,
        c.nombre AS calificacion
    FROM 
        peliculas pf
    INNER JOIN 
        funciones f ON pf.id = f.peliculaId
    INNER JOIN 
        programaciones p ON f.programacionId = p.id
    INNER JOIN 
        generos g ON pf.generoId = g.id
    INNER JOIN 
        calificaciones c ON pf.calificacionId = c.id
    WHERE 
        p.vigente = 1;
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
