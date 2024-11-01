<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\PeliculaDTO;
use app\core\model\validation\PeliculaValidation;

final class PeliculaDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, 'peliculas');
    }

    public function save(InterfaceDTO $object): void
    {
        $validation= new PeliculaValidation($this->conn);
        $validation->validate($object);

        $sql = "INSERT INTO {$this->table} VALUES(DEFAULT,:nombre,:tituloOriginal,:duracion,:anoEstreno,:disponibilidad,:fechaIngreso,:sitioWebOficial,:sinopsis,:actores,:generoId,:paisId,:idiomaId,:calificacionId,:tipoId,:audioId)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $stmt->execute($data);

        $object->setId((int)$this->conn->lastInsertId());
    }

    public function load($id): PeliculaDTO
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("La película no se cargó correctamente");
        }

        return new PeliculaDTO($stmt->fetch(\PDO::FETCH_ASSOC)); //LO DEVUELVE EN UNA MATRIZ ASOCIATIVA
    }

    public function loadView($id): array
    {
        $sql = "SELECT 
                p.id,
                p.nombre,
                p.tituloOriginal,
                p.duracion,
                p.fechaIngreso,
                p.sinopsis,
                p.actores,
                p.sitioWebOficial,
                g.nombre AS genero,
                c.nombre AS calificacion,
                a.nombre AS audio,
                t.nombre AS tipo,
                i.nombre AS idioma,
                pa.nombre AS pais
            FROM $this->table p 
            INNER JOIN generos g ON p.generoId = g.id
            INNER JOIN calificaciones c ON p.calificacionId = c.id
            INNER JOIN audios a ON p.audioId = a.id
            INNER JOIN tipos t ON p.tipoId = t.id 
            INNER JOIN idiomas i ON p.idiomaId = i.id 
            INNER JOIN paises pa ON p.paisId = pa.id
            WHERE p.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);

        if ($stmt->rowCount() !== 1) {
            throw new \Exception("La Pelicula no se cargó correctamente");
        }
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function listPeliculasActivas(): array
    {
        $sql = "SELECT DISTINCT
                p.*
            FROM {$this->table} p
            
            INNER JOIN funciones f ON f.peliculaId = p.id
            
            INNER JOIN programaciones pro ON f.programacionId = pro.id
            
            WHERE pro.vigente = 1 AND
        f.fecha >= CURDATE()";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }
        return $Peliculas;
    }

    public function listPeliculas(): array
    {
        $sql = "SELECT DISTINCT
                p.*
            FROM {$this->table} p
            
            INNER JOIN funciones f ON f.peliculaId = p.id
            
            INNER JOIN programaciones pro ON f.programacionId = pro.id
            
            WHERE pro.vigente = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }
        return $Peliculas;
    }

    public function update(InterfaceDTO $object): void
    {
        $validation= new PeliculaValidation($this->conn);
        $validation->validate($object);

        $sql = "UPDATE {$this->table} SET 
        
        nombre=:nombre, 
        tituloOriginal=:tituloOriginal,
        duracion=:duracion,
        anoEstreno=:anoEstreno,
        disponibilidad=:disponibilidad,
        fechaIngreso=:fechaIngreso,
        sitioWebOficial=:sitioWebOficial,
        sinopsis=:sinopsis,
        actores=:actores,
        generoId=:generoId,
        paisId=:paisId,
        idiomaId=:idiomaId,
        calificacionId=:calificacionId,
        tipoId=:tipoId,
        audioId=:audioId
        
        WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($object->toArray());
    }
    public function delete($id): void
    {
        $validation= new PeliculaValidation($this->conn);
        $validation->validatefunciones($id);
        $validation->validatecomentarios($id);
        $validation->validateimagenes($id);
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

    public function listP(): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByNombrePelicula($nombre): array
    {      
        $validation= new PeliculaValidation($this->conn);

        $validation->existep($nombre);

        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where p.nombre like :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$nombre . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByGenero($generoId): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where g.id= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$generoId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByPais($pais): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where pa.id= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$pais]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByIdioma($idioma): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where i.id= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$idioma]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByEstreno($estreno): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where p.anoEstreno= :estreno
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["estreno"=>$estreno]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function loadByActor($actor): array
{
    $sql = "SELECT 
        p.id,
        p.nombre AS nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre AS genero,
        pa.nombre AS pais,
        i.nombre AS idioma,
        c.nombre AS calificacion,
        t.nombre AS tipo,
        a.nombre AS audio
    FROM {$this->table} p
    INNER JOIN generos g ON p.generoId = g.id
    INNER JOIN paises pa ON p.paisId = pa.id
    INNER JOIN idiomas i ON p.idiomaId = i.id
    INNER JOIN calificaciones c ON p.calificacionId = c.id
    INNER JOIN tipos t ON p.tipoId = t.id
    INNER JOIN audios a ON p.audioId = a.id
    WHERE p.actores LIKE :actor"; // Cambiado a LIKE

    $stmt = $this->conn->prepare($sql);
    
    // Utiliza el operador '%' para buscar coincidencias en cualquier parte de la cadena
    $stmt->execute(["actor" => '%' . $actor . '%']); // Añadido '%' para búsqueda de subcadenas
    
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

    public function loadByCalificacion($calificacion): array
    {
        $sql = "SELECT 
        p.id,
        p.nombre as nombrePelicula,
        p.duracion,
        p.anoEstreno,
        p.disponibilidad,
        p.fechaIngreso,
        g.nombre as genero,
        pa.nombre as pais,
        i.nombre as idioma,
        c.nombre as calificacion,
        t.nombre as tipo,
        a.nombre as audio

        FROM {$this->table} p

        inner join generos g on p.generoId=g.id
        inner join paises pa on p.paisId=pa.id
        inner join idiomas i on p.idiomaId=i.id
        inner join calificaciones c on p.calificacionId=c.id
        inner join tipos t on p.tipoId=t.id
        inner join audios a on p.audioId=a.id

        where c.id= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$calificacion]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
        $sql = "SELECT count(p.id) AS cantidad FROM {$this->table} p
        inner join funciones f on f.peliculaId = p.id
        inner join programaciones pf on f.programacionId=pf.id
        WHERE p.id = :id AND pf.vigente=1";
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
