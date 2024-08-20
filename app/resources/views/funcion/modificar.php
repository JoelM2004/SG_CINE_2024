<div class="container-fluid row">
    <!-- Formulario de Edición de Entrada -->
    <form id="formEntrada" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Entrada</h4>

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
            <input type="text" class="form-control" id="duracion">
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

        <button type="button" id="btnGuardarEntrada" class="btn btn-primary w-100">Guardar Cambios</button>
    </form>

    <!-- Tabla de Entradas -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Entradas</h4>

        <table id="tablaEntradas" class="table table-light">
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
            <tbody id="tbodyEntradas">
                <!-- Aquí se llenarán las filas con las entradas desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>

