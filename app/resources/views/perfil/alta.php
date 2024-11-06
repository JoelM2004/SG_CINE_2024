<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Alta de Perfiles -->
        <form id="formPerfil" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Registro de Perfil</h4>

            <div class="mb-3">
                <label for="nombrePerfil" class="form-label">Nombre del Perfil</label>
                <input type="text" class="form-control" id="nombrePerfil" required placeholder="Ingrese el nombre del perfil">
            </div>

            <button type="button" id="btnGuardarPerfil" class="btn btn-primary w-100">Registrar Perfil</button>
        </form>

        <!-- Tabla de Perfiles -->
        <div class="col-lg-8 col-md-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Perfiles</h4>

                <!-- Barra de búsqueda con selección de filtro -->
                <form class="mb-4" id="filterFormPerfil">
                    <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                        <label class="form-label me-2">Buscar perfil por nombre:</label>
                        <input type="text" class="form-control w-auto me-2" id="filterNombrePerfil" placeholder="Nombre del perfil">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" id="btnBuscarPerfil" class="btn btn-outline-primary me-2">Buscar</button>
                        <button type="button" id="btnListarPerfil" class="btn btn-outline-primary me-2">Listar</button>
                        <button type="button" id="btnPDFPerfil" class="btn btn-outline-success">PDF</button>
                    </div>
                </form>

                <table id="tablaPerfil" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre del Perfil</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyPerfil">
                        <!-- Aquí se llenarán las filas con los perfiles desde la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
