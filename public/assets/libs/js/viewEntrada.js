function updateTotal() {
  const availableTickets = parseInt(
    document.getElementById("available-tickets").innerText
  );
  const ticketQuantity = parseInt(
    document.getElementById("ticket-quantity").value
  );
  const ticketPrice = 10.0;
  const errorMessage = document.getElementById("error-message");
  const confirmationCard = document.getElementById("confirmation-card");

  if (ticketQuantity < 1) {
    errorMessage.style.display = "block";
    errorMessage.innerText =
      "La cantidad de entradas no puede ser menor que 1.";
    document.getElementById("total-price").innerText = "0.00";
    confirmationCard.style.display = "none";
  } else if (ticketQuantity > availableTickets) {
    errorMessage.style.display = "block";
    errorMessage.innerText =
      "La cantidad de entradas seleccionadas excede las disponibles.";
    document.getElementById("total-price").innerText = "0.00";
    confirmationCard.style.display = "none";
  } else {
    errorMessage.style.display = "none";
    const totalPrice = ticketQuantity * ticketPrice;
    document.getElementById("total-price").innerText = totalPrice.toFixed(2);
  }
}

function showConfirmation() {
  const availableTickets = parseInt(
    document.getElementById("available-tickets").innerText
  );
  const ticketQuantity = parseInt(
    document.getElementById("ticket-quantity").value
  );
  const confirmationCard = document.getElementById("confirmation-card");

  if (ticketQuantity >= 1 && ticketQuantity <= availableTickets) {
    const totalPrice = document.getElementById("total-price").innerText;

    document.getElementById("confirm-quantity").innerText = ticketQuantity;
    document.getElementById("confirm-total-price").innerText = totalPrice;

    confirmationCard.style.display = "block";
  } else {
    confirmationCard.style.display = "none";
  }
}

function confirmPurchase() {
  const termsAccepted = document.getElementById("termsCheck").checked;
  if (termsAccepted) {
    alert("Compra confirmada. ¡Gracias por tu compra!");
    // Aquí puedes agregar lógica para completar la compra
  } else {
    alert("Debes aceptar los términos y condiciones para continuar.");
  }
}

if (document.getElementById("filterType") != null) {
  document.getElementById("filterType").addEventListener("change", function () {
    // Ocultar todos los filtros
    document.getElementById("filterTicket").classList.add("d-none");
    document.getElementById("filterFuncion").classList.add("d-none");
    document.getElementById("filterCuenta").classList.add("d-none");

    // Mostrar el filtro seleccionado
    const selectedFilter = this.value;
    if (selectedFilter === "ticket") {
      document.getElementById("filterTicket").classList.remove("d-none");
    } else if (selectedFilter === "funcion") {
      document.getElementById("filterFuncion").classList.remove("d-none");
    } else if (selectedFilter === "cuenta") {
      document.getElementById("filterCuenta").classList.remove("d-none");
    }
  });
} else {
    if( document
      .getElementById("btnToggleEntrada")!=null){
  document
    .getElementById("btnToggleEntrada")
    .addEventListener("click", function () {
      const button = this;
      if (confirm("¿Seguro que quiere cambiar el estado de la entrada?")) {
        if (button.textContent === "Activar Entrada") {
          button.textContent = "Desactivar Entrada";
          // Aquí se puede hacer una llamada para actualizar el estado a 1 (activado)
        } else {
          button.textContent = "Activar Entrada";
          // Aquí se puede hacer una llamada para actualizar el estado a 0 (desactivado)
        }
      }
    })
  };
}
