<div class="bg-cover d-flex justify-content-center align-items-center" style="height: 100vh; background-image: url('path/to/your/image.jpg'); background-size: cover; background-position: center;">
    <div class="card custom-card shadow-xl border-0 rounded-lg overflow-hidden text-center p-5" style="max-width: 500px; background: rgba(0, 0, 0, 0.6);">
        <div class="card-body text-white">
            <h1 class="display-4 font-weight-bold mb-4" style="font-family: 'Roboto', sans-serif; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"><?= $breadcrumbActual ?></h1>
            <p class="lead mb-4" style="font-family: 'Roboto', sans-serif;">Accede a la gestión de <?= $breadcrumbActual ?> de forma rápida y sencilla. ¡Hazlo ahora!</p>
            <a href="<?= $redireccion ?>" class="btn btn-gradient btn-lg btn-custom px-5 py-3 rounded-pill shadow-lg transform-hover">
                Ir a Gestión de <?= $breadcrumbActual ?>
            </a>
        </div>
    </div>
</div>

<style>
    .bg-cover {
        background-size: cover;
        background-position: center;
    }

    .custom-card {
        background: rgba(0, 0, 0, 0.6); /* Fondo oscuro y semi-translúcido */
        color: white;
        padding: 2rem;
        border-radius: 20px;
    }

    .btn-gradient {
        background: linear-gradient(45deg, #6a11cb, #2575fc); /* Gradiente atractivo */
        border: none;
        color: white;
        transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #2575fc, #6a11cb); /* Cambio de gradiente en hover */
        transform: scale(1.1); /* Efecto de aumento en el hover */
    }

    .transform-hover:hover {
        transform: scale(1.05) translateY(-5px); /* Efecto visual atractivo en hover */
    }

    h1 {
        font-family: 'Roboto', sans-serif;
        text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); /* Sombra de texto para mayor contraste */
    }

    .lead {
        font-family: 'Roboto', sans-serif;
        font-size: 1.25rem;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3); /* Sombra sutil para el texto */
    }

    /* Efecto de sombra en el contenedor */
    .shadow-xl {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para el botón */
    .btn-custom {
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        transform: translateY(-2px); /* Efecto de aumento al pasar el ratón */
    }
</style>

