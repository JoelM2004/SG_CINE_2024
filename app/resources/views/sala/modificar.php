<div class="container-fluid row">
    <!-- Formulario de Edición de Sala -->
    <form id="formSala" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Sala</h4>

        <div class="mb-3">
            <label for="numeroSala" class="form-label">Número de Sala</label>
            <input type="text" class="form-control" id="numeroSala" placeholder="Ingrese el número de sala">
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

        <button type="button" id="btnGuardarSala" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Salas -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Salas</h4>

        <table id="tablaSala" class="table table-light">
            <thead>
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

