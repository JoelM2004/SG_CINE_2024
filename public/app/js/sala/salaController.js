let salaController={
    data:{
        id:0,
        capacidad:0,
        estado:0,
        numeroSala:0

    }
    ,
  save: () => {
    let form = document.forms["formSala"];

    // Confirmación antes de guardar
    if (confirm("¿Quieres crear la sala?")) {
        let capacidad = parseInt(form.capacidadSala.value);
        let numeroSala = parseInt(form.numeroSala.value);
        let estado = parseInt(form.estadoSala.value);

        // Validaciones
        if (capacidad > 0) {
            salaController.data.capacidad = capacidad;
        } else {
            alert("Ingrese una capacidad que sea mayor a 0");
            return; // Detiene el proceso si la validación falla
        }

        if (numeroSala > 0) {
            salaController.data.numeroSala = numeroSala;
        } else {
            alert("Ingrese un número de sala que sea mayor a 0");
            return; // Detiene el proceso si la validación falla
        }

        salaController.data.estado = estado;

        // Llamada al servicio para guardar los datos
        salaService.save(salaController.data)
            .then((data) => {
                console.log("Guardando Datos");
                // Manejo de la respuesta
                if (data.error !== "") {
                    alert("Error al guardar la sala: " + data.error);
                } else {
                    alert("Sala guardada con éxito");
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                }
            })
            .catch((error) => {
                console.error("Error en la Petición ", error);
                alert("Ocurrió un error al guardar la sala");
            });
    }
},

delete: () => {
  if (confirm("¿Quiere eliminar el sala?")) {
    salaController.data.id = document.getElementById(
      "filaModificarsala"
    ).dataset.id;

    salaService
      .delete(salaController.data)
      .then((data) => {
        alert(data.mensaje); // Muestra el mensaje del servidor al usuario
      })
      .catch((error) => {
        console.error("Error al eliminar el sala:", error);
        alert(
          "Hubo un problema al eliminar el sala. Por favor, inténtelo de nuevo más tarde."+ error
        );
      });
  }
},

update: () => {
  let form = document.forms["formSalaM"];

  // Obtención del ID de la sala desde el dataset del elemento
  salaController.data.id = parseInt(document.getElementById("filaModificarsala").dataset.id);

  // Asignación de valores del formulario
  salaController.data.numeroSala = form.numeroSalaM.value;
  salaController.data.estado = form.estadoSalaM.value;
  salaController.data.capacidad = form.capacidadSalaM.value;

  // Confirmación antes de actualizar
  if (confirm("¿Quieres actualizar la sala?")) {
      let capacidad = parseInt(form.capacidadSalaM.value);
      let numeroSala = parseInt(form.numeroSalaM.value);
      let estado = parseInt(form.estadoSalaM.value);

      // Validaciones
      if (capacidad > 0) {
          salaController.data.capacidad = capacidad;
      } else {
          alert("Ingrese una capacidad que sea mayor a 0");
          return; // Detiene el proceso si la validación falla
      }

      if (numeroSala > 0) {
          salaController.data.numeroSala = numeroSala;
      } else {
          alert("Ingrese un número de sala que sea mayor a 0");
          return; // Detiene el proceso si la validación falla
      }

      salaController.data.estado = estado;

      // Llamada al servicio para actualizar los datos
      salaService.update(salaController.data)
          .then((data) => {
              console.log("Actualizando Datos");
              // Manejo de la respuesta
              if (data.error !== "") {
                  alert("Error al actualizar la sala: " + data.error);
              } else {
                  alert("Sala actualizada con éxito");
                  setTimeout(() => {
                      location.reload();
                  }, 300);
              }
          })
          .catch((error) => {
              console.error("Error en la Petición ", error);
              alert("Ocurrió un error al actualizar la sala");
          });
  }
},


list: () => {

  index=0;

    console.log("Listando salas...");

    salaService
      .list()
      .then((data) => {
        console.log("salas listados:", data);
        // Aquí podrías hacer algo con los datos, como actualizar una lista en la interfaz
        let tabla = document.getElementById("tbodySala");
        let txt = "";

        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index=index+1) + "</th>";
          txt += "<td>" + element.numeroSala + "</td>"; 
          txt += "<td>" + element.capacidad + "</td>"; 
          if (element.estado === 1) {
            txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
        } else {
            txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
        }
          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/sala/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar salas:", error);
      });
  },

print: () => {
    const $elementoParaConvertir = document.getElementById("tablaSala"); // <-- Aquí puedes elegir cualquier elemento del DOM

    // Crear un contenedor temporal para añadir el título y la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título
    const title = document.createElement("h1");
    title.innerText = "Listado de Salas";
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

loadByNumeroSala: () => {
    console.log("Listando salas...");

    // Obtener el número de sala del filtro
    const numeroSala = parseInt(document.getElementById("filterNumeroSala").value);

    // Llamar al servicio para cargar salas
    salaService.loadByNumeroSala(numeroSala)
      .then((data) => {
        if (data.error === "") {
          console.log("Sala encontrada:", data);

          let tabla = document.getElementById("tbodySala");
          let txt = "";

          // Aquí se espera un solo objeto, no un array
          const sala = data.result;

          if (sala) {
            txt += "<tr>";
            txt += "<th>1</th>"; // Solo una sala, por lo tanto, índice fijo en 1
            txt += "<td>" + sala.numeroSala + "</td>";
            txt += "<td>" + sala.capacidad + "</td>";
            if (sala.estado === 1) {
              txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
            } else {
              txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
            }
            txt +=
              '<td><a href="http://localhost/SG_CINE_2024/public/sala/edit/' +
              sala.id +
              '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
            txt += "</tr>";
          } else {
            // Manejo si no se encuentra la sala
            txt += "<tr><td colspan='5'>No se encontró la sala.</td></tr>";
          }

          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        } else {
          alert("No se encontró la sala para el número dado.");
        }
      })
      .catch((error) => {
        console.error("Error al listar salas:", error);
        // Opcional: Mostrar un mensaje de error en la interfaz
        let tabla = document.getElementById("tbodySala");
        tabla.innerHTML = "<tr><td colspan='5'>Ocurrió un error al listar la sala.</td></tr>";
      });
},

loadByEstado:  () => {
  console.log("Listando salas...");
  
  index = 0;
   salaService
    .loadByEstado(document.getElementById("filterEstadoSelect").value)
    .then((data) => {
      console.log("salas listados:", data);
      let tabla = document.getElementById("tbodySala");
      let txt = "";

      // Obtener la lista de perfiles
      data.result.forEach((element) => {
        txt += "<tr>";
        txt += "<td>" + (index=index+1) + "</td>";
        txt += "<td>" + element.numeroSala + "</td>";
            txt += "<td>" + element.capacidad + "</td>";
            if (element.estado === 1) {
              txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
            } else {
              txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
            }
            txt +=
              '<td><a href="http://localhost/SG_CINE_2024/public/sala/edit/' +
              element.id +
              '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
            txt += "</tr>";

  
      });

      tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
    })
    .catch((error) => {
      console.error("Error al listar salas:", error);
    });
},

loadByCapacidad: () => {
  console.log("Listando salas...");

  // Obtención de los valores de los campos de filtro
  let min = parseInt(document.getElementById("filterCapacidadMin").value);
  let max = parseInt(document.getElementById("filterCapacidadMax").value);

  // Validar que los valores sean números y que min no sea mayor que max
  if (isNaN(min) || isNaN(max) || min < 0 || max < 0 || min > max) {
    alert("Por favor, ingrese valores válidos para la capacidad mínima y máxima.");
    return; // Detiene el proceso si la validación falla
  }

  // Crear el objeto de filtro
  let cantidades = {
    minCapacidad: min,
    maxCapacidad: max
  };

  // Inicializar el índice
  let index = 0;

  // Llamada al servicio para cargar salas por capacidad
  salaService
    .loadByCapacidad(min,max)
    .then((data) => {
      console.log("Salas listadas:", data);

      let tabla = document.getElementById("tbodySala");
      let txt = "";

      // Comprobar si hay resultados
      if (data.result && data.result.length > 0) {
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<td>" + (++index) + "</td>"; // Usar ++index para simplificar el incremento
          txt += "<td>" + element.numeroSala + "</td>";
          txt += "<td>" + element.capacidad + "</td>";
          txt += "<td>" + (element.estado === 1 
            ? "<i class='fas fa-circle text-success' title='Activo'></i>" 
            : "<i class='fas fa-circle text-danger' title='Desactivado'></i>") + "</td>";
          txt +=
            `<td><a href="http://localhost/SG_CINE_2024/public/sala/edit/${element.id}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>`;
          txt += "</tr>";
        });
      } else {
        // Si no hay resultados, mostrar un mensaje en la tabla
        txt = "<tr><td colspan='5'>No se encontraron salas.</td></tr>";
      }

      tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
    })
    .catch((error) => {
      console.error("Error al listar salas:", error);
    });
}



  ,

}

document.addEventListener("DOMContentLoaded",()=>{

    let btnAltaSala=document.getElementById("btnAltaSala");
    let btnListarSala=document.getElementById("btnListarSala")
    let btnPDFSala=document.getElementById("btnPDFSala")
    let btnEliminarSala=document.getElementById("btnEliminarSala")
    let btnModificarSala=document.getElementById("btnModificarSala")
    let btnBuscarSala=document.getElementById("btnBuscarSala");


    if(btnAltaSala!=null){
      salaController.list()
        btnAltaSala.onclick=salaController.save;
        btnListarSala.onclick=salaController.list
        btnPDFSala.onclick=salaController.print

        btnBuscarSala.addEventListener("click",function(){
          if(document.getElementById("filterType").value=="numero"){
    
            salaController.loadByNumeroSala()
    
          }else if(document.getElementById("filterType").value=="capacidad"){
    
            salaController.loadByCapacidad()
    
          }
          else if(document.getElementById("filterType").value=="estado"){
    
            salaController.loadByEstado()
    
        }
      
        })
      
    }
    else{
      btnEliminarSala.onclick=salaController.delete
      btnModificarSala.onclick=salaController.update
    }
  
})