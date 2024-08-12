<div class="container mt-5">
        <!-- Sección para dejar un nuevo comentario -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Deja tu Comentario</h2>
                <form id="comment-form">
                    <div class="mb-3">
                        <label for="user-comment" class="form-label">Comentario:</label>
                        <textarea class="form-control" id="user-comment" rows="3" placeholder="Escribe tu comentario aquí..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

        <!-- Sección para mostrar los comentarios existentes -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Comentarios</h2>
                <div id="comments-list">
                    <!-- Ejemplo de comentario -->
                    <div class="comment mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between">
                            <h5>Usuario 1</h5>
                            <div>
                                <button class="btn btn-sm btn-warning me-2" onclick="editComment(this)">Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteComment(this)">Eliminar</button>
                            </div>
                        </div>
                        <p class="comment-text">Esta película es increíble, me encantó cada escena.</p>
                    </div>

                    <!-- Otro comentario -->
                    <div class="comment mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between">
                            <h5>Usuario 2</h5>
                            <div>
                                <button class="btn btn-sm btn-warning me-2" onclick="editComment(this)">Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteComment(this)">Eliminar</button>
                            </div>
                        </div>
                        <p class="comment-text">La película es buena, pero creo que el final podría haber sido mejor.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>