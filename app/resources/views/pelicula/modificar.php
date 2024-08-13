<div class="container-fluid row">
    <!-- Formulario de Gestión de Películas -->
    <form id="formPelicula" class="col-lg-4 col-md-6 col-sm-12 p-3" autocomplete="off">
        <h4 class="text-center text-secondary">Edición de Películas</h4>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre">
        </div>

        <div class="mb-3">
            <label for="tituloOriginal" class="form-label">Título Original</label>
            <input type="text" class="form-control" id="tituloOriginal">
        </div>

        <div class="mb-3">
            <label for="duracion" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" id="duracion" step="1">
        </div>

        <div class="mb-3">
            <label for="anioEstreno" class="form-label">Año de Estreno</label>
            <input type="number" class="form-control" id="anioEstreno" step="1">
        </div>

        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <input type="text" class="form-control" id="disponibilidad">
        </div>

        <div class="mb-3">
            <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fechaIngreso">
        </div>

        <div class="mb-3">
            <label for="sitioWeb" class="form-label">Sitio Web Oficial</label>
            <input type="url" class="form-control" id="sitioWeb">
        </div>

        <div class="mb-3">
            <label for="sinopsis" class="form-label">Sinopsis</label>
            <textarea class="form-control" id="sinopsis" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="actores" class="form-label">Actores</label>
            <input type="text" class="form-control" id="actores">
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero">
                <!-- Opciones de género aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <select class="form-select" id="pais">
                <!-- Opciones de país aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="idioma" class="form-label">Idioma</label>
            <select class="form-select" id="idioma">
                <!-- Opciones de idioma aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="calificacion" class="form-label">Calificación</label>
            <select class="form-select" id="calificacion">
                <!-- Opciones de calificación aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo">
                <!-- Opciones de tipo aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="audio" class="form-label">Audio</label>
            <select class="form-select" id="audio">
                <!-- Opciones de audio aquí -->
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen1" class="form-label">Imagen 1</label>
            <input type="file" class="form-control" id="imagen1" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="imagen2" class="form-label">Imagen 2</label>
            <input type="file" class="form-control" id="imagen2" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="imagen3" class="form-label">Imagen 3</label>
            <input type="file" class="form-control" id="imagen3" accept="image/*">
        </div>

        <button type="button" id="btnGuardarPelicula" class="btn btn-primary w-100">Guardar Película</button>
    </form>

    <!-- Tabla de Películas -->
    <div class="col-lg-8 col-md-12 p-4">
        <h4 class="text-secondary">Listado de Películas</h4>

        <table id="tablaPelicula" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Título Original</th>
                    <th scope="col">Duración</th>
                    <th scope="col">Año de Estreno</th>
                    <th scope="col">Disponibilidad</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col">Sitio Web</th>
                    <th scope="col">Sinopsis</th>
                    <th scope="col">Actores</th>
                    <th scope="col">Género</th>
                    <th scope="col">País</th>
                    <th scope="col">Idioma</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Audio</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbodyPelicula">
                <!-- Aquí se llenarán las filas con las películas desde la base de datos -->
            </tbody>
        </table>
    </div>
</div>
