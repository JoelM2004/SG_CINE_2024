function updateTotal() {
  const availableTickets = parseInt(
    document.getElementById("available-tickets").innerText
  );
  const ticketQuantityInput = document.getElementById("ticket-quantity");
  const ticketQuantity = parseInt(ticketQuantityInput.value);
  const ticketPrice = parseFloat(
    document.getElementById("ticket-price").innerText
  );
  const errorMessage = document.getElementById("error-message");
  const confirmationCard = document.getElementById("confirmation-card");

  // Manejo del caso en que el campo de cantidad está vacío
  if (isNaN(ticketQuantity) || ticketQuantity === '') {
    errorMessage.style.display = "block";
    errorMessage.innerText = "Ingrese una cantidad.";
    document.getElementById("total-price").innerText = "0.00";
    confirmationCard.style.display = "none";
  } else {
    if (ticketQuantity < 1) {
      errorMessage.style.display = "block";
      errorMessage.innerText = "La cantidad de entradas no puede ser menor que 1.";
      document.getElementById("total-price").innerText = "0.00";
      confirmationCard.style.display = "none"; // Ocultar confirmación si hay error
    } else if (ticketQuantity > availableTickets) {
      errorMessage.style.display = "block";
      errorMessage.innerText = "La cantidad de entradas seleccionadas excede las disponibles.";
      document.getElementById("total-price").innerText = "0.00";
      confirmationCard.style.display = "none"; // Ocultar confirmación si hay error
    } else {
      errorMessage.style.display = "none";
      const totalPrice = ticketQuantity * ticketPrice;
      document.getElementById("total-price").innerText = totalPrice.toFixed(2);

      // Mostrar confirmación si la cantidad es válida
      if (
        document.getElementById("confirm-quantity").innerText != ticketQuantity
      ) {
        confirmationCard.style.display = "none";
      }
    }
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
    // Aquí puedes agregar lógica para completar la compra, como enviar datos al servidor.
  } else {
    alert("Debes aceptar los términos y condiciones para continuar.");
  }
}

toggleInputs = async () => {
  const numeroFuncion = document.getElementById("numeroFuncion").value;
  const fechaHoraFuncion = document.getElementById("fechaHoraFuncion");
  const precio = document.getElementById("precio");
  const cantidad=document.getElementById("cantidad")
  const total=document.getElementById("total")
  // Llamada a la función para cargar los detalles de la función.
  let funcion = await singletonController.loadFuncion(numeroFuncion);

  // Convertir fecha y hora a formato 'YYYY-MM-DDTHH:MM'
  const fecha = funcion.fecha; // formato esperado 'YYYY-MM-DD'
  const hora = funcion.horaInicio; // formato esperado 'HH:MM:SS'
  cantidad.value=0;
  total.value=0
  // Asegurarse de que la hora está en formato 'HH:MM'
  const horaFormateada = hora.substring(0, 5);

  // Concatenar en formato requerido por datetime-local
  const fechaHoraFormateada = `${fecha}T${horaFormateada}`;

  // Asignar valor formateado
  fechaHoraFuncion.value = fechaHoraFormateada;
  precio.value = funcion.precio;

  // Agregar evento onchange si el elemento existe
};

function updateTotal2 () {
    const precio = parseFloat(document.getElementById("precio").value) || 0;
    const cantidad = parseInt(document.getElementById("cantidad").value) || 0;
    const total = precio * cantidad;
    document.getElementById("total").value = total.toFixed(2); // Mostrar el total con dos decimales
}



// Manejo de filtros si es necesario
if (document.getElementById("filterType") != null) {
  document.getElementById("filterType").addEventListener("change", function () {
    document.getElementById("filterTicket").classList.add("d-none");
    document.getElementById("filterFuncion").classList.add("d-none");
    document.getElementById("filterCuenta").classList.add("d-none");

    const selectedFilter = this.value;
    if (selectedFilter === "ticket") {
      document.getElementById("filterTicket").classList.remove("d-none");
    } else if (selectedFilter === "funcion") {
      document.getElementById("filterFuncion").classList.remove("d-none");
    } else if (selectedFilter === "cuenta") {
      document.getElementById("filterCuenta").classList.remove("d-none");
    }
  });
} else if (document.getElementById("btnToggleEntrada") != null) {
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
    
    
    } );
    
}if (document.getElementById("numeroFuncion")) {
  document.getElementById("numeroFuncion").onchange = toggleInputs;
}


document.getElementById("precio").addEventListener("input", updateTotal2);
document.getElementById("cantidad").addEventListener("input", updateTotal2);