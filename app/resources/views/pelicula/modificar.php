<?php

use app\core\model\dao\ImagenDAO;
use app\core\model\dao\TipoDAO;
use app\core\model\dao\CalificacionDAO;
use app\core\model\dao\AudioDAO;
use app\core\model\dao\PaisDAO;
use app\core\model\dao\IdiomaDAO;
use app\core\model\dao\GeneroDAO;
use app\core\model\dao\PeliculaDAO;
use app\libs\connection\Connection;

$conn = Connection::get();

$daoTipo = new TipoDAO($conn);
$datosTipo = $daoTipo->list();

$daoCalificacion = new CalificacionDAO($conn);
$datosCalificacion = $daoCalificacion->list();

$daoAudio = new AudioDAO($conn);
$datosAudio = $daoAudio->list();

$daoPais = new PaisDAO($conn);
$datosPais = $daoPais->list();

$daoGenero = new GeneroDAO($conn);
$datosGenero = $daoGenero->list();

$daoIdioma = new IdiomaDAO($conn);
$datosIdioma = $daoIdioma->list();

$daoPelicula = new PeliculaDAO($conn);
$datosPelicula = $daoPelicula->load($_GET["id"]);

$daoImagen = new ImagenDAO($conn);

?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Carta de Película -->

        <div class="card col-lg-8 col-md-10 col-sm-12 p-4" id="borrarPelicula" data-id=<?= $_GET["id"] ?>>
            <div class="row g-1">
                <!-- Imagen a la izquierda -->
                <div class="col-md-4">
                    <div class="text-center mb-3">
                        <img src="<?php
                                    // Obtén la imagen desde el DAO
                                    $img = $daoImagen->loadImagen($_GET['id']);

                                    // Verifica si la imagen no está disponible
                                    if (!empty($img)) {
                                        // Si hay imagen, muestra el src adecuado
                                        echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
                                    }   
                                    ?>" class="img-fluid" style="max-width: 100%; height: auto;">
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <form id="formPeliculaM" autocomplete="off">
                            <h4 class="card-title text-secondary">Edición de Películas</h4>



                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input value="<?= $datosPelicula->getNombre() ?>" type="text" class="form-control" id="nombre">
                            </div>

                            <div class="mb-3">
                                <label for="tituloOriginal" class="form-label">Título Original</label>
                                <input value="<?= $datosPelicula->getTituloOriginal() ?>" type="text" class="form-control" id="tituloOriginal">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="duracion" class="form-label">Duración (minutos)</label>
                                        <input value="<?= $datosPelicula->getDuracion() ?>" type="number" class="form-control" id="duracion" step="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="anioEstreno" class="form-label">Año de Estreno</label>
                                        <input value="<?= $datosPelicula->getAnoEstreno() ?>" type="number" class="form-control" id="anioEstreno" step="1">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="disponibilidad" class="form-label">Disponibilidad</label>
                                <select class="form-select" id="disponibilidad">
                                    <option <?= $datosPelicula->getDisponibilidad() == 1 ? "selected" : ""; ?> value="1">Habilitada</option>
                                    <option <?= $datosPelicula->getDisponibilidad() == 0 ? "selected" : ""; ?> value="0">Deshabilitada</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                                <input value="<?= $datosPelicula->getFechaIngreso() ?>" type="date" class="form-control" id="fechaIngreso">
                            </div>

                            <div class="mb-3">
                                <label for="sitioWeb" class="form-label">Sitio Web Oficial</label>
                                <input value="<?= $datosPelicula->getSitioWebOficial() ?>" type="url" class="form-control" id="sitioWeb">
                            </div>

                            <div class="mb-3">
                                <label for="sinopsis" class="form-label">Sinopsis</label>
                                <textarea class="form-control" id="sinopsis" rows="3"><?= $datosPelicula->getSinopsis() ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="actores" class="form-label">Actores</label>
                                <textarea rows="3" type="text" class="form-control" id="actores"><?= $datosPelicula->getActores() ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="genero" class="form-label">Género</label>
                                        <select class="form-select" id="genero">
                                            <?php
                                            foreach ($datosGenero as $elemento) {
                                                $selected = $datosPelicula->getGeneroId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pais" class="form-label">País</label>
                                        <select class="form-select" id="pais">
                                            <?php
                                            foreach ($datosPais as $elemento) {
                                                $selected = $datosPelicula->getPaisId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="idioma" class="form-label">Idioma</label>
                                        <select class="form-select" id="idioma">
                                            <?php
                                            foreach ($datosIdioma as $elemento) {
                                                $selected = $datosPelicula->getIdiomaId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="calificacion" class="form-label">Calificación</label>
                                        <select class="form-select" id="calificacion">
                                            <?php
                                            foreach ($datosCalificacion as $elemento) {
                                                $selected = $datosPelicula->getCalificacionId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select class="form-select" id="tipo">
                                            <?php
                                            foreach ($datosTipo as $elemento) {
                                                $selected = $datosPelicula->getTipoId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="audio" class="form-label">Audio</label>
                                        <select class="form-select" id="audio">
                                            <?php
                                            foreach ($datosAudio as $elemento) {
                                                $selected = $datosPelicula->getAudioId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="btnModificarPelicula" class="btn btn-primary w-100">Modificar Película</button>
                            <button type="button" id="btnBorrarPelicula" class="btn btn-danger w-100 mt-3">Borrar Película</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Carrusel de Fotos -->
<div id="carruselFotos" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Las imágenes se insertarán dinámicamente aquí -->
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carruselFotos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carruselFotos" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<!-- Sección para Agregar Nueva Imagen -->
<div class="row mt-4">
    <!-- Botón para Agregar Imagen -->
    <div class="col-md-6 col-lg-3 mb-3">
        <button type="submit" class="btn btn-secondary w-100" id="btnAgregarImagen">Agregar Imagen</button>
    </div>

    <!-- Campo para seleccionar una nueva imagen -->
    <div class="col-md-6 col-lg-3 mb-3">
        <label for="inputImagen" class="form-label">Seleccionar Imagen</label>
        <input type="file" class="form-control" id="inputImagen" accept="image/*">
    </div>

    <!-- Previsualización de Imagen -->
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="border p-2">
            <label for="previsualizarImagen" class="form-label">Previsualización de Imagen</label>
            <img id="previsualizarImagen" src="#" alt="Previsualización" class="img-fluid" style="display: none;">
        </div>
    </div>

    <!-- Selector de Portada -->
    <div class="col-md-6 col-lg-3 mb-3">
        <label for="esPortada" class="form-label">Portada</label>
        <select class="form-select" id="esPortada">
        <option value="0">No</option>    
        <option value="1">Sí</option>
            
        </select>
    </div>
</div>

<!-- Modal para ver la imagen en pantalla completa -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fas fa-arrow-left back-arrow" id="backToCarousel"></i>
                <img id="fullImage" src="#" alt="Imagen completa" class="img-fluid">
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>