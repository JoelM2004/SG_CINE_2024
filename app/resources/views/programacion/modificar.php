<div class="container-fluid row">
    <!-- Formulario de Edición de Programación -->
    <form id="formProgramacion" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Programación</h4>

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

        <button type="button" id="btnGuardarProgramacion" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Programación -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Programaciones</h4>

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
                <!-- Aquí se llenarán las filas con las programaciones vigentes desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
