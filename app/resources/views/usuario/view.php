<?php

use app\core\model\dao\UsuarioDAO;
use app\libs\Connection\Connection;
use app\core\model\dao\EntradaDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\PeliculaDAO;

$id = $_SESSION["id"];
$conn = Connection::get();
$dao = new UsuarioDAO($conn);
$datos = $dao->load($id);

$daoEntrada = new EntradaDAO($conn);
$entradas = $daoEntrada->loadByCuentaView($id);
$entradas = array_reverse($entradas);

$daoPelicula = new PeliculaDAO($conn);
$daoFuncion = new FuncionDAO($conn);

function formatDate($date)
{
    // Verificar si el formato contiene una hora
    if (strpos($date, ' ') !== false) {
        // Separar la fecha y la hora
        list($datePart, $timePart) = explode(' ', $date);
        $dateParts = explode('-', $datePart);
        $timeParts = explode(':', $timePart);

        // Verificar y formatear la fecha
        $formattedDate = isset($dateParts[2], $dateParts[1], $dateParts[0]) ? "{$dateParts[2]}/{$dateParts[1]}/{$dateParts[0]}" : $datePart;

        // Verificar y formatear la hora
        $formattedTime = isset($timeParts[0], $timeParts[1]) ? "{$timeParts[0]}:{$timeParts[1]}" : $timePart;

        return "{$formattedDate} {$formattedTime}";
    } else {
        // Si no hay hora, solo formatear la fecha
        $parts = explode('-', $date);
        return isset($parts[2], $parts[1], $parts[0]) ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $date;
    }
}


?>

<div class="container mt-5">
    <!-- Logo de Los Pollos Hermanos -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Viñeta para cambiar entre secciones -->
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Perfil</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="purchase-history-tab" data-bs-toggle="tab" href="#purchase-history" role="tab" aria-controls="purchase-history" aria-selected="false">Historial de Compras</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Cambiar Contraseña</a>
        </li>
    </ul>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="myTabContent">
        <!-- Perfil -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" data-id="<?= $_SESSION["id"] ?>">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Información de la Cuenta</h3>
                </div>
                <div class="card-body">
                    <p><strong>Cuenta:</strong> <?= $datos->getCuenta() ?></p>
                    <p><strong>Nombre:</strong> <?= $datos->getNombres() ?></p>
                    <p><strong>Apellido:</strong> <?= $datos->getApellido() ?></p>
                    <p><strong>Tipo de Usuario:</strong> <?= $_SESSION["perfil"] ?></p>
                    <p><strong>Correo:</strong> <?= $datos->getCorreo() ?></p>
                </div>
            </div>
        </div>

        <!-- Historial de Compras -->
        <div class="tab-pane fade" id="purchase-history" role="tabpanel" aria-labelledby="purchase-history-tab">
    <div class="card border-success mb-3">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Historial de Compras</h3>
        </div>
        <div class="card-body">
            <?php if (empty($entradas)): ?>
                <!-- Mensaje cuando no hay compras -->
                <div class="alert alert-warning text-center" role="alert">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-exclamation-circle fa-2x me-3"></i> <!-- Icono más grande -->
                        <h5 class="mb-0">¡Hola! No hemos encontrado compras en tu historial.</h5>
                    </div>
                    <p class="mt-2">Parece que aún no has realizado ninguna compra. Explora nuestra cartelera y disfruta de una buena película.</p>
                    <a href="http://localhost/SG_CINE_2024/public/cartelera" class="btn btn-success mt-3">Ir a la Cartelera</a> <!-- Botón para redirigir -->
                </div>
            <?php else: ?>
                <div class="row">
                    <?php
                    // Función para comparar las entradas según el 'horarioVenta'
                    usort($entradas, function ($a, $b) {
                        return strtotime($b['horarioVenta']) - strtotime($a['horarioVenta']); // Orden descendente
                    });
                    ?>

                    <?php foreach ($entradas as $elemento): ?>
                        <?php
                        $funcion = $elemento["numeroFuncion"];
                        $pelicula = $elemento["nombre"];
                        $horaFuncion = $elemento["horarioFuncion"];
                        $horaVenta = $elemento["horarioVenta"];
                        $numeroTicket = $elemento["numeroTicket"];
                        $precio = $elemento["precio"];
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow-sm border border-dark rounded">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Nro de Ticket: <strong><?= $numeroTicket ?></strong></h5>
                                    <p class="card-text">
                                        <strong>Función:</strong> <?= $funcion ?><br>
                                        <strong>Película:</strong> <?= $pelicula ?><br>
                                        <strong>Precio:</strong> <?= "$" . $precio ?><br>
                                        <strong>Hora de Función:</strong> <span class="badge bg-info text-dark"><?= formatDate($horaFuncion) ?></span><br>
                                        <strong>Hora de Venta:</strong> <span class="badge bg-success text-light"><?= formatDate($horaVenta) ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



        <!-- Cambiar Contraseña -->
        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
            <div class="card border-warning mb-3">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title mb-0">Cambiar Contraseña</h3>
                </div>
                <div class="card-body">
                    <form id="change-password-form">
                        <div class="mb-3">
                            <label for="claveActual" class="form-label">Contraseña Actual</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="claveActual" placeholder="Ingresa tu contraseña actual" required>
                                <span class="input-group-text"><i class="fas fa-eye toggle-password" data-toggle="claveActual"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="claveNueva" class="form-label">Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="claveNueva" placeholder="Ingresa tu nueva contraseña" required>
                                <span class="input-group-text"><i class="fas fa-eye toggle-password" data-toggle="claveNueva"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="claveConfirmacion" class="form-label">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="claveConfirmacion" placeholder="Confirma tu nueva contraseña" required>
                                <span class="input-group-text"><i class="fas fa-eye toggle-password" data-toggle="claveConfirmacion"></i></span>
                            </div>
                        </div>
                        <button type="button" id="btnChangePassword" class="btn btn-warning w-100">Actualizar Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>