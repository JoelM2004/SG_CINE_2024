let entradaController = {
  data: {
    id: 0,
    horarioFuncion: "",
    horarioVenta: "",
    precio: 0,
    numeroTicket: 0,
    estado: 1,
    funcionId: 0,
    usuarioId: 0,
  },

  cantidad: {
    numero: 0,
  },
  save: () => {
    let form = document.forms["formEntrada"];

    // Validación de los campos del formulario
    const horarioFuncion = form.fechaHoraFuncion.value;
    const precio = form.precio.value;
    const funcionId = form.numeroFuncion.value;
    const usuarioId = form.cuentaCliente.value;
    const cantidad = form.cantidad.value;
    const disponible = form.disponible.value;
    // Validar que los campos no estén vacíos
    if (!horarioFuncion || !precio || !funcionId || !usuarioId) {
      alert("Por favor, complete todos los campos obligatorios.");
      return; // Detener la ejecución si hay campos vacíos
    }

    // Validar que el precio sea un número positivo
    if (isNaN(precio) || parseFloat(precio) <= 0 || parseInt(funcionId) == 0) {
      alert("El precio debe ser un número positivo.");
      return; // Detener la ejecución si el precio no es válido
    }

    if (cantidad > disponible) {
      alert(
        "Quiere comprar una cantidad de entradas que excede a la disponible"
      );
      return;
    }

    if (cantidad <= 0) {
      alert("Seleccione una cantidad de entradas a comprar");
      return;
    }

    // Obtener la fecha y hora actual en formato 'YYYY-MM-DDTHH:MM'
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, "0");
    const day = String(now.getDate()).padStart(2, "0");
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const datetime = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Asignar los valores validados al objeto `entradaController.data`
    entradaController.data.horarioFuncion = horarioFuncion;
    entradaController.data.horarioVenta = datetime;
    entradaController.data.precio = parseFloat(precio);
    entradaController.data.funcionId = parseInt(funcionId);
    entradaController.data.usuarioId = parseInt(usuarioId);
    entradaController.data.estado = entradaController.data.estado; // Asegúrate de que el estado se establece correctamente
    entradaController.cantidad.numero = parseInt(cantidad);

    let a = false;

    // Llamada al servicio para guardar los datos
    for (let index = 0; index < entradaController.cantidad.numero; index++) {
      entradaService
        .save(entradaController.data)
        .then((data) => {
          console.log("Guardando Datos");
          if (data.error !== "") {
            alert("Error al guardar la entrada: " + data.error);
          } else {
            if (!a) {
              alert("Entrada/s guardada con éxito");
              a = true;
            }

            // Puedes recargar la página o realizar otras acciones aquí
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar la entrada"+ error);
        });
    }
  },
  saveCompra: () => {
    let form = document.forms["formEntrada"];

    // Validación de los campos del formulario
    const horarioFuncion =
      document.getElementById("getDatosEntrada").dataset.funcionhora;
    const precio = document.getElementById("ticket-price").dataset.precio;
    const funcionId =
      document.getElementById("getDatosEntrada").dataset.idfuncion;
    const usuarioId = document.getElementById("getDatosEntrada").dataset.iduser;
    const cantidad = document.getElementById("ticket-quantity").value;
    const disponible = document.getElementById("available-tickets").value;
    // Validar que los campos no estén vacíos
    if (!horarioFuncion || !precio || !funcionId || !usuarioId) {
      alert("Por favor, complete todos los campos obligatorios.");
      console.log(entradaController.data);
      return; // Detener la ejecución si hay campos vacíos
    }

    // Validar que el precio sea un número positivo
    if (isNaN(precio) || parseFloat(precio) <= 0 || parseInt(funcionId) == 0) {
      alert("El precio debe ser un número positivo.");
      return; // Detener la ejecución si el precio no es válido
    }

    if (cantidad > disponible) {
      alert(
        "Quiere comprar una cantidad de entradas que excede a la disponible"
      );
      return;
    }

    // Obtener la fecha y hora actual en formato 'YYYY-MM-DDTHH:MM'
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, "0");
    const day = String(now.getDate()).padStart(2, "0");
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const datetime = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Asignar los valores validados al objeto `entradaController.data`
    entradaController.data.horarioFuncion = horarioFuncion;
    entradaController.data.horarioVenta = datetime;
    entradaController.data.precio = parseFloat(precio);
    entradaController.data.funcionId = parseInt(funcionId);
    entradaController.data.usuarioId = parseInt(usuarioId);
    entradaController.data.estado = entradaController.data.estado; // Asegúrate de que el estado se establece correctamente
    entradaController.cantidad.numero = parseInt(cantidad);

    // Llamada al servicio para guardar los datos
    for (let index = 0; index < entradaController.cantidad.numero; index++) {
      entradaService
        .saveCliente(entradaController.data)
        .then((data) => {
          console.log("Guardando Datos");
          if (data.error !== "") {
            alert("Error al guardar la entrada: " + data.error);
          } else {
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar la entrada");
        });
    }
  },
  update: () => {
    if (confirm("¿Quieres actualizar el estado de la entrada?")) {
      entradaController.data.estado = parseInt(
        document.getElementById("btnToggleEntrada").value
      );
      entradaController.data.id = parseInt(
        document.getElementById("tbodyEntradas").dataset.id
      );
      entradaController.data.funcionId = parseInt(
        document.getElementById("tbodyEntradas").dataset.funcion
      );
      entradaService
        .update(entradaController.data)
        .then((data) => {
          console.log("Actualizando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al actualizar el entrada: " + data.error);
          } else {
            alert("entrada actualizado con éxito");
            setTimeout(() => {
              location.reload();
            }, 300);
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al actualizar el Usuario");
        });
    }
  },

  list: () => {
    //listo
    console.log("Listando entrada...");

    index = 0;
    entradaService
      .listEntradas()
      .then((data) => {
        console.log("entrada listados:", data);
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },
  loadByCuenta: () => {
    console.log("Listando entrada...");

    // Obtener el valor de la cuenta desde el input y convertirlo en un número entero
    let cuenta = document.getElementById("filterCuentaClienteInput").value;
    console.log(cuenta);
    cuenta = parseInt(cuenta);

    index = 0;
    entradaService
      .loadByCuenta(cuenta)
      .then((data) => {
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Entradas.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },
  loadByFuncion: () => {
    console.log("Listando entrada...");

    // Obtener el valor de la función desde el input y convertirlo en un número entero
    let funcionId = parseInt(
      document.getElementById("filterNumeroFuncionInput").value,
      10
    );

    index = 0;
    entradaService
      .loadByFuncion(funcionId)
      .then((data) => {
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Entradas.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },

  loadByNumeroTicket: () => {
    console.log("Listando entrada...");

    // Obtener el valor del número de ticket desde el input y convertirlo en un número entero
    let numeroTicket = parseInt(
      document.getElementById("filterNumeroTicketInput").value,
      10
    );
    index = 0;
    entradaService
      .loadByNumeroTicket(numeroTicket)
      .then((data) => {
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Entradas.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },
  loadByProgramacion: () => {
    console.log("Listando entradas por programación...");

    // Obtener el valor de la programación desde el input y convertirlo en un número entero
    let programacionId = parseInt(
      document.getElementById("filterProgramacionInput").value,
      10
    );

    index = 0;
    entradaService
      .loadByProgramacion(programacionId)
      .then((data) => {
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Entradas.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },

  loadByPelicula: () => {
    console.log("Listando entradas por película...");

    // Obtener el valor de la película desde el input y convertirlo en un número entero
    let peliculaId = parseInt(
      document.getElementById("filterPeliculaInput").value,
      10
    );

    index = 0;
    entradaService
      .loadByPelicula(peliculaId)
      .then((data) => {
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Entradas.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        for (const element of data.result) {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";

          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";
          txt += "<td>" + element.cuenta + "</td>";

          if (element.estado === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.log(error);
      });
  },
  print: () => {
    //lista
    const $elementoParaConvertir = document.getElementById("tablaEntradas"); // <-- Aquí puedes elegir cualquier elemento del DOM

    // Crear un contenedor temporal para añadir el título y la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título
    const title = document.createElement("h1");
    title.innerText = "Listado de entradas";
    tempContainer.appendChild(title);

    // Crear y añadir la fecha de emisión
    const date = document.createElement("p");
    const today = new Date();
    date.innerText =
      "Fecha de emisión del reporte: " + today.toLocaleDateString();
    tempContainer.appendChild(date);

    // Clonar el elemento a convertir y añadirlo al contenedor temporal
    const clonedElement = $elementoParaConvertir.cloneNode(true);
    tempContainer.appendChild(clonedElement);

    // Eliminar la última columna
    const rows = clonedElement.querySelectorAll("tr");
    rows.forEach((row) => {
      const cells = row.querySelectorAll("td, th");
      if (cells.length > 0) {
        cells[cells.length - 1].parentNode.removeChild(cells[cells.length - 1]);
      }
    });

    // Aplicar estilo al contenedor temporal para evitar problemas de renderizado
    tempContainer.style.fontFamily = "Arial, sans-serif";
    tempContainer.style.width = "100%";
    tempContainer.style.overflow = "hidden";

    // Aplicar estilo a la tabla para ajustarla al tamaño del PDF
    const tables = tempContainer.getElementsByTagName("table");
    for (let table of tables) {
      table.style.width = "100%"; // Ajustar el ancho de la tabla al 100%
      table.style.tableLayout = "auto"; // Opcional: esto hace que las celdas tengan un ancho fijo
    }

    // Ajustar el tamaño de las celdas de la tabla
    const tableCells = tempContainer.getElementsByTagName("td");
    for (let cell of tableCells) {
      cell.style.fontSize = "10px"; // Reducir el tamaño de la fuente en las celdas
      cell.style.padding = "1px"; // Reducir el padding en las celdas
    }

    const tableCellsth = tempContainer.getElementsByTagName("th");
    for (let cell of tableCellsth) {
      cell.style.fontSize = "10px"; // Reducir el tamaño de la fuente en las celdas
      cell.style.padding = "1px"; // Reducir el padding en las celdas
    }

    html2pdf()
      .from(tempContainer)
      .set({
        margin: 1,
        filename: "venta.pdf",
        image: {
          type: "jpeg",
          quality: 0.98,
        },
        html2canvas: {
          scale: 4, // A mayor escala, mejores gráficos, pero más peso
          letterRendering: true,
        },
        jsPDF: {
          unit: "in",
          format: "a4",
          orientation: "landscape", // landscape o portrait
        },
      })
      .outputPdf("blob")
      .then(function (pdfBlob) {
        var blobUrl = URL.createObjectURL(pdfBlob);
        window.open(blobUrl, "_blank");
      })
      .catch((err) => console.log(err));
  },
};

const formatDate = (dateString) => {
  // Divide la fecha y la hora usando el espacio
  const [datePart, timePart] = dateString.split(" ");

  // Divide la fecha en año, mes y día
  const [year, month, day] = datePart.split("-");

  // Divide la hora en horas y minutos (después de eliminar los segundos)
  const [hora, minutos] = timePart.split(":");

  // Retorna el formato deseado
  return `${day}/${month}/${year} a las ${hora}:${minutos}`;
};

document.addEventListener("DOMContentLoaded", () => {
  let btnAltaEntrada = document.getElementById("btnAltaEntrada");
  let btnListarEntrada = document.getElementById("btnListarEntrada");
  let btnModificarEntrada = document.getElementById("btnToggleEntrada");
  let btnBuscarEntrada = document.getElementById("btnBuscarEntrada");
  let btnGuardarEntrada = document.getElementById("btnGuardarEntrada");
  let btnPDFEntrada = document.getElementById("btnPDFEntrada");

  if (btnGuardarEntrada != null) {
    btnGuardarEntrada.addEventListener("click", () => {
      // Verificar si la compra es confirmada por el usuario
      if (confirmPurchase() === true) {
        entradaController.saveCompra();
        setTimeout(() => {
          location.reload();
        }, 300);
      }
    });
  } else {
    if (btnPDFEntrada != null) {
      entradaController.list();

      btnPDFEntrada.onclick = entradaController.print;

      btnAltaEntrada.addEventListener("click", () => {
        if (confirm("¿Quieres guardar las entradas?")) {
          entradaController.save();
          setTimeout(() => {
            location.reload();
          }, 300);
        }
      });

      btnBuscarEntrada.addEventListener("click", function () {
        let filterType = document.getElementById("filterType").value;

        if (filterType === "numeroTicket") {
          entradaController.loadByNumeroTicket();
        } else if (filterType === "numeroFuncion") {
          entradaController.loadByFuncion();
        } else if (filterType === "cuentaCliente") {
          entradaController.loadByCuenta();
        } else if (filterType === "pelicula") {
          entradaController.loadByPelicula();
        } else if (filterType === "programacion") {
          entradaController.loadByProgramacion();
        }
      });

      btnListarEntrada.onclick = entradaController.list;
    } else if (btnModificarEntrada != null) {
      btnModificarEntrada.onclick = entradaController.update;
    }
  }
});
