<?php

use app\core\model\dao\AudioDAO;
use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\EntradaDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dao\TipoDAO;
use app\libs\connection\Connection;

$conn = Connection::get();

$daoPelicula = new PeliculaDAO($conn);

$daoUsuario = new UsuarioDAO($conn);
$datosUsuario = $daoUsuario->list();

$daoFuncion = new FuncionDAO($conn);
$datosFuncion = $daoFuncion->listActivas();
$datosFuncion = array_reverse($datosFuncion);

$daoEntrada = new EntradaDAO($conn);

$daoProgramacion = new ProgramacionDAO($conn);
$datosProgramacion = $daoProgramacion->list();

$daoAudio = new AudioDAO($conn);
$daoTipo = new TipoDAO($conn);

function formatDate($date)
{
    $parts = explode('-', $date);
    return isset($parts[2], $parts[1], $parts[0]) ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $date;
}

?>
<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Alta de Entradas -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <form id="formEntrada" class="p-4 bg-light border rounded shadow-sm" autocomplete="off">
                <h4 class="text-center text-primary">Registro de Entrada</h4>

                <div class="mb-3">
                    <label for="filterNumeroFuncionCREATE" class="form-label">Filtrar Número de Función o Nombre de Película</label>
                    <input type="text" class="form-control" id="filterNumeroFuncionCREATE" placeholder="Escribe para filtrar...">
                </div>

                <div class="mb-3">
                    <label for="numeroFuncion" class="form-label">Número de Función</label>
                    <select class="form-select" id="numeroFuncion">
                        <option value="0">Seleccione una opción</option>
                        <?php
                        foreach ($datosFuncion as $elemento) {
                            $datosPelicula = $daoPelicula->load($elemento->getPeliculaId());
                            echo '<option value="' . $elemento->getId() . '">' . $elemento->getNumeroFuncion() . "-" . $datosPelicula->getNombre() . "-" . ($daoAudio->load($datosPelicula->getAudioId()))->getNombre() . "-" . ($daoTipo->load($datosPelicula->getTipoId()))->getNombre() . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fechaHoraFuncion" class="form-label">Fecha y Hora de la Función</label>
                    <input type="datetime-local" class="form-control" id="fechaHoraFuncion" disabled>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad">
                </div>

                <div class="mb-3">
                    <label for="disponible" class="form-label">Entradas Disponibles</label>
                    <input type="number" class="form-control" id="disponible" disabled>
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" id="total" disabled>
                </div>

                <div class="mb-3">
                    <label for="filterCuentaClienteCREATE" class="form-label">Filtrar Cuenta del Cliente</label>
                    <input type="text" class="form-control" id="filterCuentaClienteCREATE" placeholder="Escribe para filtrar...">
                </div>

                <div class="mb-3">
                    <label for="cuentaCliente" class="form-label">Cuenta del Cliente</label>
                    <select class="form-select" id="cuentaCliente">
                        <?php
                        foreach ($datosUsuario as $elemento) {
                            echo '<option value="' . $elemento['id'] . '">' . $elemento['cuenta'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <button type="button" id="btnAltaEntrada" class="btn btn-primary w-100">Registrar Entrada</button>
            </form>
        </div>

        <!-- Tabla de Entradas -->
        <div class="col-lg-8 col-md-6 col-sm-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Entradas</h4>

                <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="row align-items-end">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Filtrar por:</label>
                    <select class="form-select" id="filterType">
                        <option value="">Seleccione un filtro</option>
                        <option value="numeroTicket">Número de Ticket</option>
                        <option value="numeroFuncion">Número de Función</option>
                        <option value="cuentaCliente">Cuenta del Cliente</option>
                        <option value="pelicula">Película</option>
                        <option value="programacion">Programación</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterNumeroTicket">
                    <label for="filterNumeroTicketInput" class="form-label">Número de Ticket</label>
                    <input type="number" class="form-control" id="filterNumeroTicketInput">
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterNumFunDIV">
                    <label for="filterNumFunText" class="form-label">Filtrar Número de Función</label>
                    <input type="text" class="form-control" id="filterNumFunText" placeholder="Escribe para filtrar...">
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterNumeroFuncion">
                    <label for="filterNumeroFuncionInput" class="form-label">Número de Función</label>
                    <select class="form-select" id="filterNumeroFuncionInput">
                        <option value="">Seleccione una función</option>
                        <?php
                        // Obtener funciones y llenar el select
                        $funcionesActivar = $daoFuncion->list();
                        foreach (($funcionesActivar) as $elemento) {
                            echo '<option value="' . $elemento["id"] . '">' . $elemento["numeroFuncion"] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterCuentaClienteDIV">
                    <label for="filterCuentaClienteText" class="form-label">Filtrar Cuenta del Cliente</label>
                    <input type="text" class="form-control" id="filterCuentaClienteText" placeholder="Escribe para filtrar...">
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterCuentaCliente">
                    <label for="filterCuentaClienteInput" class="form-label">Cuenta del Cliente</label>
                    <select class="form-select" id="filterCuentaClienteInput">
                        <option value="">Seleccione una cuenta</option>
                        <?php
                        foreach (($datosUsuario) as $elemento) {
                            echo '<option value="' . $elemento["id"] . '">' . $elemento["cuenta"] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterPeliculaDIV">
                    <label for="filterPeliculaText" class="form-label">Filtrar Número de Función</label>
                    <input type="text" class="form-control" id="filterPeliculaText" placeholder="Escribe para filtrar...">
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterPelicula">
                    <label for="filterPeliculaInput" class="form-label">Película</label>
                    <select class="form-select" id="filterPeliculaInput">
                        <option value="">Seleccione una película</option>
                        <?php
                        $datosPeliculasFunciones = $daoPelicula->list();
                        foreach ($datosPeliculasFunciones as $elemento) {
                            echo '<option value="' . $elemento["id"] . '">' . $elemento["nombre"] . "-" . ($daoAudio->load($elemento["audioId"]))->getNombre() . "-" . ($daoTipo->load($elemento["tipoId"]))->getNombre() . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterProgramacion">
                    <label for="filterProgramacionInput" class="form-label">Programación</label>
                    <select class="form-select" id="filterProgramacionInput">
                        <option value="">Seleccione una programación</option>
                        <?php
                        foreach ($datosProgramacion as $data) {
                            echo '<option value="' . $data["id"] . '">' . formatDate($data["fechaInicio"]) . " a " . formatDate($data["fechaFin"]) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button id="btnBuscarEntrada" type="button" class="btn btn-outline-primary me-2">Buscar</button>
                    <button id="btnListarEntrada" type="button" class="btn btn-outline-primary me-2">Listar</button>
                    <button id="btnPDFEntrada" type="button" class="btn btn-outline-success">PDF</button>
                </div>
            </div>
        </form>

                <table id="tablaEntradas" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Número de Función</th>
                            <th scope="col">Fecha y Hora de la Función</th>
                            <th scope="col">Fecha y Hora de la Venta</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Número de Ticket</th>
                            <th scope="col">Cuenta del Cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyEntradas">
                        <!-- Aquí se llenarán las filas con las entradas desde la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
