<?php

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
?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Carta de Película -->
        <div class="card col-lg-8 col-md-10 col-sm-12 p-4" id="borrarPelicula" data-id= <?= $_GET["id"] ?> >
            <div class="row g-0">
                <div class="col-md-4">
                    <img id="imagenPreview" src="#" class="img-fluid rounded-start" alt="Imagen de la Película">
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
                                <option <?php echo $datosPelicula->getDisponibilidad() == 1 ? "selected" : ""; ?> value="1">Habilitada</option>
                                <option <?php echo $datosPelicula->getDisponibilidad() == 0 ? "selected" : ""; ?> value="0">Deshabilitada</option>
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
                                            $txt = ''; // Inicializar $txt antes del bucle
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
                                            $txt = ''; // Inicializar $txt antes del bucle
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
                                            $txt = ''; // Inicializar $txt antes del bucle
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
                                            $txt = ''; // Inicializar $txt antes del bucle
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
                                            $txt = ''; // Inicializar $txt antes del bucle
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
                                            $txt = ''; // Inicializar $txt antes del bucle
                                            foreach ($datosAudio as $elemento) {
                                                $selected = $datosPelicula->getAudioId() == $elemento['id'] ? 'selected' : '';
                                                echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="imagen1" class="form-label">Portada 1</label>
                                        <input type="file" class="form-control" id="imagen1" accept="image/*" onchange="previewImage(event, 'imagenPreview1')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="imagen2" class="form-label">Secundaria </label>
                                        <input type="file" class="form-control" id="imagen2" accept="image/*" onchange="previewImage(event, 'imagenPreview2')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="imagen3" class="form-label">Terciaria</label>
                                        <input type="file" class="form-control" id="imagen3" accept="image/*" onchange="previewImage(event, 'imagenPreview3')">
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="btnModificarPelicula" class="btn btn-primary w-100 ">Modificar Película</button>
                            <a id="btnBorrarPelicula" href="<?= APP_FRONT . 'pelicula/create/0' ?>" class="btn btn-danger w-100 mt-3">Borrar Película</a>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para la vista previa de imágenes -->
<script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById(previewId);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>