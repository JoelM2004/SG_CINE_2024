<div class="container-fluid row">
    <!-- Formulario de Alta de Usuario -->
    <form id="formUsuario" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Registro de Usuarios</h4>

        <div class="mb-3">
            <label for="nombreCuenta" class="form-label">Nombre de Cuenta</label>
            <input type="text" class="form-control" id="nombreCuenta" placeholder="Ingrese el nombre de cuenta">
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
            <label for="tipoPerfil" class="form-label">Tipo de Perfil</label>
            <select id="tipoPerfil" class="form-select">
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
        </div>

        <button type="button" id="btnGuardarUsuario" class="btn btn-primary w-100">Registrar Usuario</button>
    </form>

    <!-- Tabla de Usuarios -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Usuarios</h4>

        <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                <label class="form-label me-2">Filtrar por:</label>
                <select class="form-select w-auto" id="filterType">
                    <option value="">Seleccione un filtro</option>
                    <option value="cuenta">Nombre de Cuenta</option>
                    <option value="perfil">Tipo de Perfil</option>
                </select>
            </div>

            <!-- Filtros específicos -->
            <div class="mb-3 d-none" id="filterCuenta">
                <label class="form-label">Nombre de Cuenta</label>
                <input type="text" class="form-control" id="filterNombreCuenta" placeholder="Nombre de Cuenta">
            </div>

            <div class="mb-3 d-none" id="filterPerfil">
                <label class="form-label">Tipo de Perfil</label>
                <select class="form-select" id="filterTipoPerfil">
                    <option value="">Todos</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Buscar</button>
                <button type="button" class="btn btn-success">PDF</button>
            </div>
        </form>

        <table id="tablaUsuario" class="table table-light">
            <thead>
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
