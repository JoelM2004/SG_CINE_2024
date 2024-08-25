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

  cantidad:{

    numero:0

  }
,
save: () => {
  let form = document.forms["formEntrada"];

  // Validación de los campos del formulario
  const horarioFuncion = form.fechaHoraFuncion.value;
  const precio = form.precio.value;
  const funcionId = form.numeroFuncion.value;
  const usuarioId = form.cuentaCliente.value;
  const cantidad = form.cantidad.value;

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

  // Obtener la fecha y hora actual en formato 'YYYY-MM-DDTHH:MM'
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
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
          .save(entradaController.data)
          .then((data) => {
              console.log("Guardando Datos");
              if (data.error !== "") {
                  alert("Error al guardar la entrada: " + data.error);
              } else {
                  // alert("Entrada guardada con éxito");
                  // Puedes recargar la página o realizar otras acciones aquí
              }
          })
          .catch((error) => {
              console.error("Error en la Petición ", error);
              alert("Ocurrió un error al guardar la entrada");
          });
  }
}

,

  update: () => {
    if (confirm("¿Seguro que lo quieres actualizar?")) {
      entradaController.data.estado =
        document.getElementById("btnToggleEntrada").value;

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

  list: async () => {
    //listo
    console.log("Listando entrada...");

    const formatDate = (dateString) => {
      // Divide la fecha y la hora usando el espacio
      const [datePart, timePart] = dateString.split(' ');
      
      // Divide la fecha en año, mes y día
      const [year, month, day] = datePart.split("-");
      
      // Divide la hora en horas y minutos (después de eliminar los segundos)
      const [hora, minutos] = timePart.split(":");
    
      // Retorna el formato deseado
      return `${day}/${month}/${year} a las ${hora}:${minutos}`;
    };
    

    index = 0;
    let data=await entradaService.list()
    console.log("entrada listados:", data);
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";


    for(const element of data.result){

      txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          
           let txts2 = await singletonController.loadFuncion(element.funcionId);
          
          txt += "<td>" + txts2.numeroFuncion + "</td>";
          txt += "<td>" + formatDate(element.horarioFuncion) + "</td>";
          txt += "<td>" + formatDate(element.horarioVenta) + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";

          let txts = await singletonController.loadUsuario(element.usuarioId)
          txt += "<td>" + txts.cuenta + "</td>";

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
        };

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      }


    ,

  loadByCuenta: async () => {
    console.log("Listando entrada...");
    aux = await singletonController.listUsuario();
    aux2 = await singletonController.listFuncion();

    let cuenta = document.getElementById("filterCuentaCliente").value;
    if (typeof cuenta !== "string" || cuenta.trim() === "") {
      alert("Por favor, ingresa una cuenta válida.");
      return;
    }

    index = 0;
    await entradaService
      .loadByCuenta(cuenta)
      .then((data) => {
        if (data.result.length === 0) {
          alert("Cuenta no encontrada");
          return;
        }

        console.log("Entrada listadas:", data);
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        data.result.forEach((element) => {
          txt += "<tr>";
          let txts2;
          txt += "<th>" + (index = index + 1) + "</th>";
          aux2.forEach((elemento2) => {
            if (elemento2.id == element.funcionId)
              txts2 = elemento2.numeroFuncion;
          });
          txt += "<td>" + txts2 + "</td>";
          txt += "<td>" + element.horaFuncion + "</td>";
          txt += "<td>" + element.horaVenta + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";

          let txts;
          aux.forEach((elemento) => {
            if (elemento.id == element.usuarioId) txts = elemento.cuenta;
          });
          txt += "<td>" + txts + "</td>";

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
        });

        tabla.innerHTML = txt;
      })
      .catch((error) => {
        console.error("Error al listar entrada:", error);
      });
  },

  loadByFuncion: async () => {
    console.log("Listando entrada...");
    aux = await singletonController.listUsuario();
    aux2 = await singletonController.listFuncion();

    let funcionId = parseInt(
      document.getElementById("filterNumeroFuncion").value,
      10
    );
    if (isNaN(funcionId) || funcionId <= 0) {
      alert("Por favor, ingresa un número de función válido.");
      return;
    }

    index = 0;
    await entradaService
      .loadByFuncion(funcionId)
      .then((data) => {
        if (data.result.length === 0) {
          alert("Función no encontrada");
          return;
        }

        console.log("Entrada listadas:", data);
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        data.result.forEach((element) => {
          txt += "<tr>";
          let txts2;
          txt += "<th>" + (index = index + 1) + "</th>";
          aux2.forEach((elemento2) => {
            if (elemento2.id == element.funcionId)
              txts2 = elemento2.numeroFuncion;
          });
          txt += "<td>" + txts2 + "</td>";
          txt += "<td>" + element.horaFuncion + "</td>";
          txt += "<td>" + element.horaVenta + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";

          let txts;
          aux.forEach((elemento) => {
            if (elemento.id == element.usuarioId) txts = elemento.cuenta;
          });
          txt += "<td>" + txts + "</td>";

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
        });

        tabla.innerHTML = txt;
      })
      .catch((error) => {
        console.error("Error al listar entrada:", error);
      });
  },

  loadByNumeroTicket: async () => {
    console.log("Listando entrada...");
    aux = await singletonController.listUsuario();
    aux2 = await singletonController.listFuncion();

    let numeroTicket = parseInt(
      document.getElementById("filterNumeroTicket").value,
      10
    );
    if (isNaN(numeroTicket) || numeroTicket <= 0) {
      alert("Por favor, ingresa un número de ticket válido.");
      return;
    }

    index = 0;
    await entradaService
      .loadByNumeroTicket(numeroTicket)
      .then((data) => {
        if (data.result.length === 0) {
          alert("Número de Ticket no encontrado");
          return;
        }

        console.log("Entrada listadas:", data);
        let tabla = document.getElementById("tbodyEntradas");
        let txt = "";

        data.result.forEach((element) => {
          txt += "<tr>";
          let txts2;
          txt += "<th>" + (index = index + 1) + "</th>";
          aux2.forEach((elemento2) => {
            if (elemento2.id == element.funcionId)
              txts2 = elemento2.numeroFuncion;
          });
          txt += "<td>" + txts2 + "</td>";
          txt += "<td>" + element.horaFuncion + "</td>";
          txt += "<td>" + element.horaVenta + "</td>";
          txt += "<td>" + element.precio + "</td>";
          txt += "<td>" + element.numeroTicket + "</td>";

          let txts;
          aux.forEach((elemento) => {
            if (elemento.id == element.usuarioId) txts = elemento.cuenta;
          });
          txt += "<td>" + txts + "</td>";

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
        });

        tabla.innerHTML = txt;
      })
      .catch((error) => {
        console.error("Error al listar entrada:", error);
      });
  },

  confirmPurchase: () =>{
    const termsAccepted = document.getElementById("termsCheck").checked;
    if (termsAccepted) {
      alert("Compra confirmada. ¡Gracias por tu compra!");
      // Aquí puedes agregar lógica para completar la compra, como enviar datos al servidor.
    } else {
      alert("Debes aceptar los términos y condiciones para continuar.");
    }
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

document.addEventListener("DOMContentLoaded", () => {
  let btnAltaEntrada = document.getElementById("btnAltaEntrada");
  let btnListarEntrada = document.getElementById("btnListarEntrada");
  let modificarUsuario = document.getElementById("btnModificarUsuario");
  let btnBuscarEntrada = document.getElementById("btnBuscarEntrada");
  let btnGuardarEntrada = document.getElementById("btnGuardarEntrada");
  let btnPDFEntrada = document.getElementById("btnPDFEntrada");

  if (document.getElementById("btnGuardarEntrada") != null) {


   /* btnGuardarEntrada.addEventListener("click",()=>{

      if(confirm("¿Quieres completar la compra?")){
        for (let index = 0; index < document.getElementById("ticket-quantity"); index++) {
          entradaController.confirmPurchase()
          entradaController.save()
        }
      }
    })*/
    
  } else {
    if (btnPDFEntrada != null) {
      entradaController.list();

      btnPDFEntrada.onclick = entradaController.print;

      btnAltaEntrada.addEventListener("click",()=>{

        if(confirm("¿Quieres guardar las entradas?")){

          entradaController.save();
          alert("Entrada guardada con éxito");
          entradaController.list()
          /* alert("Entrada guardada con éxito");
           setTimeout(() => {
                location.reload();
           }, 300);
        */
        }

        
      })

      btnBuscarEntrada.addEventListener("click", function () {
        if (document.getElementById("filterType").value == "ticket") {
          entradaController.loadByNumeroTicket();
        } else if (document.getElementById("filterType").value == "funcion") {
          entradaController.loadByFuncion();
        } else if (document.getElementById("filterType").value == "cuenta") {
          entradaController.loadByCuenta();
        }
      });

      btnListarEntrada.onclick = entradaController.list;
    } else if (modificarUsuario != null) {
      modificarUsuario.onclick = entradaController.update;
    }
  }
});
