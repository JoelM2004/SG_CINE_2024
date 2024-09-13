<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;

use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\PeliculaDTO;

final class PeliculaDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, 'peliculas');
    }

    public function save(InterfaceDTO $object): void
    {

        $this->validate($object);

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
        $this->validate($object);

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
        $this->validatefunciones($id);
        $this->validatecomentarios($id);
        $this->validateimagenes($id);
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
        $this->existep($nombre);

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

        where p.nombre= :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id"=>$nombre]);
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

    private function validate(PeliculaDTO $object): void
    {
        if ($object->getNombre() == "") {
            throw new \Exception("El campo 'Nombre' está vacío, o contiene caracteres no permitidos.");
        }

        if ($object->getTituloOriginal() == "") {
            throw new \Exception("El campo 'Título Original' está vacío o supera el límite permitido.");
        }

        if ($object->getDuracion() <= 0) {
            throw new \Exception("El campo 'Duración' debe ser un número mayor que cero.");
        }

        if ($object->getAnoEstreno() <= 0) {
            throw new \Exception("El campo 'Año de Estreno' debe ser un número mayor que cero.");
        }

        if (($object->getDisponibilidad() != 0) && ($object->getDisponibilidad() != 1)) {
            throw new \Exception("El campo 'Disponibilidad' debe ser un número igual a 0 o 1.");
        }

        if ($object->getFechaIngreso() == "") {
            throw new \Exception("El campo 'Fecha de Ingreso' está vacío o no cumple con el formato de fecha 'YYYY-MM-DD'.");
        }

        if ($object->getSitioWebOficial() == "") {
            throw new \Exception("El campo 'Sitio Web Oficial' está vacío o supera el límite permitido.");
        }

        if ($object->getSinopsis() == "") {
            throw new \Exception("El campo 'Sinopsis' está vacío o supera el límite permitido.");
        }

        if ($object->getActores() == "") {
            throw new \Exception("El campo 'Actores' está vacío o supera el límite permitido.");
        }

        if ($object->getGeneroId() <= 0) {
            throw new \Exception("El campo 'Género ID' debe ser un número mayor que cero.");
        }

        if ($object->getPaisId() <= 0) {
            throw new \Exception("El campo 'País ID' debe ser un número mayor que cero.");
        }

        if ($object->getIdiomaId() <= 0) {
            throw new \Exception("El campo 'Idioma ID' debe ser un número mayor que cero.");
        }

        if ($object->getCalificacionId() <= 0) {
            throw new \Exception("El campo 'Calificación ID' debe ser un número mayor que cero.");
        }

        if ($object->getTipoId() <= 0) {
            throw new \Exception("El campo 'Tipo ID' debe ser un número mayor que cero.");
        }

        if ($object->getAudioId() <= 0) {
            throw new \Exception("El campo 'Audio ID' debe ser un número mayor que cero.");
        }
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

    private function validatefunciones($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM funciones f WHERE f.peliculaId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Existe una función que está utilizando está película, elimine la función/funciones para poder eliminar ésta película");
        }
    }

    private function validatecomentarios($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM comentarios f WHERE f.peliculaId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Existe un comentario que está utilizando está película, elimine el comentario/comentarios para poder eliminar ésta película");
        }
    }

    private function validateimagenes($id): void
    {
        $sql = "SELECT count(f.id) AS cantidad FROM imagenes f WHERE f.peliculaId =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $id
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad > 0) {
            throw new \Exception("Existe una imagen que está utilizando está película, elimine la/las imágenes para poder eliminar ésta película");
        }
    }

    private function existep ($nombre):void{

        $sql = "SELECT count(id) AS cantidad FROM {$this->table} WHERE nombre =:id";
        $stmt = $this->conn->prepare($sql);

        // Asumiendo que el método toArray() del objeto ClienteDTO devuelve un array asociativo con las claves 'correo' e 'id'
        $params = [
            ':id' => $nombre
        ];

        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_OBJ); // lo trae como un objeto a lo de arriba

        if ($result->cantidad = 0) {
            throw new \Exception("No existe está película");
        }

    }
}
