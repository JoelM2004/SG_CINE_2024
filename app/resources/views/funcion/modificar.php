<?php

use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\SalaDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\AudioDAO;
use app\core\model\dao\TipoDAO;
use app\libs\connection\Connection;

$conn = Connection::get();

$daoFuncion = new FuncionDAO($conn);
$datosFuncion = $daoFuncion->load($_GET["id"]);

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


<div class="container-fluid row">
    <!-- Formulario de Edición de Funcion -->
    <form id="formFuncionM" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Funcion</h4>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" value="<?=$datosFuncion->getFecha()?>">
        </div>

        <div class="mb-3">
            <label for="horaInicio" class="form-label">Hora de Inicio</label>
            <input type="time" class="form-control" id="horaInicio" value="<?=$datosFuncion->getHoraInicio()?>">
        </div>

        <div class="mb-3">
            <label for="duracion" class="form-label">Duración(en minutos)</label>
            <input type="number" class="form-control" id="duracion" value="<?=$datosFuncion->getDuracion()?>">
        </div>

        <div class="mb-3">
            <label for="numeroFuncion" class="form-label">Número de Función</label>
            <input type="number" class="form-control" id="numeroFuncion" value="<?=$datosFuncion->getNumeroFuncion()?>">
        </div>

        <div class="mb-3">
            <label for="nombrePelicula" class="form-label">Nombre de la Película</label>
            <select class="form-select" id="nombrePelicula">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                // Invertir el array para que las últimas películas aparezcan primero
                $datosPeliculaInvertido = array_reverse($datosPelicula);

                foreach ($datosPeliculaInvertido as $elemento) {
                    $selected = $datosFuncion->getPeliculaId() == $elemento['id'] ? 'selected' : '';



                    echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre']."-". $daoAudio->load($elemento["audioId"])->getNombre()."-".$daoTipo->load($elemento["tipoId"])->getNombre().'</option>';
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

                // Invertir el array para que las últimas películas aparezcan primero
                $datosSalaInvertido = array_reverse($datosSala);

                foreach ($datosSalaInvertido as $elemento) {
                    $selected = $datosFuncion->getSalaId() == $elemento['id'] ? 'selected' : '';
                    echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['numeroSala'] . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="fechaProgramacion" class="form-label">Fecha de Programación</label>
            <select class="form-select" id="fechaProgramacion">
            <?php
                $txt = ''; // Inicializar $txt antes del bucle

                function formatDate($dateString)
                {
                    $dateParts = explode("-", $dateString);
                    return $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
                }
                // Invertir el array para que las últimas películas aparezcan primero
                $datosProgramacionInvertido = array_reverse($datosProgramacion);

                foreach ($datosProgramacionInvertido as $elemento) {
                    $selected = $datosFuncion->getProgramacionId() == $elemento['id'] ? 'selected' : '';
                    echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . formatDate($elemento['fechaInicio'])." a ".formatDate($elemento["fechaFin"]) . '</option>';
                }

                echo $txt;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" step="0.01" value="<?=$datosFuncion->getPrecio()?>">
        </div>

        <button type="button" id="btnModificarFuncion" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Funcions -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Funcions</h4>

        <table id="tablaFunciones" class="table table-light">
            <thead>
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
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbodyFunciones">
            <tr id="filaModificarFuncion" data-id=<?= $datosFuncion->getId() ?>>
                    <th><?= 1 ?></th>
                    <td><?= formatDate( $datosFuncion->getFecha()) ?></td>
                    <td><?= $datosFuncion->getHoraInicio() ?></td>
                    <td><?= $datosFuncion->getDuracion() ?></td>
                    <td><?= $datosFuncion->getNumeroFuncion() ?></td>

                    <td>
                        <?php
                        $datosPelicula = $daoPelicula->load($datosFuncion->getPeliculaId());

echo $datosPelicula->getNombre()."-".$daoAudio->load($datosPelicula->getAudioId())->getNombre()."-".$daoTipo->load($datosPelicula->getTipoId())->getNombre()
                        ?>
                    </td>

                    <td>
                        <?php
                        $datosSala = $daoSala->load($datosFuncion->getSalaId());
                        echo $datosSala->getNumeroSala()
                        ?>
                    </td>

                    <td>
                        <?php



                        $datosProgramacion =$daoProgramacion->load($datosFuncion->getProgramacionId());
                        echo formatDate($datosProgramacion->getFechaInicio())." a ". formatDate($datosProgramacion->getFechaFin());
                        ?>
                    </td>

                    <td><?= $datosFuncion->getPrecio() ?></td>

                    <td>
                    <a id="btnBorrarFuncion" href="<?= APP_FRONT . "funcion/create/0" ?>" class="btn btn-sm btn-danger" data-id="<?= $_GET["id"] ?>">
                        <i class="fas fa-trash"></i>
                    </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

