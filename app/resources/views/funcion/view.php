<?php
use app\core\model\dao\PeliculaDAO;
use app\libs\connection\Connection;

$conn = Connection::get();

$id = $_GET['id'];

$daoPelicula = new PeliculaDAO($conn);
$datosPelicula = $daoPelicula->load($id);


?>

<div class="card mb-3 shadow-sm" id="peliculaId" data-id=<?=$id?>>
    <div class="card-body">
        <h2 class="card-title"><?=$datosPelicula->getNombre()?></h2>
        <p class="card-text">Selecciona una función para ver más detalles y comprar entradas.</p>
        
        <div class="list-group" id="funciones-lista">
            <!-- Funciones serán añadidas aquí dinámicamente -->
        </div>
    </div>
</div>
