<?php

use app\core\model\dao\ProgramacionDAO;
use app\libs\Connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new ProgramacionDAO($conn);
$datos = $dao->load($id);

// Función para formatear la fecha de "año/mes/día" a "día/mes/año"
function formatDate($date) {
    $parts = explode('-', $date);
    return isset($parts[2], $parts[1], $parts[0]) ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $date;
}

?>

<div class="container-fluid row">
    <!-- Formulario de Edición de Programación -->
    <form id="formProgramacionM" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Programación</h4>

        <div class="mb-3">
            <label for="fechaInicioM" class="form-label">Fecha de Inicio</label>
            <input type="date" value="<?= $datos->getFechaInicio() ?>" class="form-control" id="fechaInicioM">
        </div>

        <div class="mb-3">
            <label for="fechaFinM" class="form-label">Fecha de Finalización</label>
            <input type="date" value="<?= $datos->getFechaFin() ?>" class="form-control" id="fechaFinM">
        </div>

        <div class="mb-3">
            <label for="vigente" class="form-label">Vigente</label>
            <select class="form-select" id="vigenteM">
                <option value="1" <?= $datos->getVigente() == 1 ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= $datos->getVigente() == 0 ? 'selected' : '' ?>>No</option>
            </select>
        </div>

        <button type="button" id="btnModificarProgramacion" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Programación -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Programaciones</h4>

        <table id="tablaProgramacion" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha de Inicio</th>
                    <th scope="col">Fecha de Finalización</th>
                    <th scope="col">Vigente</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyProgramacion">
                <tr id="filaModificarProgramacion" data-id="<?= $datos->getId() ?>">
                    <th>1</th>
                    <td><?= formatDate($datos->getFechaInicio()) ?></td>
                    <td><?= formatDate($datos->getFechaFin()) ?></td>
                    <td>
                        <?php
                        if ($datos->getVigente() == 1) {
                            echo "<i class='fas fa-circle text-success' title='Activo'></i>";
                        } else {
                            echo "<i class='fas fa-circle text-danger' title='Desactivado'></i>";
                        }
                        ?>
                    </td>
                    <td>
                        <button id="btnEliminarProgramacion" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
