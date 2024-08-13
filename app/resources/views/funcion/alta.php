<div class="container-fluid row">
    <!-- Formulario de Alta de Funciones -->
    <form id="formFuncion" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Registro de Función</h4>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha">
        </div>

        <div class="mb-3">
            <label for="horaInicio" class="form-label">Hora de Inicio</label>
            <input type="time" class="form-control" id="horaInicio">
        </div>

        <div class="mb-3">
            <label for="duracion" class="form-label">Duración</label>
            <input type="text" class="form-control" id="duracion" value="2h" readonly>
        </div>

        <div class="mb-3">
            <label for="numeroFuncion" class="form-label">Número de Función</label>
            <input type="number" class="form-control" id="numeroFuncion">
        </div>

        <div class="mb-3">
            <label for="nombrePelicula" class="form-label">Nombre de la Película</label>
            <select class="form-select" id="nombrePelicula">
                <!-- Opciones de películas -->
            </select>
        </div>

        <div class="mb-3">
            <label for="numeroSala" class="form-label">Número de Sala</label>
            <select class="form-select" id="numeroSala">
                <!-- Opciones de salas -->
            </select>
        </div>

        <div class="mb-3">
            <label for="fechaProgramacion" class="form-label">Fecha de Programación</label>
            <select class="form-select" id="fechaProgramacion">
                <!-- Opciones de fechas -->
            </select>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" step="0.01">
        </div>

        <button type="button" id="btnGuardarFuncion" class="btn btn-primary w-100">Registrar Función</button>
    </form>

    <!-- Tabla de Funciones -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Funciones</h4>

        <!-- Barra de búsqueda con selección de filtro -->
        <form class="mb-4" id="filterForm">
            <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                <label class="form-label me-2">Filtrar por:</label>
                <select class="form-select w-auto" id="filterType">
                    <option value="">Seleccione un filtro</option>
                    <option value="numeroSala">Número de Sala</option>
                    <option value="nombrePelicula">Nombre de la Película</option>
                    <option value="numeroFuncion">Número de Función</option>
                    <option value="fechaProgramacion">Fecha de Programación</option>
                </select>
            </div>

            <!-- Filtros específicos -->
            <div class="mb-3 d-none" id="filterNumeroSala">
                <label class="form-label">Número de Sala</label>
                <input type="number" class="form-control" id="filterNumeroSalaInput">
            </div>

            <div class="mb-3 d-none" id="filterNombrePelicula">
                <label class="form-label">Nombre de la Película</label>
                <select class="form-select" id="filterNombrePeliculaInput">
                    <!-- Opciones de películas -->
                </select>
            </div>

            <div class="mb-3 d-none" id="filterNumeroFuncion">
                <label class="form-label">Número de Función</label>
                <input type="number" class="form-control" id="filterNumeroFuncionInput">
            </div>

            <div class="mb-3 d-none" id="filterFechaProgramacion">
                <label class="form-label">Fecha de Programación</label>
                <select class="form-select" id="filterFechaProgramacionInput">
                    <!-- Opciones de fechas -->
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Buscar</button>
                <button type="button" class="btn btn-success">PDF</button>
            </div>
        </form>

        <table id="tablaFunciones" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora de Inicio</th>
                    <th scope="col">Duración</th>
                    <th scope="col">Número de Función</th>
                    <th scope="col">Nombre de la Película</th>
                    <th scope="col">Número de Sala</th>
                    <th scope="col">Fecha de Programación</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody id="tbodyFunciones">
                <!-- Aquí se llenarán las filas con las funciones desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
