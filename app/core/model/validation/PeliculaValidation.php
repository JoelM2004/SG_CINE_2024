<?php

namespace app\core\model\validation;
use app\core\model\dto\PeliculaDTO;
use app\core\model\base\Validation;

final class PeliculaValidation extends Validation{

    public function __construct($conn)
    {
        parent::__construct($conn, "peliculas");
    }

    public function validate(PeliculaDTO $object): void
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
    public function validatefunciones($id): void
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

    public function validatecomentarios($id): void
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

    public function validateimagenes($id): void
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

    public function existep ($nombre):void{

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