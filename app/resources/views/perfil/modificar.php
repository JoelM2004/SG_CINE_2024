<?php

use app\core\model\dao\PerfilDAO;
use app\libs\Connection\Connection;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new PerfilDAO($conn);
$datos = $dao->load($id);

?>

<div class="container-fluid my-4 row">
    <!-- Formulario de Edición de Perfiles -->
    <form id="formPerfil" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
        <h4 class="text-center text-primary">Edición de Perfil</h4>

        <div class="mb-3">
            <label for="nombrePerfil" class="form-label">Nombre del Perfil</label>
            <input type="text" class="form-control" id="nombrePerfil" value="<?= $datos->getNombre() ?>" placeholder="Ingrese el nombre del perfil">
        </div>

        <button type="button" id="btnModificarPerfil" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Perfiles -->
    <div class="col-lg-8 col-md-12">
        <div class="p-4 bg-light border rounded shadow-sm">
            <h4 class="text-primary">Listado de Perfiles</h4>

            <table id="tablaPerfil" class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre del Perfil</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbodyPerfil">
                    <tr id="filaModificarPerfil" data-id="<?= $datos->getId() ?>">
                        <th>1</th>
                        <td><?= $datos->getNombre() ?></td>
                        <td>
                            <button id="btnEliminarPerfiles" class="btn btn-sm btn-danger" title="Eliminar Perfil">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
