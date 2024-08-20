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

            throw new \Exception("La Pelicula no se cargó correctamente");
        }

        return new PeliculaDTO($stmt->fetch(\PDO::FETCH_ASSOC));
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

    public function loadByNombrePelicula($nombre): PeliculaDTO
    {
        $sql = "SELECT * FROM {$this->table} WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute(["nombre" => $nombre]);

        if ($stmt->rowCount() !== 1) {

            throw new \Exception("La Pelicula no se cargó correctamente");
        }

        return new PeliculaDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function loadByGenero($generoId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE generoId = :generoId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["generoId" => $generoId]);

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }

        return $Peliculas;
    }

    public function loadByPais($pais): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE paisId = :paisId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["paisId" => $pais]);

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }

        return $Peliculas;
    }

    public function loadByIdioma($idioma): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE idiomaId = :idiomaId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["idiomaId" => $idioma]);

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }

        return $Peliculas;
    }
    
    public function loadByCalificacion($calificacion): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE calificacionId = :calificacionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["calificacionId" => $calificacion]);

        // Recuperar todos los resultados y convertirlos a objetos PeliculaDTO
        $Peliculas = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $Peliculas[] = new PeliculaDTO($row);
        }

        return $Peliculas;
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
}
