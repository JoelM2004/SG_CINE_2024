<?php

use app\core\model\dao\SalaDAO;
use app\libs\connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new SalaDAO($conn);
$datos = $dao->load($id);

?>

<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Edición de Sala -->
        <form id="formSalaM" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Edición de Sala</h4>

            <div class="mb-3">
                <label for="numeroSalaM" class="form-label">Número de Sala</label>
                <input value="<?= $datos->getNumeroSala() ?>" type="text" class="form-control" id="numeroSalaM" placeholder="Ingrese el número de sala">
            </div>

            <div class="mb-3">
                <label for="capacidadSalaM" class="form-label">Capacidad (butacas)</label>
                <input value="<?= $datos->getCapacidad() ?>" type="number" class="form-control" id="capacidadSalaM" placeholder="Ingrese la capacidad de la sala">
            </div>

            <div class="mb-3">
                <label for="estadoSalaM" class="form-label">Estado</label>
                <select id="estadoSalaM" class="form-select">
                    <option value="1" <?= $datos->getEstado() == 1 ? 'selected' : '' ?>>Habilitada</option>
                    <option value="0" <?= $datos->getEstado() == 0 ? 'selected' : '' ?>>Deshabilitada</option>
                </select>
            </div>

            <button type="button" id="btnModificarSala" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>

        <!-- Tabla de Salas -->
        <div class="col-lg-8 col-md-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Salas</h4>

                <table id="tablaSala" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Número de Sala</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodySala">
                        <tr id="filaModificarsala" data-id="<?= $datos->getId() ?>">
                            <th>1</th>
                            <td><?= $datos->getNumeroSala() ?></td>
                            <td><?= $datos->getCapacidad() ?></td>
                            <td>
                                <?php
                                if ($datos->getEstado() == 1) {
                                    echo "<i class='fas fa-circle text-success' title='Activo'></i>";
                                } else {
                                    echo "<i class='fas fa-circle text-danger' title='Desactivado'></i>";
                                }
                                ?>
                            </td>
                            <td>
                                <button id="btnEliminarSala" class="btn btn-sm btn-danger" title="Eliminar Sala">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
