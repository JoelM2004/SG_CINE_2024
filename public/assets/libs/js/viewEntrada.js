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
  if (isNaN(ticketQuantity) || ticketQuantity === "") {
    errorMessage.style.display = "block";
    errorMessage.innerText = "Ingrese una cantidad.";
    document.getElementById("total-price").innerText = "0.00";
    confirmationCard.style.display = "none";
  } else {
    if (ticketQuantity < 1) {
      errorMessage.style.display = "block";
      errorMessage.innerText =
        "La cantidad de entradas no puede ser menor que 1.";
      document.getElementById("total-price").innerText = "0.00";
      confirmationCard.style.display = "none"; // Ocultar confirmación si hay error
    } else if (ticketQuantity > availableTickets) {
      errorMessage.style.display = "block";
      errorMessage.innerText =
        "La cantidad de entradas seleccionadas excede las disponibles.";
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
    // Retornar true si los términos han sido aceptados
    return true;
  } else {
    alert("Debes aceptar los términos y condiciones para continuar.");
    // Retornar false si los términos no han sido aceptados
    return false;
  }
}

toggleInputs = async () => {
  const numeroFuncion = document.getElementById("numeroFuncion").value;
  const fechaHoraFuncion = document.getElementById("fechaHoraFuncion");
  const precio = document.getElementById("precio");
  const cantidad = document.getElementById("cantidad");
  const total = document.getElementById("total");
  // Llamada a la función para cargar los detalles de la función.
  let funcion = await singletonController.loadFuncion(numeroFuncion);

  // Convertir fecha y hora a formato 'YYYY-MM-DDTHH:MM'
  const fecha = funcion.fecha; // formato esperado 'YYYY-MM-DD'
  const hora = funcion.horaInicio; // formato esperado 'HH:MM:SS'
  cantidad.value = 0;
  total.value = 0;
  // Asegurarse de que la hora está en formato 'HH:MM'
  const horaFormateada = hora.substring(0, 5);

  // Concatenar en formato requerido por datetime-local
  const fechaHoraFormateada = `${fecha}T${horaFormateada}`;

  // Asignar valor formateado
  fechaHoraFuncion.value = fechaHoraFormateada;
  precio.value = funcion.precio;

  // Agregar evento onchange si el elemento existe
  let cantidadDisponible = await entradaService.cantidadEntradaDisponibles(
    numeroFuncion
  );
  console.log(cantidadDisponible);
  document.getElementById("disponible").value = cantidadDisponible.result;
};

function updateTotal2() {
  const precio = parseFloat(document.getElementById("precio").value) || 0;
  const cantidad = parseInt(document.getElementById("cantidad").value) || 0;
  const total = precio * cantidad;
  document.getElementById("total").value = total.toFixed(2); // Mostrar el total con dos decimales
}

// Manejo de filtros si es necesario
if (document.getElementById("filterType") != null) {
  document.getElementById("filterType").addEventListener("change", function () {
    // Ocultar todos los filtros específicos
    document.getElementById("filterNumeroTicket").classList.add("d-none");
    
    document.getElementById("filterNumFunDIV").classList.add("d-none");
    document.getElementById("filterNumeroFuncion").classList.add("d-none");

    document.getElementById("filterCuentaCliente").classList.add("d-none");
    document.getElementById("filterCuentaClienteDIV").classList.add("d-none");

    document.getElementById("filterPelicula").classList.add("d-none");
    document.getElementById("filterPeliculaDIV").classList.add("d-none");

    document.getElementById("filterProgramacion").classList.add("d-none");

    // Obtener el valor seleccionado
    const selectedFilter = this.value;

    // Mostrar el filtro correspondiente según el valor seleccionado
    if (selectedFilter === "numeroTicket") {
      document.getElementById("filterNumeroTicket").classList.remove("d-none");
    } else if (selectedFilter === "numeroFuncion") {
      document.getElementById("filterNumFunDIV").classList.remove("d-none");
      document.getElementById("filterNumeroFuncion").classList.remove("d-none");
    } else if (selectedFilter === "cuentaCliente") {
      document.getElementById("filterCuentaClienteDIV").classList.remove("d-none");
      document.getElementById("filterCuentaCliente").classList.remove("d-none");
    } else if (selectedFilter === "pelicula") {
      document.getElementById("filterPeliculaDIV").classList.remove("d-none");
      document.getElementById("filterPelicula").classList.remove("d-none");
    } else if (selectedFilter === "programacion") {
      document.getElementById("filterProgramacion").classList.remove("d-none");
    }
  });
} else if (document.getElementById("btnToggleEntrada") != null) {
  document
    .getElementById("btnToggleEntrada")
    .addEventListener("click", function () {
      // const button = this;
      // if (confirm("¿Seguro que quiere cambiar el estado de la entrada?")) {
      //   if (button.textContent === "Activar Entrada") {
      //     button.textContent = "Desactivar Entrada";
      //     button.value = "0";
      //   } else {
      //     button.textContent = "Activar Entrada";
      //     button.value = "1";
      //   }
      // }
    });
}

if (document.getElementById("numeroFuncion")) {
  document.getElementById("numeroFuncion").onchange = toggleInputs;
}

if (document.getElementById("precio") != null) {
  document.getElementById("precio").addEventListener("input", updateTotal2);
  document.getElementById("cantidad").addEventListener("input", updateTotal2);
}

if (document.getElementById("filterCuentaClienteCREATE") != null) {
  document
    .getElementById("filterCuentaClienteCREATE")
    .addEventListener("input", function () {
      const filter = this.value.toLowerCase();
      const select = document.getElementById("cuentaCliente");

      Array.from(select.options).forEach((option) => {
        const text = option.text.toLowerCase();
        option.style.display = text.includes(filter) ? "" : "none";
      });
    });
}

if (document.getElementById("filterNumeroFuncionCREATE") != null){
document.getElementById('filterNumeroFuncionCREATE').addEventListener('input', function() {
  const filter = this.value.toLowerCase();
  const select = document.getElementById('numeroFuncion');
  
  Array.from(select.options).forEach(option => {
      const text = option.text.toLowerCase();
      option.style.display = text.includes(filter) ? '' : 'none';
  });
})}
;

if (document.getElementById("filterCuentaClienteText") != null){
document.getElementById('filterCuentaClienteText').addEventListener('input', function() {
  const filter = this.value.toLowerCase();
  const select = document.getElementById('filterCuentaClienteInput');
  
  Array.from(select.options).forEach(option => {
      const text = option.text.toLowerCase();
      option.style.display = text.includes(filter) ? '' : 'none';
  });
})}
;

if (document.getElementById("filterNumFunText") != null){
  document.getElementById('filterNumFunText').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const select = document.getElementById('filterNumeroFuncionInput');
    
    Array.from(select.options).forEach(option => {
        const text = option.text.toLowerCase();
        option.style.display = text.includes(filter) ? '' : 'none';
    });
  })}
  ;

  if (document.getElementById("filterPeliculaText") != null){
    document.getElementById('filterPeliculaText').addEventListener('input', function() {
      const filter = this.value.toLowerCase();
      const select = document.getElementById('filterPeliculaInput');
      
      Array.from(select.options).forEach(option => {
          const text = option.text.toLowerCase();
          option.style.display = text.includes(filter) ? '' : 'none';
      });
    })}
    ;
