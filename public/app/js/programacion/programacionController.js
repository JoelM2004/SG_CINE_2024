let programacionController = {
    data: {
      id: 0,
      fechaInicio: "mercado",
      fechaFin: "joel",
      vigente: 0
        
    },
    save: () => {
        if (confirm("¿Seguro que lo quieres guardar?")) {
          let form = document.forms["formProgramacion"];
      
          const fechaInicio = new Date(form.fechaInicio.value);
          const fechaFin = new Date(form.fechaFin.value);
      
          if (fechaInicio && fechaFin && fechaInicio <= fechaFin) {
            programacionController.data.fechaInicio = form.fechaInicio.value;
            programacionController.data.fechaFin = form.fechaFin.value;
          } else {
            alert("Ingrese fechas válidas y asegúrese de que la fecha de inicio sea menor o igual a la fecha de fin.");
            return;
          }
      
          programacionController.data.vigente = parseInt(form.vigente.value);
      
          programacionService.save(programacionController.data)
            .then((data) => {
              console.log("Guardando Datos");
              if (data.error !== "") {
                alert("Error al guardar la programación: " + data.error);
              } else {
                alert("Programación guardada con éxito");
                programacionController.list(); // Actualiza la lista después de guardar
              }
            })
            .catch((error) => {
              console.error("Error en la Petición ", error);
              alert("Ocurrió un error al guardar la programación");
            });
        }
      },
      
  
    delete: () => {
      if (confirm("¿Seguro que lo quieres elimnar?")) {
        programacionController.data.id = document.getElementById(
          "filaModificarProgramacion"
        ).dataset.id;
  
        programacionService.delete(programacionController.data).then((data)=>{
          alert(data.mensaje)
          setTimeout(() => {
            location.reload();
        }, 300);
        }).catch((error) => {
          // Maneja cualquier error que ocurra durante el cambio de contraseña
          console.error('Error al eliminar la programación:', error);
          alert('Hubo un problema al eliminar la programación. Por favor, inténtelo de nuevo más tarde.'+error);
        });
        
  
      }
    },
  
    update: () => {
      if (confirm("¿Seguro que lo quieres actualizar?")) {
        let form = document.forms["formProgramacionM"];
        programacionController.data.id = document.getElementById(
          "filaModificarProgramacion"
        ).dataset.id;
        programacionController.data.id = parseInt(programacionController.data.id);
    
        // Obtener los valores del formulario
        programacionController.data.fechaInicio = form.fechaInicioM.value;
        programacionController.data.fechaFin = form.fechaFinM.value;
        programacionController.data.vigente = form.vigenteM.value;
    
        // Validar fechas
        const fechaInicio = new Date(form.fechaInicioM.value);
        const fechaFin = new Date(form.fechaFinM.value);
    
        if (!fechaInicio || !fechaFin || fechaInicio > fechaFin) {
          alert("Ingrese fechas válidas y asegúrese de que la fecha de inicio sea menor o igual a la fecha de fin.");
          return;
        }
    
        // Validar que 'vigente' sea un número entero
        programacionController.data.vigente = parseInt(form.vigenteM.value);
        if (isNaN(programacionController.data.vigente)) {
          alert("El valor de 'vigente' debe ser un número entero.");
          return;
        }
    
        // Enviar la solicitud al servicio
        programacionService.update(programacionController.data)
          .then((data) => {
            console.log("Actualizando Datos");
            if (data.error !== "") {
              alert("Error al actualizar la programación: " + data.error);
            } else {
              alert("Programación actualizada con éxito");
              setTimeout(() => {
                location.reload();
              }, 300);
            }
          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al actualizar la programación");
          });
      }
    }
,    
  
    list: () => {
        index = 0;
    
        console.log("Listando Programaciones...");
    
        programacionService
            .list()
            .then((data) => {
                console.log("Programaciones listadas:", data);
    
    
                let tabla = document.getElementById("tbodyProgramacion");
                let txt = "";
    
                data.result.forEach((element) => {
                    txt += "<tr>";
                    txt += "<th>" + (index = index + 1) + "</th>";
                    txt += "<td>" + formatDate(element.fechaInicio) + "</td>";
                    txt += "<td>" + formatDate(element.fechaFin) + "</td>";
    
                    if (element.vigente === 1) {
                        txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
                    } else {
                        txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
                    }
    
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/programacion/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });
    
                tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
            })
            .catch((error) => {
                console.error("Error al listar perfiles:", error);
            });
    },
    
    loadByVigencia: () => {
        index = 0;
    
        console.log("Listando Programaciones...");
    
        programacionService
            .loadByVigencia(document.getElementById("filterVigente").value)
            .then((data) => {
                console.log("Programaciones listadas:", data);
    
                
    
                let tabla = document.getElementById("tbodyProgramacion");
                let txt = "";


                if(data.result.length>0){

                data.result.forEach((element) => {
                    txt += "<tr>";
                    txt += "<th>" + (index = index + 1) + "</th>";
                    txt += "<td>" + formatDate(element.fechaInicio) + "</td>";
                    txt += "<td>" + formatDate(element.fechaFin) + "</td>";
    
                    if (element.vigente == 1) {
                        txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
                    } else {
                        txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
                    }
    
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/programacion/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });}else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron programaciones.</td></tr>";}
    
                tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
            })
            .catch((error) => {
                console.error("Error al listar perfiles:", error);
            });
    },

    loadByFecha: () => {
      let index = 0;
    
      console.log("Listando Programaciones...");
    
      // Obtener los valores de las fechas de inicio y fin
      let fechaInicio = document.getElementById("fechaInicioFilter").value;
      let fechaFin = document.getElementById("fechaFinFilter").value;
      
      if(fechaFin=="" || fechaInicio==""){
        alert("Ingrese valores en los calendarios")
        return
      }

      // Validar que la fecha de inicio no sea superior a la de fin
      if (fechaInicio > fechaFin) {
          alert("La fecha de inicio no puede ser superior a la fecha de fin");
          return;
      }
      
      // Llamada al servicio para cargar las programaciones por fecha
      programacionService
          .loadByFecha(fechaInicio, fechaFin)
          .then((data) => {
              console.log("Programaciones listadas:", data);
    
              // Obtener la tabla donde se mostrará el resultado
              let tabla = document.getElementById("tbodyProgramacion");
              let txt = "";
    
              // Verificar si se encontraron programaciones
              if (data.result.length > 0) {
                  data.result.forEach((element) => {
                      txt += "<tr>";
                      txt += "<th>" + (++index) + "</th>"; // Incrementar el índice en cada iteración
                      txt += "<td>" + formatDate(element.fechaInicio) + "</td>";
                      txt += "<td>" + formatDate(element.fechaFin) + "</td>";
    
                      // Mostrar si la programación está vigente o no
                      if (element.vigente == 1) {
                          txt += "<td><i class='fas fa-circle text-success' title='Activo'></i></td>";
                      } else {
                          txt += "<td><i class='fas fa-circle text-danger' title='Desactivado'></i></td>";
                      }
    
                      // Agregar botón de edición
                      txt += '<td><a href="http://localhost/SG_CINE_2024/public/programacion/edit/' +
                          element.id +
                          '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                      txt += "</tr>";
                  });
              } else {
                  // Mostrar mensaje si no hay programaciones
                  txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron programaciones.</td></tr>";
              }
    
              // Actualizar el contenido de la tabla
              tabla.innerHTML = txt;
          })
          .catch((error) => {
              console.error("Error al listar programaciones:", error);
          });
  }
,  

    print:()=> {
      const $elementoParaConvertir = document.getElementById("tablaProgramacion"); // <-- Aquí puedes elegir cualquier elemento del DOM
    
      // Crear un contenedor temporal para añadir el título y la fecha
      const tempContainer = document.createElement('div');
    
      // Crear y añadir el título
      const title = document.createElement('h1');
      title.innerText = 'Listado de Programaciones';
      tempContainer.appendChild(title);
    
      // Crear y añadir la fecha de emisión
      const date = document.createElement('p');
      const today = new Date();
      date.innerText = 'Fecha de emisión del reporte: ' + today.toLocaleDateString();
      tempContainer.appendChild(date);
    
      // Clonar el elemento a convertir y añadirlo al contenedor temporal
      const clonedElement = $elementoParaConvertir.cloneNode(true);
      tempContainer.appendChild(clonedElement);
    
      // Eliminar la última columna
      const rows = clonedElement.querySelectorAll('tr');
      rows.forEach(row => {
        const cells = row.querySelectorAll('td, th');
        if (cells.length > 0) {
          cells[cells.length - 1].parentNode.removeChild(cells[cells.length - 1]);
        }
      });
    
      // Aplicar estilo al contenedor temporal para evitar problemas de renderizado
      tempContainer.style.fontFamily = 'Arial, sans-serif';
      tempContainer.style.width = '100%';
      tempContainer.style.overflow = 'hidden';
    
      // Aplicar estilo a la tabla para ajustarla al tamaño del PDF
      const tables = tempContainer.getElementsByTagName('table');
      for (let table of tables) {
        table.style.width = '100%'; // Ajustar el ancho de la tabla al 100%
        table.style.tableLayout = "auto"; // Opcional: esto hace que las celdas tengan un ancho fijo
      }
    
      // Ajustar el tamaño de las celdas de la tabla
      const tableCells = tempContainer.getElementsByTagName('td');
      for (let cell of tableCells) {
        cell.style.fontSize = '10px'; // Reducir el tamaño de la fuente en las celdas
        cell.style.padding = '1px'; // Reducir el padding en las celdas
      }
    
      const tableCellsth = tempContainer.getElementsByTagName('th');
      for (let cell of tableCellsth) {
        cell.style.fontSize = '10px'; // Reducir el tamaño de la fuente en las celdas
        cell.style.padding = '1px'; // Reducir el padding en las celdas
      }
    
      html2pdf()
          .from(tempContainer)
          .set({
              margin: 1,
              filename: 'venta.pdf',
              image: {
                  type: 'jpeg',
                  quality: 0.98
              },
              html2canvas: {
                  scale: 4, // A mayor escala, mejores gráficos, pero más peso
                  letterRendering: true,
              },
              jsPDF: {
                  unit: "in",
                  format: "a4",
                  orientation: 'landscape' // landscape o portrait
              }
          })
          .outputPdf('blob')
          .then(function (pdfBlob) {
              var blobUrl = URL.createObjectURL(pdfBlob);
              window.open(blobUrl, '_blank');
          })
          .catch(err => console.log(err));
    }
  
  
  
  }
  // Función para formatear la fecha
  const formatDate = (dateString) => {
    const [year, month, day] = dateString.split("-");
    return `${day}/${month}/${year}`;
};
  document.addEventListener("DOMContentLoaded", () => {
    
    let btnAltaProgramacion= document.getElementById("btnAltaProgramacion");
    let btnListarProgramacion= document.getElementById("btnListarProgramacion")
    let btnPDFProgramacion=document.getElementById("btnPDFProgramacion")
    let btnEliminarProgramacion=document.getElementById("btnEliminarProgramacion")
    let btnModificarProgramacion=document.getElementById("btnModificarProgramacion")
    let btnBuscarProgramacion=document.getElementById("btnBuscarProgramacion")


    if (btnAltaProgramacion != null) {
      programacionController.list();
  
      btnAltaProgramacion.addEventListener("click",function(){
        programacionController.save()
        programacionController.list()
      })
  
      btnPDFProgramacion.onclick=programacionController.print
      btnListarProgramacion.onclick = programacionController.list;

      btnBuscarProgramacion.addEventListener("click", function () {
        if (document.getElementById("filterType").value == "vigente") {
          programacionController.loadByVigencia();
        } else if (
          document.getElementById("filterType").value == "fechaRango"
        ) {
          programacionController.loadByFecha();
        } 
      });

    } else if(btnEliminarProgramacion!=null) {
        btnEliminarProgramacion.onclick=programacionController.delete;
        btnModificarProgramacion.onclick=programacionController.update;
    }
  });