<?php

use app\core\model\dao\TipoDAO;
use app\core\model\dao\CalificacionDAO;
use app\core\model\dao\AudioDAO;
use app\core\model\dao\PaisDAO;
use app\core\model\dao\IdiomaDAO;
use app\core\model\dao\GeneroDAO;

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
?>


<div class="container-fluid row">
    <!-- Formulario de Gestión de Películas -->
    <form id="formPelicula" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Gestión de Películas</h4>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre">
        </div>

        <div class="mb-3">
            <label for="tituloOriginal" class="form-label">Título Original</label>
            <input type="text" class="form-control" id="tituloOriginal">
        </div>

        <div class="mb-3">
            <label for="duracion" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" id="duracion" step="1">
        </div>

        <div class="mb-3">
            <label for="anioEstreno" class="form-label">Año de Estreno</label>
            <input type="number" class="form-control" id="anioEstreno" step="1">
        </div>

        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select class="form-select" id="disponibilidad">
                <option value="1">Habilitada</option>
                <option value="0">Deshabilitada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fechaIngreso">
        </div>

        <div class="mb-3">
            <label for="sitioWeb" class="form-label">Sitio Web Oficial</label>
            <input type="url" class="form-control" id="sitioWeb">
        </div>

        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis</label>
            <textarea class="form-control" id="sinopsis" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="actores" class="form-label">Actores</label>
            <textarea class="form-control" id="actores" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosGenero as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <select class="form-select" id="pais">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosPais as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="idioma" class="form-label">Idioma</label>
            <select class="form-select" id="idioma">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosIdioma as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación</label>
            <select class="form-select" id="calificacion">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosCalificacion as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosTipo as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="audio" class="form-label">Audio</label>
            <select class="form-select" id="audio">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosAudio as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>


        <button type="button" id="btnAltaPelicula" class="btn btn-primary w-100">Guardar Película</button>
    </form>

    <!-- Tabla de Películas -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Películas</h4>

        <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                <label class="form-label me-2">Filtrar por:</label>
                <select class="form-select w-auto" id="filterType">
                    <option value="">Seleccione un filtro</option>
                    <option value="genero">Género</option>
                    <option value="pais">País</option>
                    <option value="idioma">Idioma</option>
                    <option value="calificacion">Calificación</option>
                    <option value="titulo">Título</option>
                </select>
            </div>

            <!-- Filtros específicos -->
            <div class="mb-3 d-none" id="filterGenero">
                <label class="form-label">Género</label>
                <select class="form-select" id="filterGeneroInput">
                <?php
                $txt = ''; // Inicializar $txt antes del bucle

                foreach ($datosGenero as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
                </select>
            </div>

            <div class="mb-3 d-none" id="filterPais">
                <label class="form-label">País</label>
                <select class="form-select" id="filterPaisInput">
                <?php
                $txt = ''; 

                foreach ($datosPais as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
                </select>
            </div>

            <div class="mb-3 d-none" id="filterIdioma">
                <label class="form-label">Idioma</label>
                <select class="form-select" id="filterIdiomaInput">
                <?php
                $txt = ''; 

                foreach ($datosIdioma as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
                </select>
            </div>

            <div class="mb-3 d-none" id="filterCalificacion">
                <label class="form-label">Calificación</label>
                <select class="form-select" id="filterCalificacionInput">
                <?php
                $txt = '';  

                foreach ($datosCalificacion as $elemento) {
                    $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }

                echo $txt;
                ?>
                </select>
            </div>

            <div class="mb-3 d-none" id="filterTitulo">
                <label class="form-label">Título de la Película</label>
                <input type="text" class="form-control" id="filterTituloInput">
            </div>

            <div class="d-flex justify-content-end">
                <button id="btnBuscarPelicula" type="button" class="btn btn-primary me-2">Buscar</button>
                <button id="btnListarPelicula" type="button" class="btn btn-primary me-2">Listar</button>
                <button id="btnPDFPelicula" type="button" class="btn btn-success">PDF</button>
            </div>
        </form>

        <table id="tablaPelicula" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Duración</th>
                    <th scope="col">Año de Estreno</th>
                    <th scope="col">Disponibilidad</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Género</th>
                    <th scope="col">País</th>
                    <th scope="col">Idioma</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Audio</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyPelicula">
                <!-- Aquí se llenarán las filas con las películas desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>

