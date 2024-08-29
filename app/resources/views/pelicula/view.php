<?php
use app\core\model\dao\PeliculaDAO;
use app\libs\Connection\Connection;
use app\core\model\dao\ImagenDAO;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new PeliculaDAO($conn);
$datos = $dao->loadView($id);


$daoImagen = new ImagenDAO($conn);
// var_dump($datos)
?>

<div class="container mt-5">
  <div class="card mb-3 shadow-sm">
    <div class="row g-0">
      <!-- Imagen de la película -->
      <div class="col-md-4">
        <img src="<?php
                                    // Obtén la imagen desde el DAO
                                    $img = $daoImagen->loadImagen($_GET['id']);

                                    // Verifica si la imagen no está disponible
                                    if (!empty($img)) {
                                        // Si hay imagen, muestra el src adecuado
                                        echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
                                    }   
                                    ?>" class="card-img-top" alt="Imagen de la película">
      </div>

      <!-- Contenido de la tarjeta -->
      <div class="col-md-8" data-id=<?=$id?> id="peliculaUsuario">
        <div class="card-body">
          <h5 class="card-title mb-3"><i class="fas fa-film"></i> <?= $datos['nombre'] ?></h5>
          <p class="card-text"><strong><i class="fas fa-scroll"></i> Sinopsis:</strong> <?= $datos['sinopsis'] ?></p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong><i class="fas fa-clock"></i> Duración:</strong> <?= $datos['duracion'] ?> min</li>
            <li class="list-group-item"><strong><i class="fas fa-theater-masks"></i> Género:</strong> <?= $datos['genero'] ?></li>
            <li class="list-group-item"><strong><i class="fas fa-star"></i> Calificación:</strong> <?= $datos['calificacion'] ?></li>
            <li class="list-group-item"><strong><i class="fas fa-calendar-alt"></i> Fecha de Ingreso:</strong> <?= date('d/m/Y', strtotime($datos['fechaIngreso'])) ?></li>
            <li class="list-group-item"><strong><i class="fas fa-tag"></i> Tipo:</strong> <?= $datos['tipo'] ?></li>
            <li class="list-group-item"><strong><i class="fas fa-volume-up"></i> Audio:</strong> <?= $datos['audio'] ?></li>
            <li class="list-group-item"><strong><i class="fas fa-language"></i> Idioma:</strong> <?= $datos['idioma'] ?></li>
            <li class="list-group-item"><strong><i class="fas fa-globe"></i> País de Origen:</strong> <?= $datos['pais'] ?></li>
          </ul>

          <h6 class="mt-3 mb-2"><i class="fas fa-users"></i> Actores:</h6>
          <p><?= $datos['actores'] ?></p>

          <h6 class="mt-3 mb-2"><i class="fas fa-globe"></i> Sitio Web:</h6>
          <p><a href="<?= $datos['sitioWebOficial'] ?>" target="_blank" class="card-link"><i class="fas fa-external-link-alt"></i> Visita el sitio web de la película</a></p>

          <div class="card-body" id="divListarImagenes">
            <a href="<?= APP_FRONT . "funcion/view/" . $id ?>" class="btn btn-primary"><i class="fas fa-ticket-alt"></i> Entradas y Funciones Disponibles</a>
            <a href="<?= APP_FRONT . "comentario/index/" . $id ?>" class="btn btn-primary"><i class="fas fa-comments"></i> Deja tu opinión acerca de la película</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Carrusel de imágenes o tráiler -->

<div id="movieCarousel" class="carousel slide mt-4">
  <div class="carousel-inner">
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> 
