<?php
use app\core\model\dao\PeliculaDAO;
use app\libs\Connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new PeliculaDAO($conn);
$datos = $dao->loadView($id);

// var_dump($datos)
?>

<div class="container mt-5">
  <div class="card mb-3 shadow-sm">
    <div class="row g-0">
      <!-- Imagen de la película -->
      <div class="col-md-4">
        <img src="assets/img/pelicula.jpg" class="card-img-top" alt="Imagen de la película">
      </div>

      <!-- Contenido de la tarjeta -->
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title mb-3"><?= $datos['nombre'] ?></h5>
          <p class="card-text"><strong>Sinopsis:</strong> <?= $datos['sinopsis'] ?></p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Duración:</strong> <?= $datos['duracion'] ?> min</li>
            <li class="list-group-item"><strong>Género:</strong> <?= $datos['genero'] ?></li>
            <li class="list-group-item"><strong>Calificación:</strong> <?= $datos['calificacion'] ?></li>
            <li class="list-group-item"><strong>Fecha de Ingreso:</strong> <?= date('d/m/Y', strtotime($datos['fechaIngreso'])) ?></li>
            <li class="list-group-item"><strong>Tipo:</strong> <?= $datos['tipo'] ?></li>
            <li class="list-group-item"><strong>Audio:</strong> <?= $datos['audio'] ?></li>
            <li class="list-group-item"><strong>Idioma:</strong> <?= $datos['idioma'] ?></li>
            <li class="list-group-item"><strong>País de Origen:</strong> <?= $datos['pais'] ?></li>
          </ul>

          <h6 class="mt-3 mb-2">Actores:</h6>
          <p><?= $datos['actores'] ?></p>

          <h6 class="mt-3 mb-2">Sitio Web:</h6>
          <p><a href="<?= $datos['sitioWebOficial'] ?>" target="_blank" class="card-link">Visita el sitio web de la película</a></p>

          <div class="card-body">
            <a href="<?= APP_FRONT . "funcion/view/" . $id ?>" class="btn btn-primary">Entradas y Funciones Disponibles</a>
            <a href="<?= APP_FRONT . "comentario/index/" . $id ?>" class="btn btn-primary">Deja tu opinión acerca de la película</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Carrusel de imágenes o tráiler -->
<!-- <div id="movieCarousel" class="carousel slide mt-4">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/trailer1.jpg" class="d-block w-100" alt="Imagen 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/trailer2.jpg" class="d-block w-100" alt="Imagen 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/trailer3.jpg" class="d-block w-100" alt="Imagen 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> -->
