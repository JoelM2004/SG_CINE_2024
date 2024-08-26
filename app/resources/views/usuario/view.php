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
$entradas = $daoEntrada->loadByCuenta($id);

$daoPelicula = new PeliculaDAO($conn);
$daoFuncion = new FuncionDAO($conn);

function formatDate($date) {
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
                <ul class="list-group list-group-flush">
                    <?php foreach ($entradas as $elemento): ?>
                        <?php
                        $funcion = $daoFuncion->load($elemento->getFuncionId())->getNumeroFuncion();
                        $pelicula = $daoPelicula->load($daoFuncion->load($elemento->getFuncionId())->getPeliculaId())->getNombre();
                        $horaFuncion = $elemento->getHoraFuncion();
                        $horaVenta = $elemento->getHoraVenta();
                        $numeroTicket = $elemento->getNumeroTicket();
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">Nro de Ticket: <strong><?= $numeroTicket ?></strong></h5>
                                <p class="mb-1">Función: <strong><?= $funcion ?></strong></p>
                                <p class="mb-1">Película: <strong><?= $pelicula ?></strong></p>
                                <p class="mb-1">Hora de Función: <span class="badge bg-info text-dark"><?= formatDate($horaFuncion) ?></span></p>
                                <p class="mb-1">Hora de Venta: <span class="badge bg-success text-light"><?= formatDate($horaVenta) ?></span></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
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