<?php

use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\SalaDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dao\AudioDAO;
use app\core\model\dao\TipoDAO;

use app\libs\connection\Connection;

$conn = Connection::get();

$daoPelicula = new PeliculaDAO($conn);
$datosPelicula = $daoPelicula->list();

$daoSala = new SalaDAO($conn);
$datosSala = $daoSala->list();

$daoProgramacion = new ProgramacionDAO($conn);
$datosProgramacion = $daoProgramacion->list();

$daoAudio = new AudioDAO($conn);
$datosAudio = $daoAudio->list();

$daoTipo = new TipoDAO($conn);
$datosTipo = $daoTipo->list();
?>


<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Alta de Funciones -->
        <form id="formFuncion" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Registro de Función</h4>

            <div class="mb-3">
                <label for="fechaProgramacion" class="form-label">Fecha de Programación</label>
                <select class="form-select" id="fechaProgramacion">
                    <?php
                    $txt = ''; // Inicializar $txt antes del bucle

                    // Función para formatear la fecha en PHP
                    function formatDate($dateString)
                    {
                        $dateParts = explode("-", $dateString);
                        return $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
                    }

                    $datosProgramacionInvertidos = array_reverse($datosProgramacion);

                    foreach ($datosProgramacionInvertidos as $elemento) {
                        $fechaInicioFormateada = formatDate($elemento['fechaInicio']);
                        $fechaFinFormateada = formatDate($elemento['fechaFin']);

                        $txt .= '<option value="' . $elemento['id'] . '">' . $fechaInicioFormateada . " a " . $fechaFinFormateada . '</option>';
                    }

                    echo $txt;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha">
            </div>

            <div class="mb-3">
                <label for="horaInicio" class="form-label">Hora de Inicio</label>
                <input type="time" class="form-control" id="horaInicio">
            </div>

            <div class="mb-3">
                <label for="numeroFuncion" class="form-label">Número de Función</label>
                <input type="number" class="form-control" id="numeroFuncion">
            </div>

            <div class="mb-3">
                <label for="filterPel" class="form-label">Filtrar Número de Función o Nombre de Película</label>
                <input type="text" class="form-control" id="filterPel" placeholder="Escribe para filtrar...">
            </div>

            <div class="mb-3">
                <label for="nombrePelicula" class="form-label">Nombre de la Película</label>
                <select class="form-select" id="nombrePelicula">
                    <?php
                    $txt = ''; // Inicializar $txt antes del bucle
                    // Invertir el array para que las últimas películas aparezcan primero
                    $datosPeliculaInvertido = array_reverse($datosPelicula);

                    foreach ($datosPeliculaInvertido as $elemento) {
                        echo '<option value="' . $elemento['id'] . '"  >' . $elemento['nombre'] . "-" . $daoAudio->load($elemento["audioId"])->getNombre() . "-" . $daoTipo->load($elemento["tipoId"])->getNombre() . '</option>';
                    }

                    echo $txt;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="numeroSala" class="form-label">Número de Sala</label>
                <select class="form-select" id="numeroSala">
                    <?php
                    $txt = ''; // Inicializar $txt antes del bucle

                    foreach ($datosSala as $elemento) {
                        $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['numeroSala'] . '</option>';
                    }

                    echo $txt;
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="duracion" class="form-label">Duración(en minutos)</label>
                <input type="number" class="form-control" id="duracion">
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" step="0.01">
            </div>

            <button type="button" id="btnAltaFuncion" class="btn btn-primary w-100">Registrar Función</button>
        </form>

        <!-- Tabla de Funciones -->
        <div class="col-lg-8 col-md-12 p-4 bg-light border rounded shadow-sm">
            <h4 class="text-primary">Listado de Funciones</h4>

            <!-- Barra de búsqueda con selección de filtro -->
            <form class="mb-4" id="filterForm">
                <div class="row align-items-end">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Filtrar por:</label>
                        <select class="form-select" id="filterType">
                            <option value="">Seleccione un filtro</option>
                            <option value="numeroSala">Número de Sala</option>
                            <option value="nombrePelicula">Nombre de la Película</option>
                            <option value="numeroFuncion">Número de Función</option>
                            <option value="fechaProgramacion">Fecha de Programación</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="filterNumeroSala">
                        <label class="form-label">Número de Sala</label>
                        <select class="form-select" id="filterNumeroSalaInput">
                            <?php
                            $txt = ''; // Inicializar $txt antes del bucle

                            foreach ($datosSala as $elemento) {
                                $txt .= '<option value="' . $elemento['id'] . '">' . $elemento['numeroSala'] . '</option>';
                            }

                            echo $txt;
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="filterPeliculaDIV">
                        <label for="filterPeliculaText" class="form-label">Filtrar Nombre de Película</label>
                        <input type="text" class="form-control" id="filterPeliculaText" placeholder="Escribe para filtrar...">
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="filterNombrePelicula">
                        <label class="form-label">Nombre de la Película</label>
                        <select class="form-select" id="filterNombrePeliculaInput">
                            <?php
                            $txt = ''; // Inicializar $txt antes del bucle

                            // Invertir el array para que las últimas películas aparezcan primero
                            $datosPeliculaInvertido = array_reverse($datosPelicula);

                            foreach ($datosPeliculaInvertido as $elemento) {
                                echo '<option value="' . $elemento['id'] . '" >' . $elemento['nombre'] . "-" . $daoAudio->load($elemento["audioId"])->getNombre() . "-" . $daoTipo->load($elemento["tipoId"])->getNombre() . '</option>';
                            }

                            echo $txt;
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="filterNumeroFuncion">
                        <label class="form-label">Número de Función</label>
                        <input type="number" class="form-control" id="filterNumeroFuncionInput">
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="filterFechaProgramacion">
                        <label class="form-label">Fecha de Programación</label>
                        <select class="form-select" id="filterFechaProgramacionInput">
                            <?php
                            $txt = ''; // Inicializar $txt antes del bucle

                            // Función para formatear la fecha en PHP
                            $datosProgramacionInvertidos = array_reverse($datosProgramacion);

                            foreach ($datosProgramacionInvertidos as $elemento) {
                                $fechaInicioFormateada = formatDate($elemento['fechaInicio']);
                                $fechaFinFormateada = formatDate($elemento['fechaFin']);

                                $txt .= '<option value="' . $elemento['id'] . '">' . $fechaInicioFormateada . " a " . $fechaFinFormateada . '</option>';
                            }

                            echo $txt;
                            ?>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button id="btnBuscarFuncion" type="button" class="btn btn-outline-primary me-2">Buscar</button>
                        <button id="btnListarFuncion" type="button" class="btn btn-outline-primary me-2">Listar</button>
                        <button id="btnPDFFuncion" type="button" class="btn btn-outline-success">PDF</button>
                    </div>
                </div>
            </form>

            <table id="tablaFunciones" class="table table-striped table-hover">
    <thead class="table-primary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora de Inicio</th>
            <th scope="col">Duración</th>
            <th scope="col">Número de Función</th>
            <th scope="col">Nombre de la Película</th>
            <th scope="col">Número de Sala</th>
            <th scope="col">Fecha de Programación</th>
            <th scope="col">Precio</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody id="tbodyFunciones">
        <!-- Aquí se llenarán las filas con las funciones desde la base de datos -->
    </tbody>
</table>

        </div>
    </div>
</div>