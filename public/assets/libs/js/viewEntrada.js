function updateTotal() {
    const availableTickets = parseInt(document.getElementById('available-tickets').innerText);
    const ticketQuantity = parseInt(document.getElementById('ticket-quantity').value);
    const ticketPrice = 10.00;
    const errorMessage = document.getElementById('error-message');
    const confirmationCard = document.getElementById('confirmation-card');

    if (ticketQuantity < 1) {
        errorMessage.style.display = 'block';
        errorMessage.innerText = 'La cantidad de entradas no puede ser menor que 1.';
        document.getElementById('total-price').innerText = '0.00';
        confirmationCard.style.display = 'none';
    } else if (ticketQuantity > availableTickets) {
        errorMessage.style.display = 'block';
        errorMessage.innerText = 'La cantidad de entradas seleccionadas excede las disponibles.';
        document.getElementById('total-price').innerText = '0.00';
        confirmationCard.style.display = 'none';
    } else {
        errorMessage.style.display = 'none';
        const totalPrice = ticketQuantity * ticketPrice;
        document.getElementById('total-price').innerText = totalPrice.toFixed(2);
    }
}

function showConfirmation() {
    const availableTickets = parseInt(document.getElementById('available-tickets').innerText);
    const ticketQuantity = parseInt(document.getElementById('ticket-quantity').value);
    const confirmationCard = document.getElementById('confirmation-card');

    if (ticketQuantity >= 1 && ticketQuantity <= availableTickets) {
        const totalPrice = document.getElementById('total-price').innerText;

        document.getElementById('confirm-quantity').innerText = ticketQuantity;
        document.getElementById('confirm-total-price').innerText = totalPrice;

        confirmationCard.style.display = 'block';
    } else {
        confirmationCard.style.display = 'none';
    }
}

function confirmPurchase() {
    const termsAccepted = document.getElementById('termsCheck').checked;
    if (termsAccepted) {
        alert('Compra confirmada. ¡Gracias por tu compra!');
        // Aquí puedes agregar lógica para completar la compra
    } else {
        alert('Debes aceptar los términos y condiciones para continuar.');
    }
}
