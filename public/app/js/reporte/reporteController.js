let reporteController = {
  reporteUsuario: () => {
    let usuario = document.getElementById("nombreUsuario");
    let entradas = document.getElementById("entradasVendidas");
    let totalVendido = document.getElementById("totalRecaudado");
    let promedio = document.getElementById("precioPromedio");

    if (usuario.value.length <= 0) {
      alert("Inserte un Usuario válido");
      return;
    }

    reporteService
      .reporteUsuario(usuario.value)
      .then((data) => {
        console.log("Datos del reporte de usuario:", data);
        let tabla = document.getElementById("entradasTableBody");
        let txt = "";

        let index = 0;
        let total = 0;

        if (data.error === "") {
          // Limpiar la tabla antes de agregar nuevas filas
          tabla.innerHTML = "";

          if (data.result.length == 0) {
            tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> El usuario no contiene registros</td></tr>`;
            return;
          }
          // Obtener la lista de perfiles
          data.result.forEach((element) => {
            txt += "<tr>";
            txt += "<th>" + (index += 1) + "</th>";
            txt += "<td>" + element.cuenta + "</td>";
            txt += "<td>" + element.numeroTicket + "</td>";
            txt += "<td>" + element.numeroFuncion + "</td>";
            txt += "<td>" + formatDate(element.fecha) + "</td>";
            txt += "<td>" + formatHour(element.horaInicio) + "</td>";
            txt += "<td>" + element.nombre + "</td>";
            txt += "<td>" + element.precio + "</td>";
            total += element.precio;
            txt += "</tr>";
          });

          // Reemplazar el contenido HTML de la tabla con las filas generadas
          entradas.value = index;
          totalVendido.value = "$" + redondearDosDecimales(total);
          promedio.value = "$" + redondearDosDecimales(total / index);
          tabla.innerHTML = txt;
        } else {
          alert("El Usuario No Existe");
          // Limpiar la tabla y mostrar un mensaje si no hay resultados
          tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
        }
      })
      .catch((error) => {
        console.error("Error al listar Reportes:", error);
        let tabla = document.getElementById("entradasTableBody");
        // Limpiar la tabla y mostrar un mensaje de error
        tabla.innerHTML =
          "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
      });
  },
  reporteProgramacion: () => {
    let programacion = document.getElementById("programacionInput");
    let entradas = document.getElementById("entradasVendidas");
    let totalVendido = document.getElementById("totalRecaudado");
    let promedio = document.getElementById("precioPromedio");

    if (programacion.value == "") {
      alert("Inserte una programacion válida");
      return;
    }

    reporteService
      .reporteProgramacion(programacion.value)
      .then((data) => {
        console.log("Datos del reporte de usuario:", data);
        let tabla = document.getElementById("entradasTableBody");
        let txt = "";

        let index = 0;
        let total = 0;

        if (data.error === "") {
          // Limpiar la tabla antes de agregar nuevas filas
          tabla.innerHTML = "";

          if (data.result.length == 0) {
            tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
            return;
          }
          // Obtener la lista de perfiles
          data.result.forEach((element) => {
            txt += "<tr>";
            txt += "<th>" + (index += 1) + "</th>";
            txt += "<td>" + element.cuenta + "</td>";
            txt += "<td>" + element.numeroTicket + "</td>";
            txt += "<td>" + element.numeroFuncion + "</td>";
            txt += "<td>" + formatDate(element.fecha) + "</td>";
            txt += "<td>" + formatHour(element.horaInicio) + "</td>";
            txt += "<td>" + element.nombre + "</td>";
            txt += "<td>" + element.precio + "</td>";
            total += element.precio;
            txt += "</tr>";
          });

          // Reemplazar el contenido HTML de la tabla con las filas generadas
          entradas.value = index;
          totalVendido.value = "$" + redondearDosDecimales(total);
          promedio.value = "$" + redondearDosDecimales(total / index);
          tabla.innerHTML = txt;
        } else {
          alert("La programación No Existe");
          // Limpiar la tabla y mostrar un mensaje si no hay resultados
          tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
        }
      })
      .catch((error) => {
        console.error("Error al listar Reportes:", error);
        let tabla = document.getElementById("entradasTableBody");
        // Limpiar la tabla y mostrar un mensaje de error
        tabla.innerHTML =
          "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
      });
  },
  reporteFuncion: () => {
    let funcion = document.getElementById("funcionInput");
    let entradas = document.getElementById("entradasVendidas");
    let totalVendido = document.getElementById("totalRecaudado");
    let promedio = document.getElementById("precioPromedio");

    if (funcion.value == "") {
      alert("Inserte una funcion válida");
      return;
    }

    reporteService
      .reporteFuncion(funcion.value)
      .then((data) => {
        console.log("Datos del reporte de usuario:", data);
        let tabla = document.getElementById("entradasTableBody");
        let txt = "";

        let index = 0;
        let total = 0;

        if (data.error === "") {
          // Limpiar la tabla antes de agregar nuevas filas
          tabla.innerHTML = "";

          if (data.result.length == 0) {
            tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
            return;
          }
          // Obtener la lista de perfiles
          data.result.forEach((element) => {
            txt += "<tr>";
            txt += "<th>" + (index += 1) + "</th>";
            txt += "<td>" + element.cuenta + "</td>";
            txt += "<td>" + element.numeroTicket + "</td>";
            txt += "<td>" + element.numeroFuncion + "</td>";
            txt += "<td>" + formatDate(element.fecha) + "</td>";
            txt += "<td>" + formatHour(element.horaInicio) + "</td>";
            txt += "<td>" + element.nombre + "</td>";
            txt += "<td>" + element.precio + "</td>";
            total += element.precio;
            txt += "</tr>";
          });

          // Reemplazar el contenido HTML de la tabla con las filas generadas
          entradas.value = index;
          totalVendido.value = "$" + redondearDosDecimales(total);
          promedio.value = "$" + redondearDosDecimales(total / index);
          tabla.innerHTML = txt;
        } else {
          alert("La Funcion No Existe");
          // Limpiar la tabla y mostrar un mensaje si no hay resultados
          tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
        }
      })
      .catch((error) => {
        console.error("Error al listar Reportes:", error);
        let tabla = document.getElementById("entradasTableBody");
        // Limpiar la tabla y mostrar un mensaje de error
        tabla.innerHTML =
          "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
      });
  },
  reportePelicula: () => {
    let pelicula = document.getElementById("peliculaInput");
    let entradas = document.getElementById("entradasVendidas");
    let totalVendido = document.getElementById("totalRecaudado");
    let promedio = document.getElementById("precioPromedio");

    if (pelicula.value == "") {
      alert("Inserte una funcion válida");
      return;
    }

    reporteService
      .reportePelicula(pelicula.value)
      .then((data) => {
        console.log("Datos del reporte:", data);
        let tabla = document.getElementById("entradasTableBody");
        let txt = "";

        let index = 0;
        let total = 0;

        if (data.error === "") {
          // Limpiar la tabla antes de agregar nuevas filas
          tabla.innerHTML = "";

          if (data.result.length == 0) {
            tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
            return;
          }
          // Obtener la lista de perfiles
          data.result.forEach((element) => {
            txt += "<tr>";
            txt += "<th>" + (index += 1) + "</th>";
            txt += "<td>" + element.cuenta + "</td>";
            txt += "<td>" + element.numeroTicket + "</td>";
            txt += "<td>" + element.numeroFuncion + "</td>";
            txt += "<td>" + formatDate(element.fecha) + "</td>";
            txt += "<td>" + formatHour(element.horaInicio) + "</td>";
            txt += "<td>" + element.nombre + "</td>";
            txt += "<td>" + element.precio + "</td>";
            total += element.precio;
            txt += "</tr>";
          });

          // Reemplazar el contenido HTML de la tabla con las filas generadas
          entradas.value = index;
          totalVendido.value = "$" + redondearDosDecimales(total);
          promedio.value = "$" + redondearDosDecimales(total / index);
          tabla.innerHTML = txt;
        } else {
          alert("La Funcion No Existe");
          // Limpiar la tabla y mostrar un mensaje si no hay resultados
          tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
        }
      })
      .catch((error) => {
        console.error("Error al listar Reportes:", error);
        let tabla = document.getElementById("entradasTableBody");
        // Limpiar la tabla y mostrar un mensaje de error
        tabla.innerHTML =
          "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
      });
  },
  print: () => {
    const $elementoParaConvertir = document.getElementById("imprimir"); // Se selecciona el div que contiene el reporte

    // Crear un contenedor temporal para añadir la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título "Reporte de Cine"
    const title = document.createElement("h1");
    title.innerText = "Reporte de Cine";
    tempContainer.appendChild(title);

    // Crear y añadir la fecha de emisión
    const date = document.createElement("p");
    const today = new Date();
    date.innerText =
      "Fecha de emisión del reporte: " + today.toLocaleDateString();
    tempContainer.appendChild(date);

    // Obtener el texto seleccionado del tipo de reporte
    const tipoReporteSelect = document.getElementById("tipoReporte");
    const tipoReporteText =
      tipoReporteSelect.options[tipoReporteSelect.selectedIndex].text;

    // Crear y añadir el texto del tipo de reporte
    const tipoReporte = document.createElement("p");
    tipoReporte.innerText = "Tipo de Reporte Seleccionado: " + tipoReporteText;
    tempContainer.appendChild(tipoReporte);

    // Añadir información de las secciones dependiendo del tipo de reporte seleccionado
    const tipoReporteValue = tipoReporteSelect.value;

    if (tipoReporteValue === "funciones") {
      const funcionSelect = document.getElementById("funcionInput");
      const funcionText =
        funcionSelect.options[funcionSelect.selectedIndex].text;
      const funcionInfo = document.createElement("p");
      funcionInfo.innerText = "Número de Función Seleccionado: " + funcionText;
      tempContainer.appendChild(funcionInfo);
    } else if (tipoReporteValue === "peliculas") {
      const peliculaSelect = document.getElementById("peliculaInput");
      const peliculaText =
        peliculaSelect.options[peliculaSelect.selectedIndex].text;
      const peliculaInfo = document.createElement("p");
      peliculaInfo.innerText = "Película Seleccionada: " + peliculaText;
      tempContainer.appendChild(peliculaInfo);
    } else if (tipoReporteValue === "programaciones") {
      const programacionSelect = document.getElementById("programacionInput");
      const programacionText =
        programacionSelect.options[programacionSelect.selectedIndex].text;
      const programacionInfo = document.createElement("p");
      programacionInfo.innerText =
        "Programación Seleccionada: " + programacionText;
      tempContainer.appendChild(programacionInfo);
    } else if (tipoReporteValue === "usuario") {
      const nombreUsuario = document.getElementById("nombreUsuario").value;
      const usuarioInfo = document.createElement("p");
      usuarioInfo.innerText = "Nombre de Usuario: " + nombreUsuario;
      tempContainer.appendChild(usuarioInfo);
    }

    // Información adicional: cantidad de entradas vendidas, total recaudado y precio promedio
    // Obtener los valores de los inputs
    const cantidadEntradas = document.getElementById("entradasVendidas").value; // Use .value for inputs
    const totalRecaudado = document.getElementById("totalRecaudado").value; // Use .value for inputs
    const precioPromedio = document.getElementById("precioPromedio").value; // Use .value for inputs

    // Crear y añadir la información adicional
    const cantidadEntradasP = document.createElement("p");
    cantidadEntradasP.innerText =
      "Cantidad de Entradas Vendidas: " + cantidadEntradas;
    tempContainer.appendChild(cantidadEntradasP);

    const totalRecaudadoP = document.createElement("p");
    totalRecaudadoP.innerText = "Total Recaudado: " + totalRecaudado;
    tempContainer.appendChild(totalRecaudadoP);

    const precioPromedioP = document.createElement("p");
    precioPromedioP.innerText =
      "Precio Promedio de Entradas: " + precioPromedio;
    tempContainer.appendChild(precioPromedioP);

    // Clonar el elemento a convertir
    const clonedElement = $elementoParaConvertir.cloneNode(true);

    // Eliminar el select del tipo de reporte
    const tipoReporteSection = clonedElement.querySelector("#tipoReporte");
    if (tipoReporteSection) tipoReporteSection.remove();

    // Eliminar el label del tipo de reporte
    const tipoReporteLabel = clonedElement.querySelector(
      'label[for="tipoReporte"]'
    );
    if (tipoReporteLabel) tipoReporteLabel.remove();

    // Eliminar las secciones de datos (funciones, películas, programaciones, usuario)
    const sectionsToRemove = [
      "funcionSection",
      "peliculaSection",
      "programacionSection",
      "usuarioSection",
    ];
    sectionsToRemove.forEach((id) => {
      const section = clonedElement.querySelector(`#${id}`);
      if (section) section.remove();
    });

    // Eliminar los divs específicos con las clases mencionadas
    const divsToRemove = clonedElement.querySelectorAll("div.col-md-6");
    divsToRemove.forEach((div) => {
      const label = div.querySelector("label");
      const input = div.querySelector("input");
      if (label && input) {
        // Confirmar que son los divs correctos antes de eliminarlos
        if (
          label.innerText.includes("Cantidad de Entradas Vendidas:") ||
          label.innerText.includes("Total Recaudado:") ||
          label.innerText.includes("Precio Promedio de Entrada:")
        ) {
          div.remove();
        }
      }
    });

    // Eliminar todos los elementos <h1> del clon excepto el título que ya agregamos
    const h1Elements = clonedElement.querySelectorAll("h1");
    h1Elements.forEach((h1) => h1.remove());

    // Eliminar los botones pero dejar los inputs y selects que contienen los datos
    const buttons = clonedElement.querySelectorAll("button");
    buttons.forEach((button) => button.remove());

    // Aplicar el tamaño de la fuente más pequeño a los inputs y etiquetas
    const inputs = clonedElement.querySelectorAll("input, label");
    inputs.forEach((input) => {
      input.style.fontSize = "8px"; // Tamaño de fuente más pequeño
      input.style.padding = "2px"; // Reducir el padding para ahorrar espacio
    });

    // Asegurarse de que los select también mantengan sus opciones y estilos
    const selects = clonedElement.querySelectorAll("select");
    selects.forEach((select) => {
      select.style.fontSize = "8px"; // Reducir tamaño del texto en selectores
      select.style.padding = "2px"; // Reducir el padding
    });

    // También ajustar el tamaño de las etiquetas y los párrafos
    const paragraphs = clonedElement.querySelectorAll("p, h4, label");
    paragraphs.forEach((p) => {
      p.style.fontSize = "10px"; // Reducir tamaño de los párrafos y etiquetas
    });

    // Agregar el contenido útil (clonado) al contenedor temporal
    tempContainer.appendChild(clonedElement);

    // Aplicar estilo al contenedor temporal para evitar problemas de renderizado
    tempContainer.style.fontFamily = "Arial, sans-serif";
    tempContainer.style.width = "100%";
    tempContainer.style.overflow = "hidden";

    // Aplicar estilo a la tabla para ajustarla al tamaño del PDF
    const tables = tempContainer.getElementsByTagName("table");
    for (let table of tables) {
      table.style.width = "100%"; // Ajustar el ancho de la tabla al 100%
      table.style.tableLayout = "auto"; // Ajustar las celdas automáticamente
    }

    // Ajustar el tamaño de las celdas de la tabla
    const tableCells = tempContainer.getElementsByTagName("td");
    for (let cell of tableCells) {
      cell.style.fontSize = "8px"; // Reducir aún más el tamaño de la fuente en las celdas
      cell.style.padding = "2px"; // Reducir el padding en las celdas
    }

    const tableCellsth = tempContainer.getElementsByTagName("th");
    for (let cell of tableCellsth) {
      cell.style.fontSize = "8px"; // Reducir el tamaño de la fuente en las celdas de encabezado
      cell.style.padding = "2px"; // Reducir el padding en las celdas de encabezado
    }

    // Configuración de html2pdf para generar el PDF
    html2pdf()
      .from(tempContainer)
      .set({
        margin: 1,
        filename: "reporte_cine.pdf",
        image: {
          type: "jpeg",
          quality: 0.98,
        },
        html2canvas: {
          scale: 4, // A mayor escala, mejor calidad, pero más peso
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

function formatDate(dateString) {
  const dateParts = dateString.split("-");
  return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
}

function redondearDosDecimales(numero) {
  return Math.round(numero * 100) / 100;
}

const formatHour = (hourString) => {
  // Asumiendo que `hourString` es una cadena en formato "HH:mm:ss"
  return hourString.split(":").slice(0, 2).join(":");
};

document.addEventListener("DOMContentLoaded", () => {
  let generarReporteBtn = document.getElementById("generarReporteBtn");
  let generarPDFBtn = document.getElementById("generarPDFBtn");
  generarReporteBtn.addEventListener("click", function () {
    if (document.getElementById("tipoReporte").value == "usuario") {
      reporteController.reporteUsuario();
    } else if (
      document.getElementById("tipoReporte").value == "programaciones"
    ) {
      reporteController.reporteProgramacion();
    } else if (document.getElementById("tipoReporte").value == "peliculas") {
      reporteController.reportePelicula();
    } else if (document.getElementById("tipoReporte").value == "funciones") {
      reporteController.reporteFuncion();
    }
  });

  generarPDFBtn.addEventListener("click", () => {
    reporteController.print();
  });
});
