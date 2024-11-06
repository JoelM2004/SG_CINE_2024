<div class="container-fluid my-4">
    <div class="row g-3">
        <!-- Formulario de Alta de Programación -->
        <form id="formProgramacion" class="col-lg-4 col-md-6 col-sm-12 p-4 bg-light border rounded shadow-sm" autocomplete="off">
            <h4 class="text-center text-primary">Registro de Programación</h4>

            <div class="mb-3">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fechaInicio">
            </div>

            <div class="mb-3">
                <label for="fechaFin" class="form-label">Fecha de Finalización</label>
                <input type="date" class="form-control" id="fechaFin">
            </div>

            <div class="mb-3">
                <label for="vigente" class="form-label">Vigente</label>
                <select class="form-select" id="vigente">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="button" id="btnAltaProgramacion" class="btn btn-primary w-100">Registrar Programación</button>
        </form>

        <!-- Tabla de Programación -->
        <div class="col-lg-8 col-md-12">
            <div class="p-4 bg-light border rounded shadow-sm">
                <h4 class="text-primary">Listado de Programación</h4>

                <!-- Barra de búsqueda con selección de filtro -->
                <form class="mb-4" id="filterForm">
                    <div class="row align-items-end">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Filtrar por:</label>
                            <select class="form-select" id="filterType" onchange="toggleFilters()">
                                <option value="vigente">Vigente</option>
                                <option value="fechaRango">Rango de Fecha</option>
                            </select>
                        </div>

                        <!-- Filtro de Programaciones Vigentes -->
                        <div class="col-md-6 mb-3" id="filterVigenteDiv">
                            <label class="form-label">Mostrar solo programaciones vigentes:</label>
                            <select class="form-select" id="filterVigente">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <!-- Filtro por Rango de Fechas (Oculto por defecto) -->
                        <div class="row g-2 d-none" id="filterFechaRangoDiv">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Desde:</label>
                                <input type="date" class="form-control" id="fechaInicioFilter">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hasta:</label>
                                <input type="date" class="form-control" id="fechaFinFilter">
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button id="btnBuscarProgramacion" type="button" class="btn btn-outline-primary me-2">Buscar</button>
                            <button id="btnListarProgramacion" type="button" class="btn btn-outline-primary me-2">Listar</button>
                            <button id="btnPDFProgramacion" type="button" class="btn btn-outline-success">PDF</button>
                        </div>
                    </div>
                </form>

                <table id="tablaProgramacion" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha de Finalización</th>
                            <th scope="col">Vigente</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyProgramacion">
                        <!-- Aquí se llenarán las filas con la programación desde la base de datos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

