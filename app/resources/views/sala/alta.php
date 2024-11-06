<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Carga de Sala -->
        <form id="formSala" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Registro de Salas</h4>

            <div class="mb-3">
                <label for="numeroSala" class="form-label">Número de Sala</label>
                <input type="number" class="form-control" id="numeroSala" placeholder="Ingrese el número de sala">
            </div>

            <div class="mb-3">
                <label for="capacidadSala" class="form-label">Capacidad (butacas)</label>
                <input type="number" class="form-control" id="capacidadSala" placeholder="Ingrese la capacidad de la sala">
            </div>

            <div class="mb-3">
                <label for="estadoSala" class="form-label">Estado</label>
                <select id="estadoSala" class="form-select">
                    <option value="1">Habilitada</option>
                    <option value="0">Deshabilitada</option>
                </select>
            </div>

            <button type="button" id="btnAltaSala" class="btn btn-primary w-100">Cargar Sala</button>
        </form>

        <!-- Tabla de Salas -->
        <div class="col-lg-8 col-md-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Salas</h4>

                <!-- Barra de búsqueda con selección de filtro -->
                <form class="mb-4" id="filterForm">
                    <div class="row align-items-end">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Filtrar por:</label>
                            <select class="form-select" id="filterType">
                                <option value="">Seleccione un filtro</option>
                                <option value="numero">Número de Sala</option>
                                <option value="estado">Estado</option>
                                <option value="capacidad">Rango de Capacidad</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 d-none" id="filterNumero">
                            <label class="form-label">Número de Sala</label>
                            <input type="text" class="form-control" id="filterNumeroSala" placeholder="Número de Sala">
                        </div>

                        <div class="col-md-6 mb-3 d-none" id="filterEstado">
                            <label class="form-label">Estado</label>
                            <select class="form-select" id="filterEstadoSelect">
                                <option value="1">Habilitada</option>
                                <option value="0">Deshabilitada</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 d-none" id="filterCapacidad">
                            <label class="form-label">Rango de Capacidad</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="filterCapacidadMin" placeholder="Min">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="filterCapacidadMax" placeholder="Max">
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button id="btnBuscarSala" type="button" class="btn btn-outline-primary me-2">Buscar</button>
                            <button id="btnListarSala" type="button" class="btn btn-outline-primary me-2">Listar</button>
                            <button id="btnPDFSala" type="button" class="btn btn-outline-success">PDF</button>
                        </div>
                    </div>
                </form>

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
                        <!-- Aquí se llenarán las filas con las salas desde la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
