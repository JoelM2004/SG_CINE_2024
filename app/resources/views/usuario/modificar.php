<div class="container-fluid row">
    <!-- Formulario de Edición de Usuario -->
    <form id="formUsuario" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Usuario</h4>

        <div class="mb-3">
            <label for="cuentaUsuario" class="form-label">Cuenta</label>
            <input type="text" class="form-control" id="cuentaUsuario" placeholder="Ingrese la cuenta del usuario">
        </div>

        <div class="mb-3">
            <label for="nombreUsuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombreUsuario" placeholder="Ingrese el nombre del usuario">
        </div>

        <div class="mb-3">
            <label for="apellidoUsuario" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellidoUsuario" placeholder="Ingrese el apellido del usuario">
        </div>

        <div class="mb-3">
            <label for="correoUsuario" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correoUsuario" placeholder="Ingrese el correo del usuario">
        </div>

        <div class="mb-3">
            <label for="tipoPerfilUsuario" class="form-label">Tipo de Perfil</label>
            <select id="tipoPerfilUsuario" class="form-select">
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
        </div>

        <button type="button" id="btnGuardarUsuario" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Usuarios -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Usuarios</h4>

        <table id="tablaUsuario" class="table table-light">
            <thead>
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
                <!-- Aquí se llenarán las filas con los usuarios desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
