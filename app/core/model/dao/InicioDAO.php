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
    $sql = "SELECT DISTINCT
        pf.id,
        pf.nombre,
        pf.duracion,
        pf.anoEstreno,
        pf.fechaIngreso,
        g.nombre AS genero,
        c.nombre AS calificacion,
        a.nombre AS audio,
        t.nombre AS tipo
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
    INNER JOIN 
        audios a ON pf.audioId = a.id
    INNER JOIN 
        tipos t ON pf.tipoId = t.id
    WHERE 
        p.vigente = 1
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


}
