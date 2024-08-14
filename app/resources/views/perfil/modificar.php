<?php

use app\core\model\dao\PerfilDAO;
use app\libs\Connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao= new PerfilDAO($conn);
$datos=$dao->load($id)?>

<div class="container-fluid row">
    <!-- Formulario de Edición de Perfiles -->
    <form id="formPerfil" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Perfil</h4>

        <div class="mb-3">
            <label for="nombrePerfil" class="form-label">Nombre del Perfil</label>
            <input type="text" class="form-control" id="nombrePerfil" value="<?= $datos->getNombre() ?>">
        </div>

        <button type="button" id="btnModificarPerfil" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Perfiles -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Perfiles</h4>

        <table id="tablaPerfil" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre del Perfil</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyPerfil">
                <tr id="filaModificarPerfil" data-id=<?= $datos->getId() ?>>
                    <th>1</th>
                    <td><?= $datos->getNombre() ?></td>
                    <td>
                        <a id="btnEliminarPerfiles" href=<?= APP_FRONT . 'perfil/create/0' ?> class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>