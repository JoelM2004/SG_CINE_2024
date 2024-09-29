let funcionController = {
  data: {
    id: 0,
    fecha: "",
    horaInicio: "",
    duracion: 0,
    numeroFuncion: 0,
    peliculaId: 0,
    salaId: 0,
    programacionId: 0,
    precio: 0.0,
  },
  save: () => {
    if (confirm("¿Quieres crear la función?")) {
      let funcionForm = document.forms["formFuncion"];

      // Validar Fecha
      if (funcionForm.fecha.value === "") {
        alert("La fecha es requerida.");
        return;
      } else {
        funcionController.data.fecha = funcionForm.fecha.value;
      }

      // Validar Hora de Inicio
      if (funcionForm.horaInicio.value === "") {
        alert("La hora de inicio es requerida.");
        return;
      } else {
        funcionController.data.horaInicio = funcionForm.horaInicio.value;
      }

      // Validar Duración
      if (funcionForm.duracion.value <= 0) {
        alert("La duración debe ser mayor a 0.");
        return;
      } else {
        funcionController.data.duracion = parseInt(funcionForm.duracion.value);
      }

      // Validar Número de Función
      if (funcionForm.numeroFuncion.value <= 0) {
        alert("El número de función debe ser mayor a 0.");
        return;
      } else {
        funcionController.data.numeroFuncion = parseInt(
          funcionForm.numeroFuncion.value
        );
      }

      // Validar Película ID
      if (
        funcionForm.nombrePelicula.value === "" ||
        isNaN(funcionForm.nombrePelicula.value)
      ) {
        alert("Debe seleccionar una película válida.");
        return;
      } else {
        funcionController.data.peliculaId = parseInt(
          funcionForm.nombrePelicula.value
        );
      }

      // Validar Sala ID
      if (
        funcionForm.numeroSala.value === "" ||
        isNaN(funcionForm.numeroSala.value)
      ) {
        alert("Debe seleccionar una sala válida.");
        return;
      } else {
        funcionController.data.salaId = parseInt(funcionForm.numeroSala.value);
      }

      // Validar Programación ID
      if (
        funcionForm.fechaProgramacion.value === "" ||
        isNaN(funcionForm.fechaProgramacion.value)
      ) {
        alert("Debe seleccionar una programación válida.");
        return;
      } else {
        funcionController.data.programacionId = parseInt(
          funcionForm.fechaProgramacion.value
        );
      }

      // Validar Precio
      if (funcionForm.precio.value <= 0 || isNaN(funcionForm.precio.value)) {
        alert("El precio debe ser un número mayor que 0.");
        return;
      } else {
        funcionController.data.precio = parseFloat(funcionForm.precio.value);
      }

      // Guardar la función
      funcionService
        .save(funcionController.data)
        .then((data) => {
          console.log("Guardando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al guardar la función: " + data.error);
          } else {
            alert("Función guardada con éxito");
            // Opcional: actualizar la lista o redirigir
            funcionController.list();
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar la función");
        });
    }
  },
  print: () => {
    const $elementoParaConvertir = document.getElementById("tablaFunciones"); // <-- Aquí puedes elegir cualquier elemento del DOM

    // Crear un contenedor temporal para añadir el título y la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título
    const title = document.createElement("h1");
    title.innerText = "Listado de Funciones";
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

  list: () => {
    console.log("Listando Funciones...");

    index = 0;
    funcionService
      .list()
      .then((data) => {
        console.log("Funciones listadas:", data);
        let tabla = document.getElementById("tbodyFunciones");
        let txt = "";

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + formatDate(element.fecha) + "</td>";
          txt += "<td>" + formatHour(element.horaInicio) + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + element.nombre + "</td>";  
          txt += "<td>" + element.numeroSala + "</td>";
        

          txt +=
            "<td>" +
            formatDate(element.fechaInicio) +
            " a " +
            formatDate(element.fechaFin) +
            "</td>";

          txt += "<td>" + element.precio + "</td>";

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/funcion/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Funciones:", error);
      });
  },
  delete: () => {
    if (confirm("¿Quiere eliminar la función?")) {
      funcionController.data.id = document.getElementById(
        "filaModificarFuncion"
      ).dataset.id;

      funcionService
        .delete(funcionController.data)
        .then((data) => {
          alert(data.mensaje); // Muestra el mensaje del servidor al usuario
          setTimeout(() => {
            location.reload();
          }, 300);
        })
        .catch((error) => {
          console.error("Error al eliminar la función:", error);
          alert(
            "Hubo un problema al eliminar la función. Por favor, inténtelo de nuevo más tarde." +
              error
          );
        });
    }
  },

  update: () => {
    if (confirm("¿Seguro que lo quieres actualizar?")) {
      let form = document.forms["formFuncionM"];
      let idElemento = document.getElementById("filaModificarFuncion");

      if (!idElemento || !idElemento.dataset.id) {
        alert("No se pudo obtener el ID de la función.");
        return;
      }

      funcionController.data.id = parseInt(idElemento.dataset.id);

      // Validar el ID de la función
      if (isNaN(funcionController.data.id) || funcionController.data.id <= 0) {
        alert("ID de función no válido.");
        return;
      }

      // Obtener los valores del formulario
      funcionController.data.fecha = form.fecha.value.trim();
      funcionController.data.horaInicio = form.horaInicio.value.trim();
      funcionController.data.duracion = parseInt(form.duracion.value);
      funcionController.data.numeroFuncion = parseInt(form.numeroFuncion.value);
      funcionController.data.peliculaId = parseInt(form.nombrePelicula.value);
      funcionController.data.salaId = parseInt(form.numeroSala.value);
      funcionController.data.programacionId = parseInt(
        form.fechaProgramacion.value
      );
      funcionController.data.precio = parseFloat(form.precio.value);

      // Validar campos de fecha y hora
      if (!funcionController.data.fecha) {
        alert("La fecha es requerida.");
        return;
      }

      if (!funcionController.data.horaInicio) {
        alert("La hora de inicio es requerida.");
        return;
      }

      // Validar duración
      if (
        isNaN(funcionController.data.duracion) ||
        funcionController.data.duracion <= 0
      ) {
        alert("La duración debe ser un número mayor a 0.");
        return;
      }

      // Validar número de función
      if (
        isNaN(funcionController.data.numeroFuncion) ||
        funcionController.data.numeroFuncion <= 0
      ) {
        alert("El número de función debe ser un número mayor a 0.");
        return;
      }

      // Validar ID de película
      if (
        isNaN(funcionController.data.peliculaId) ||
        funcionController.data.peliculaId <= 0
      ) {
        alert("Debe seleccionar una película válida.");
        return;
      }

      // Validar ID de sala
      if (
        isNaN(funcionController.data.salaId) ||
        funcionController.data.salaId <= 0
      ) {
        alert("Debe seleccionar una sala válida.");
        return;
      }

      // Validar ID de programación
      if (
        isNaN(funcionController.data.programacionId) ||
        funcionController.data.programacionId <= 0
      ) {
        alert("Debe seleccionar una programación válida.");
        return;
      }

      // Validar precio
      if (
        isNaN(funcionController.data.precio) ||
        funcionController.data.precio <= 0
      ) {
        alert("El precio debe ser un número mayor que 0.");
        return;
      }

      // Enviar la solicitud al servicio
      funcionService
        .update(funcionController.data)
        .then((data) => {
          console.log("Actualizando Datos");
          if (data.error !== "") {
            alert("Error al actualizar la función: " + data.error);
          } else {
            alert("Función actualizada con éxito");
            setTimeout(() => {
              location.reload();
            }, 300);
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al actualizar la función");
        });
    }
  },

  loadByNumeroSala:  () => {
    console.log("Listando Funciones...");

    index = 0;
    funcionService
      .loadByNumeroSala(document.getElementById("filterNumeroSalaInput").value)
      .then((data) => {
        console.log("Funciones listadas:", data);
        let tabla = document.getElementById("tbodyFunciones");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Funciones.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + formatDate(element.fecha) + "</td>";
          txt += "<td>" + formatHour(element.horaInicio) + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + element.nombre + "</td>";  
          txt += "<td>" + element.numeroSala + "</td>";
        

          txt +=
            "<td>" +
            formatDate(element.fechaInicio) +
            " a " +
            formatDate(element.fechaFin) +
            "</td>";

          txt += "<td>" + element.precio + "</td>";

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/funcion/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Funciones:", error);
      });
  },

  loadByFechaProgramacion:  () => {
    console.log("Listando Funciones...");

    index = 0;
    funcionService
      .loadByFechaProgramacion(
        document.getElementById("filterFechaProgramacionInput").value
      )
      .then((data) => {
        console.log("Funciones listadas:", data);
        let tabla = document.getElementById("tbodyFunciones");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Funciones.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + formatDate(element.fecha) + "</td>";
          txt += "<td>" + formatHour(element.horaInicio) + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + element.nombre + "</td>";  
          txt += "<td>" + element.numeroSala + "</td>";
        

          txt +=
            "<td>" +
            formatDate(element.fechaInicio) +
            " a " +
            formatDate(element.fechaFin) +
            "</td>";

          txt += "<td>" + element.precio + "</td>";

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/funcion/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Funciones:", error);
      });
  },

  loadByNombrePelicula:  () => {
    console.log("Listando Funciones...");

    index = 0;
    funcionService
      .loadByNombrePelicula(
        document.getElementById("filterNombrePeliculaInput").value
      )
      .then((data) => {
        console.log("Funciones listadas:", data);
        let tabla = document.getElementById("tbodyFunciones");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Funciones.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + formatDate(element.fecha) + "</td>";
          txt += "<td>" + formatHour(element.horaInicio) + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + element.nombre + "</td>";  
          txt += "<td>" + element.numeroSala + "</td>";
        

          txt +=
            "<td>" +
            formatDate(element.fechaInicio) +
            " a " +
            formatDate(element.fechaFin) +
            "</td>";

          txt += "<td>" + element.precio + "</td>";

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/funcion/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Funciones:", error);
      });
  },

  loadByNumeroFuncion:  () => {
    console.log("Listando Funciones...");

    index = 0;
    funcionService
      .loadByNumeroFuncion(
        document.getElementById("filterNumeroFuncionInput").value
      )
      .then((data) => {
        console.log("Funciones listadas:", data);
        let tabla = document.getElementById("tbodyFunciones");
        let txt = "";

        if (data.result.length == 0) {
          txt =
            "<tr><td colspan='15' style='text-align: center;'>No se encontraron Funciones.</td></tr>";
          tabla.innerHTML = txt;
          return;
        }

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + formatDate(element.fecha) + "</td>";
          txt += "<td>" + formatHour(element.horaInicio) + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.numeroFuncion + "</td>";
          txt += "<td>" + element.nombre + "</td>";  
          txt += "<td>" + element.numeroSala + "</td>";
        

          txt +=
            "<td>" +
            formatDate(element.fechaInicio) +
            " a " +
            formatDate(element.fechaFin) +
            "</td>";

          txt += "<td>" + element.precio + "</td>";

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/funcion/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Funciones:", error);
      });
  },

  listFunciones: () => {
    console.log("Listando Funciones...");
  
    funcionService.listFunciones(
      document.getElementById("peliculaId").dataset.id
    ).then((data) => {
      console.log("Funciones listadas:", data.result);
  
      let listaFunciones = document.getElementById("funciones-lista");
      let txt = "";
  
      if (data.result.length === 0) {
        // Si no hay funciones disponibles, muestra un mensaje
        txt = `<p class="list-group-item">No hay funciones disponibles.</p>`;
      } else {
        // Generar dinámicamente las funciones
        data.result.forEach((element) => {
          let salatxt = element.numeroSala;
          let tipotxt = element.nombreTipo;
          let audiotxt = element.nombreAudio;
          
          // Si la sala no está disponible, aplicar estilos grises y eliminar el enlace
          let estiloSala = element.estadoSala === 1 ? "" : "text-muted"; // Clase para texto gris
          let mensajeSala = element.estadoSala === 1 ? "" : `<span class="badge bg-danger">La Sala no se encuentra disponible</span>`;
          let isClickable = element.estadoSala === 1; // Verificar si la sala está disponible
          let enlaceInicio = isClickable 
            ? `<a href="http://localhost/SG_CINE_2024/public/entrada/view/${element.id}" class="list-group-item list-group-item-action py-3 ${estiloSala}">`
            : `<div class="list-group-item py-3 ${estiloSala}">`;
          let enlaceFin = isClickable ? `</a>` : `</div>`;
  
          txt += `
          ${enlaceInicio}
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1" style="font-size: 1.25rem; font-weight: bold;">
                <i class="fas fa-film"></i> Función ${element.numeroFuncion} - ${formatDate(element.fecha)} a las ${formatHour(element.horaInicio)}
              </h5>
              <small style="font-size: 1rem;">
                <i class="fas fa-clock"></i> Duración: ${element.duracion} min
              </small>
            </div>
            <p class="mb-1" style="font-size: 1.15rem;">
              <i class="fas fa-theater-masks"></i> Sala ${salatxt} - ${tipotxt} - 
              <i class="fas fa-volume-up"></i> ${audiotxt} - 
              <i class="fas fa-dollar-sign"></i> $${element.precio}
            </p>
            ${mensajeSala}
          ${enlaceFin}
          `;
        });
      }
  
      listaFunciones.innerHTML = txt; // Reemplaza el contenido HTML con las funciones generadas
    });
  }
  
  
,  

}
  
const formatDate = (dateString) => {
  const [year, month, day] = dateString.split("-");
  return `${day}/${month}/${year}`;
};

const formatHour = (dateString) => {
  const [hour, minute] = dateString.split(":");
  return `${hour}:${minute}`;
};

document.addEventListener("DOMContentLoaded", () => {
  let btnBuscarFuncion = document.getElementById("btnBuscarFuncion");
  let btnListarFuncion = document.getElementById("btnListarFuncion");
  let btnPDFFuncion = document.getElementById("btnPDFFuncion");
  let btnAltaFuncion = document.getElementById("btnAltaFuncion");

  let btnBorrarFuncion = document.getElementById("btnBorrarFuncion");
  let btnModificarFuncion = document.getElementById("btnModificarFuncion");

  if (btnAltaFuncion != null) {
    funcionController.list();
    btnAltaFuncion.onclick = funcionController.save;
    btnPDFFuncion.onclick = funcionController.print;
    btnListarFuncion.onclick = funcionController.list;

    btnBuscarFuncion.addEventListener("click", function () {
      if (document.getElementById("filterType").value == "numeroSala") {
        funcionController.loadByNumeroSala();
      } else if (
        document.getElementById("filterType").value == "nombrePelicula"
      ) {
        funcionController.loadByNombrePelicula();
      } else if (
        document.getElementById("filterType").value == "numeroFuncion"
      ) {
        funcionController.loadByNumeroFuncion();
      } else if (
        document.getElementById("filterType").value == "fechaProgramacion"
      ) {
        funcionController.loadByFechaProgramacion();
      }
    });
  } else if (btnModificarFuncion != null) {
    btnModificarFuncion.onclick = funcionController.update;
    btnBorrarFuncion.onclick = funcionController.delete;
  } else if (document.getElementById("funciones-lista") != null) {
    funcionController.listFunciones();
  }
});
