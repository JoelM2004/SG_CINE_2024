<div class="container-fluid row">
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

        <div class="d-flex justify-content-end mt-3">
            <button type="button" id="btnToggleEntrada" class="btn btn-primary">Activar Entrada</button>
        </div>
    </div>
</div>
