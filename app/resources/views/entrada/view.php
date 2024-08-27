<?php

use app\core\model\dao\EntradaDAO;
use app\core\model\dao\SalaDAO;
use app\core\model\dao\FuncionDAO;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;

$conn = Connection::get();

$daoFuncion = new FuncionDAO($conn);
$datosFuncion = $daoFuncion->load($_GET["id"]);

$daoSala = new SalaDAO($conn);
$datosSala = $daoSala->load($datosFuncion->getSalaId());

$daoUsuario = new UsuarioDAO($conn);
$datosUsuario = $daoUsuario->load($_SESSION["id"]);

$daoEntrada= new EntradaDAO($conn);


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
        $formattedTime = isset($timeParts[0], $timeParts[1]) ? " a las {$timeParts[0]}:{$timeParts[1]}" : $timePart;

        return "{$formattedDate} {$formattedTime}";
    } else {
        // Si no hay hora, solo formatear la fecha
        $parts = explode('-', $date);
        return isset($parts[2], $parts[1], $parts[0]) ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $date;
    }
}
?>

<div class="container mt-5">
    <!-- Parte 1: Selección de Entradas -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title"><i class="fas fa-ticket-alt"></i> Comprar Entradas</h2>
            <h6 id="getDatosEntrada" data-idUser="<?=$_SESSION["id"]?>" data-idFuncion="<?=$_GET["id"]?>" data-funcionHora="<?=$datosFuncion->getFecha()." ".$datosFuncion->getHoraInicio()?>"> 
                <i class="fas fa-user"></i> Usted: <?=$datosUsuario->getCuenta()?> 
                <i class="fas fa-hand-point-right"></i> seleccione la cantidad de entradas que quiere comprar para la función nro: 
                <?=$datosFuncion->getNumeroFuncion()?> 
                 el día <?=formatDate($datosFuncion->getFecha()." " . $datosFuncion->getHoraInicio())?> 
                
            </h6>
            <div class="mb-3">
                <label for="ticket-quantity" class="form-label"><i class="fas fa-list-ol"></i> Cantidad de entradas:</label>
                <input type="number" class="form-control" id="ticket-quantity" value="0" min="0" max="<?= $daoEntrada->cantidadEntradasDisponibles($_GET["id"]) ?>" oninput="updateTotal()">
            </div>
            <div class="mb-3">
                <p><strong><i class="fas fa-ticket-alt"></i> Entradas disponibles:</strong> <span id="available-tickets"><?= $daoEntrada->cantidadEntradasDisponibles($_GET["id"]) ?></span></p>
                <p><strong><i class="fas fa-dollar-sign"></i> Precio por entrada:</strong> $<span id="ticket-price" data-precio="<?= $datosFuncion->getPrecio() ?>"><?= $datosFuncion->getPrecio() ?></span></p>
                <p><strong><i class="fas fa-calculator"></i> Total a pagar:</strong> $<span id="total-price">0.00</span></p>
                <p id="error-message" class="text-danger" style="display:none;"><i class="fas fa-exclamation-circle"></i> Error: Cantidad de entradas no válida</p>
            </div>
            <button class="btn btn-primary" onclick="showConfirmation()"><i class="fas fa-arrow-right"></i> Continuar</button>
        </div>
    </div>

    <!-- Parte 2: Confirmación de Compra -->
    <div class="card mb-4" id="confirmation-card" style="display:none;">
        <div class="card-body">
            <h2 class="card-title"><i class="fas fa-check-circle"></i> Confirmación de Compra</h2>
            <p><strong><i class="fas fa-list-ol"></i> Cantidad de entradas:</strong> <span id="confirm-quantity">1</span></p>
            <p><strong><i class="fas fa-dollar-sign"></i> Total a pagar:</strong> $<span id="confirm-total-price">0.00</span></p>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                <label class="form-check-label" for="termsCheck">
                    <i class="fas fa-file-alt"></i> Acepto los términos y condiciones
                </label>
            </div>
            <button id="btnGuardarEntrada"  class="btn btn-success"><i class="fas fa-shopping-cart"></i> Confirmar Compra</button>
        </div>
    </div>
</div>
