<?php

use app\core\model\dao\PerfilDAO;
use app\core\model\dao\UsuarioDAO;
use app\libs\connection\Connection;

$conn = Connection::get();

$daoPerfil = new PerfilDAO($conn);
$datos = $daoPerfil->list();

$daoUsuarios = new UsuarioDAO($conn);
$datosUSU = $daoUsuarios->list();

?>

<div class="container-fluid my-4 row">
    <!-- Formulario de Alta de Usuario -->
    <form id="formUsuario" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
        <h4 class="text-center text-primary">Registro de Usuarios</h4>

        <div class="mb-3">
            <label for="cuentaUsuario" class="form-label">Nombre de Cuenta</label>
            <input type="text" class="form-control" id="cuentaUsuario" placeholder="Ingrese el nombre de cuenta">
        </div>

        <div class="mb-3">
            <label for="nombreUsuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreUsuario" placeholder="Ingrese el nombre">
        </div>

        <div class="mb-3">
            <label for="apellidoUsuario" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellidoUsuario" placeholder="Ingrese el apellido">
        </div>

        <div class="mb-3">
            <label for="correoUsuario" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correoUsuario" placeholder="Ingrese el correo">
        </div>

        <div class="mb-3">
            <label for="claveUsuario" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="claveUsuario" placeholder="Ingrese la contraseña">
        </div>

        <div class="mb-3">
            <label for="tipoPerfil" class="form-label">Tipo de Perfil</label>
            <select id="tipoPerfil" class="form-select">
                <?php
                foreach ($datos as $elemento) {
                    echo '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="button" id="btnAltaUsuario" class="btn btn-primary w-100">Registrar Usuario</button>
    </form>

    <!-- Tabla de Usuarios -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-primary">Listado de Usuarios</h4>

        <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="row align-items-end mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Filtrar por:</label>
                    <select class="form-select" id="filterType">
                        <option value="">Seleccione un filtro</option>
                        <option value="cuenta">Nombre de Cuenta</option>
                        <option value="perfil">Tipo de Perfil</option>
                    </select>
                </div>

                <!-- Filtros específicos -->
                <div class="col-md-6 mb-3 d-none" id="filterCuenta">
                    <label class="form-label">Nombre de Cuenta</label>
                    <input type="text" class="form-control" id="filterNombreCuenta" placeholder="Nombre de Cuenta">
                </div>

                <div class="col-md-6 mb-3 d-none" id="filterPerfil">
                    <label class="form-label">Tipo de Perfil</label>
                    <select class="form-select" id="filterTipoPerfil">
                        <?php
                        foreach ($datos as $elemento) {
                            echo '<option value="' . $elemento['id'] . '">' . $elemento['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button id="btnBuscarUsuario" type="button" class="btn btn-outline-primary me-2">Buscar</button>
                    <button id="btnListarUsuario" type="button" class="btn btn-outline-primary me-2">Listar</button>
                    <button id="btnImprimirUsuario" type="button" class="btn btn-outline-success">PDF</button>
                </div>
            </div>
        </form>

        <table id="tablaUsuario" class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre de Cuenta</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Tipo de Perfil</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyUsuario">
                <!-- Aquí se llenarán las filas con los usuarios desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
