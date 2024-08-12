<div class="container mt-5">
        <!-- Parte 1: Selección de Entradas -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Comprar Entradas</h2>
                <div class="mb-3">
                    <label for="ticket-quantity" class="form-label">Cantidad de entradas:</label>
                    <input type="number" class="form-control" id="ticket-quantity" value="1" min="1" max="50" oninput="updateTotal()">
                </div>
                <div class="mb-3">
                    <p><strong>Entradas disponibles:</strong> <span id="available-tickets">50</span></p>
                    <p><strong>Precio por entrada:</strong> $<span id="ticket-price">10.00</span></p>
                    <p><strong>Total a pagar:</strong> $<span id="total-price">10.00</span></p>
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
                <p><strong>Total a pagar:</strong> $<span id="confirm-total-price">10.00</span></p>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="termsCheck">
                    <label class="form-check-label" for="termsCheck">
                        Acepto los términos y condiciones
                    </label>
                </div>
                <button class="btn btn-success" onclick="confirmPurchase()">Confirmar Compra</button>
            </div>
        </div>
    </div>