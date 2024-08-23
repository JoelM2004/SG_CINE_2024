<div class="container mt-5">
    <!-- Sección para dejar un nuevo comentario -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Deja tu Comentario</h2>
            <div class="mb-3">
                <form id="comment-form" data-idUser="<?=$_SESSION["id"]?>" data-idPelicula="<?= $_GET["id"]?>">
                    <label for="comment" class="form-label">Comentario:</label>
                    <textarea class="form-control" id="comment" rows="3" placeholder="Escribe tu comentario aquí..."></textarea>
                </form>
            </div>
            <button id="btnAltaComentario" type="button" class="btn btn-primary" >Enviar</button>
        </div>
    </div>

    <!-- Sección para mostrar los comentarios existentes -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Comentarios</h2>
            <div id="comments-list">
                <!-- Los comentarios se generarán aquí dinámicamente -->
            </div>
        </div>
    </div>
</div>
