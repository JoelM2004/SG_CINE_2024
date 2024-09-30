<div class="container-fluid row">
    <!-- Formulario de Alta de Programación -->
    <form id="formProgramacion" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Registro de Programación</h4>

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
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Programación</h4>

        <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                <label class="form-label me-2">Filtrar por:</label>
                <select class="form-select w-auto" id="filterType" onchange="toggleFilters()">
                    <option value="vigente">Vigente</option>
                    <option value="fechaRango">Rango de Fecha</option>
                </select>
            </div>

            <!-- Filtro de Programaciones Vigentes -->
            <div id="filterVigenteDiv" class="d-flex flex-column flex-md-row align-items-center mb-3">
                <label class="form-label me-2">Mostrar solo programaciones vigentes:</label>
                <select class="form-select w-auto" id="filterVigente">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Filtro por Rango de Fechas (Oculto por defecto) -->
            <div id="filterFechaRangoDiv" class="d-flex flex-column flex-md-row align-items-center mb-3 d-none">
                <label class="form-label me-2">Desde:</label>
                <input type="date" class="form-control w-auto" id="fechaInicioFilter">
                <label class="form-label me-2 ms-3">Hasta:</label>
                <input type="date" class="form-control w-auto" id="fechaFinFilter">
            </div>

            <div class="d-flex justify-content-end">
                <button id="btnBuscarProgramacion" type="button" class="btn btn-primary me-2">Buscar</button>
                <button id="btnListarProgramacion" type="button" class="btn btn-primary me-2">Listar</button>
                <button id="btnPDFProgramacion" type="button" class="btn btn-success">PDF</button>
            </div>
        </form>


        <table id="tablaProgramacion" class="table table-light">
            <thead>
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