<div class="container-fluid row">
    <!-- Formulario de Filtros -->
    <form class="mb-4" id="filterForm">
        <div class="d-flex flex-column flex-md-row align-items-center mb-3">
            <label class="form-label me-2">Filtrar por:</label>
            <select class="form-select w-auto" id="filterType">
                <option value="">Seleccione un filtro</option>
                <option value="ticket">Número de Ticket</option>
                <option value="funcion">Número de Función</option>
                <option value="cuenta">Cuenta del Cliente</option>
            </select>
        </div>

        <!-- Filtros específicos -->
        <div class="mb-3 d-none" id="filterTicket">
            <label class="form-label">Número de Ticket</label>
            <input type="text" class="form-control" id="filterNumeroTicket" placeholder="Número de Ticket">
        </div>

        <div class="mb-3 d-none" id="filterFuncion">
            <label class="form-label">Número de Función</label>
            <input type="text" class="form-control" id="filterNumeroFuncion" placeholder="Número de Función">
        </div>

        <div class="mb-3 d-none" id="filterCuenta">
            <label class="form-label">Cuenta del Cliente</label>
            <input type="text" class="form-control" id="filterCuentaCliente" placeholder="Cuenta del Cliente">
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Buscar</button>
            <button type="button" class="btn btn-success">PDF</button>
        </div>
    </form>

    <!-- Tabla de Entradas -->
    <div class="col-lg-12 p-4">
        <h4 class="text-secondary">Listado de Entradas</h4>

        <table id="tablaEntradas" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número de Función</th>
                    <th scope="col">Fecha y Hora de la Función</th>
                    <th scope="col">Fecha y Hora de la Venta</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Número de Ticket</th>
                    <th scope="col">Cuenta del Cliente</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyEntradas">
                <!-- Aquí se llenarán las filas con las entradas desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
