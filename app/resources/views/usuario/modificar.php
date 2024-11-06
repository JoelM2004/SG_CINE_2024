<?php

use app\core\model\dao\PerfilDAO;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;

$id = $_GET['id'];
$conn = Connection::get();
$dao = new UsuarioDAO($conn);
$datos = $dao->load($id);

$daoPerfil = new PerfilDAO($conn);
$datosPerfiles = $daoPerfil->list();

?>
<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Edición de Usuario -->
        <form id="formUsuarioM" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Edición de Usuario</h4>

            <div class="mb-3">
                <label for="cuentaUsuarioM" class="form-label">Cuenta</label>
                <input value="<?= $datos->getCuenta() ?>" type="text" class="form-control" id="cuentaUsuarioM" placeholder="Ingrese la cuenta del usuario">
            </div>

            <div class="mb-3">
                <label for="nombreUsuarioM" class="form-label">Nombre</label>
                <input value="<?= $datos->getNombres() ?>" type="text" class="form-control" id="nombreUsuarioM" placeholder="Ingrese el nombre del usuario">
            </div>

            <div class="mb-3">
                <label for="apellidoUsuarioM" class="form-label">Apellido</label>
                <input value="<?= $datos->getApellido() ?>" type="text" class="form-control" id="apellidoUsuarioM" placeholder="Ingrese el apellido del usuario">
            </div>

            <div class="mb-3">
                <label for="correoUsuarioM" class="form-label">Correo</label>
                <input value="<?= $datos->getCorreo() ?>" type="email" class="form-control" id="correoUsuarioM" placeholder="Ingrese el correo del usuario">
            </div>

            <div class="mb-3">
                <label for="tipoPerfilUsuarioM" class="form-label">Tipo de Perfil</label>
                <select id="tipoPerfilUsuarioM" class="form-select">
                    <?php
                    foreach ($datosPerfiles as $elemento) {
                        $selected = $datos->getPerfilId() == $elemento['id'] ? 'selected' : '';
                        echo '<option value="' . $elemento['id'] . '" ' . $selected . '>' . $elemento['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="button" id="btnModificarUsuario" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>

        <!-- Tabla de Usuarios -->
        <div class="col-lg-8 col-md-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Usuarios</h4>

                <table id="tablaUsuario" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Tipo de Perfil</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyUsuario">
                        <tr id="filaModificarUsuario" data-id="<?= $datos->getId() ?>">
                            <th><?= 1 ?></th>
                            <td><?= $datos->getCuenta() ?></td>
                            <td><?= $datos->getNombres() ?></td>
                            <td><?= $datos->getApellido() ?></td>
                            <td><?= $datos->getCorreo() ?></td>
                            <td>
                                <?php
                                $datosPerfil = $daoPerfil->load($datos->getPerfilId());
                                echo $datosPerfil->getNombre();
                                ?>
                            </td>
                            <td>
                                <button id="btnEliminarUsuarios" class="btn btn-sm btn-danger" title="Eliminar Usuario">
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
