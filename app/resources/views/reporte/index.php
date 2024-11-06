<?php

use app\core\model\dao\UsuarioDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dao\AudioDAO;
use app\core\model\dao\TipoDAO;

use app\libs\connection\Connection;

$conn = Connection::get();
$daoAudio = new AudioDAO($conn);
$datosAudio = $daoAudio->list();

$daoTipo = new TipoDAO($conn);
$datosTipo = $daoTipo->list();

$daoPelicula = new PeliculaDAO($conn);
$datosPelicula = $daoPelicula->list();

$daoUsuario = new UsuarioDAO($conn);

$daoFuncion = new FuncionDAO($conn);
$datosFuncion = $daoFuncion->list();

$daoProgramacion = new ProgramacionDAO($conn);
$datosProgramacion = $daoProgramacion->list();

function formatDate($dateString)
{
    $dateParts = explode("-", $dateString);
    return $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
}

?>
<div class="container mt-5" id="imprimir">
    <h1 class="text-center mb-5" style="font-size: 2.5rem; color: #343a40;">Generar Reportes de Cine</h1>

    <!-- Formulario para generación de reportes -->
    <form id="reporteForm">
        <div class="mb-4">
            <label for="tipoReporte" class="form-label fs-4">Selecciona el tipo de reporte:</label>
            <select id="tipoReporte" class="form-select form-select-lg" required>
                <option value="">Selecciona un Reporte</option>
                <option value="funciones">Reporte de Funciones</option>
                <option value="peliculas">Reporte de Películas</option>
                <option value="programaciones">Reporte de Programaciones</option>
                <option value="usuario">Reporte por Usuario</option>
            </select>
        </div>

        <!-- Sección para Reporte de Funciones -->
        <div id="funcionSection" class="row g-4" style="display: none;">
            <div class="col-md-6">
                <label for="funcionInput" class="form-label fs-5">Número de Función:</label>
                <select name="funcion" id="funcionInput" class="form-select">
                    <option value="">Selecciona una Función</option>
                    <?php
                    foreach ($datosFuncion as $elemento) {
                        echo '<option value="' . $elemento['id'] . '">' . $elemento['numeroFuncion'] . " - " . $daoPelicula->load($elemento["peliculaId"])->getNombre() . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Sección para Reporte de Películas -->
        <div id="peliculaSection" class="row g-4" style="display: none;">
            <div class="col-md-6">
                <label for="peliculaInput" class="form-label fs-5">Película:</label>
                <select name="pelicula" id="peliculaInput" class="form-select">
                    <option value="">Selecciona una Película</option>
                    <?php
                    foreach (array_reverse($datosPelicula) as $elemento) {
                        echo '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . " - " . $daoAudio->load($elemento["audioId"])->getNombre() . " - " . $daoTipo->load($elemento["tipoId"])->getNombre() . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Sección para Reporte de Programaciones -->
        <div id="programacionSection" class="row g-4" style="display: none;">
            <div class="col-md-6">
                <label for="programacionInput" class="form-label fs-5">Programación:</label>
                <select name="programacion" id="programacionInput" class="form-select">
                    <option value="">Selecciona una Programación</option>
                    <?php
                    foreach ($datosProgramacion as $elemento) {
                        echo '<option value="' . $elemento['id'] . '">' . formatDate($elemento['fechaInicio']) . " a " . formatDate($elemento['fechaFin']) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Sección para Reporte por Usuario -->
        <div id="usuarioSection" class="row g-4" style="display: none;">
            <div class="col-md-6">
                <label for="nombreUsuario" class="form-label fs-5">Nombre de Usuario:</label>
                <input type="text" id="nombreUsuario" class="form-control form-control-lg" placeholder="Ingresa el nombre de usuario">
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="button" class="btn btn-primary btn-lg" id="generarReporteBtn">Generar Reporte</button>
            <button type="button" class="btn btn-secondary btn-lg" id="generarPDFBtn">Generar PDF</button>
        </div>
    </form>

    <!-- Sección de resultados del reporte -->
    <div id="reporteResultado" class="mt-5 alert alert-info shadow-sm" style="display: none;">
        <h4 class="alert-heading fs-4">Resultado del Reporte</h4>
        <p id="reporteTexto" class="fs-5"></p>
    </div>

    <!-- Sección de métricas y tabla de entradas -->
    <div id="metricasSection" class="row g-4 mt-5" style="display: none;">
        <div class="col-md-6">
            <label for="entradasVendidas" class="form-label fs-5">Cantidad de Entradas Vendidas:</label>
            <input type="number" id="entradasVendidas" class="form-control form-control-lg" readonly>
        </div>
        <div class="col-md-6">
            <label for="totalRecaudado" class="form-label fs-5">Total Recaudado:</label>
            <input type="text" id="totalRecaudado" class="form-control form-control-lg" readonly>
        </div>
        <div class="col-md-6">
            <label for="precioPromedio" class="form-label fs-5">Precio Promedio de Entrada:</label>
            <input type="text" id="precioPromedio" class="form-control form-control-lg" readonly>
        </div>
        
        <!-- Tabla de entradas -->
        <div class="col-md-12 mt-4">
            <h4 class="fs-4 mb-3">Detalles de Entradas</h4>
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Cuenta Usuario</th>
                        <th>Número de Entrada</th>
                        <th>Número de Función</th>
                        <th>Fecha</th>
                        <th>Hora de Inicio</th>
                        <th>Nombre de Película</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody id="entradasTableBody">
                    <!-- Las filas se agregarán aquí mediante JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

