<?php

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

?>

<div class="container mt-5">
    <!-- Parte 1: Selección de Entradas -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Comprar Entradas</h2>
            <h6 id="getDatosEntrada" data-idUser="<?=$_SESSION["id"]?>" data-idFuncion="<?=$_GET["id"]?> "  >Usted: <?=$datosUsuario->getCuenta()?> seleccione la cantidad de entradas que quiere comprar para la función nro: <?=$datosFuncion->getNumeroFuncion()?> el día <?=$datosFuncion->getFecha()?> a las <?=$datosFuncion->getHoraInicio()?>  </h6>
            <div class="mb-3">
                <label for="ticket-quantity" class="form-label">Cantidad de entradas:</label>
                <input type="number" class="form-control" id="ticket-quantity" value="0" min="0" max="<?= $datosSala->getCapacidad() ?>" oninput="updateTotal()">
            </div>
            <div class="mb-3">
                <p><strong>Entradas disponibles:</strong> <span id="available-tickets"><?= $datosSala->getCapacidad() ?></span></p>
                <p><strong>Precio por entrada:</strong> $<span id="ticket-price"><?= $datosFuncion->getPrecio() ?></span></p>
                <p><strong>Total a pagar:</strong> $<span id="total-price">0.00</span></p>
                <p id="error-message" class="text-danger" style="display:none;"></p>
            </div>
            <button class="btn btn-primary" onclick="showConfirmation()">Continuar</button>
        </div>
    </div>

    <!-- Parte 2: Confirmación de Compra -->
    <div class="card mb-4" id="confirmation-card" style="display:none;">
        <div class="card-body">
            <h2 class="card-title">Confirmación de Compra</h2>
            <p><strong>Cantidad de entradas:</strong> <span id="confirm-quantity">1</span></p>
            <p><strong>Total a pagar:</strong> $<span id="confirm-total-price">0.00</span></p>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                <label class="form-check-label" for="termsCheck">
                    Acepto los términos y condiciones
                </label>
            </div>
            <button id="btnGuardarEntrada" class="btn btn-success">Confirmar Compra</button>
        </div>
    </div>
</div>