let perfilController = {
    data: {
      id: 0,
      nombre: "",
    },
  
    save: () => {
      if (confirm("Quieres crear el perfil?")) {
        let perfilForm = document.forms["formPerfil"];
  
        if (perfilForm.nombrePerfil.value.length > 45) {
          alert("Nombre demasiado largo");
          return
        } else {
          perfilController.data.nombre = perfilForm.nombrePerfil.value;
        }
  
        perfilService
          .save(perfilController.data)
          .then((data) => {
            console.log("Guardando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al guardar el perfil: " + data.error);
            } else {
              alert("Perfil guardado con éxito");
              // Opcional: actualizar la lista o redirigir
              perfilController.list();
            }
          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al guardar el perfil");
          });
      }
    },
  
    delete: () => {
      if (confirm("¿Quiere eliminar el perfil?")) {
        perfilController.data.id = document.getElementById(
          "filaModificarPerfil"
        ).dataset.id;
  
        perfilService
          .delete(perfilController.data)
          .then((data) => {
            alert(data.mensaje); // Muestra el mensaje del servidor al usuario
          })
          .catch((error) => {
            console.error("Error al eliminar el Perfil:", error);
            alert(
              "Hubo un problema al eliminar el Perfil. Por favor, inténtelo de nuevo más tarde."+ error
            );
          });
      }
    },
  
    update: () => {
      if (confirm("Quieres modificar el perfil?")) {
        perfilController.data.id = document.getElementById(
          "filaModificarPerfil"
        ).dataset.id;
        perfilController.data.id = parseInt(perfilController.data.id);
        perfilController.data.nombre = document.getElementById("nombrePerfil").value;
        
        if(perfilController.data.nombre.length>45){
          alert("Nombre demasiado largo");
          return
        }

        perfilService
          .update(perfilController.data)
          .then((data) => {
            console.log("Actualizando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al actualizar el perfil: " + data.error);
            } else {
              alert("Perfil actualizado con éxito");
              setTimeout(() => {
                location.reload();
              }, 300);
            }
          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al actualizar el perfil");
          });
      }
    },
  
    load: () => {
  
      const id= document.getElementById("filterNombrePerfil").value; // Suponiendo que tienes un input con este ID
      
      if(id<0||id==""){
  
        alert("Introduzca un valor válido")
  
      }else{
      
      perfilService
        .load(id)
        .then((data) => {
          console.log("Perfil listado:", data);
  
          // perfilController.data.id=data.data.id;
          // perfilController.data.nombre=data.data.nombre;
  
          if (data.error === "") {
            let tabla = document.getElementById("tbodyPerfil");
            let txt = "";
  
            txt += "<tr>";
            txt += "<th>" + 1 + "</th>";
            txt += "<td>" + data.result.nombre + "</td>"; //
            txt +=
              '<td><a href="http://localhost/SG_CINE_2024/public/perfil/edit/' +
              data.result.id +
              '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
            txt += "</tr>";
  
            tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
          } else {
            alert("Perfil no encontrado");
          }
        })
        .catch((error) => {
          console.error("Error al listar perfiles:", error);
        });
      }
  },
  
    list: () => {

    index=0;

      console.log("Listando perfiles...");
  
      perfilService
        .list()
        .then((data) => {
          console.log("Perfiles listados:", data);
          // Aquí podrías hacer algo con los datos, como actualizar una lista en la interfaz
          let tabla = document.getElementById("tbodyPerfil");
          let txt = "";
  
          data.result.forEach((element) => {
            txt += "<tr>";
            txt += "<th>" + (index=index+1) + "</th>";
            txt += "<td>" + element.nombre + "</td>"; //
            txt +=
              '<td><a href="http://localhost/SG_CINE_2024/public/perfil/edit/' +
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

    loadByName: () => {
        const nombre = document.getElementById("filterNombrePerfil").value; // Obtiene el nombre del campo input
        if(nombre.length<=0){
          alert("Inserte un perfil válido")
          return
        }

        console.log("Buscando perfiles...");

        let tabla = document.getElementById("tbodyPerfil");
            let txt = "";

        perfilService.loadByName(nombre).then((data) => {

            if(data.error==""){

            console.log("Perfil encontrado:", data);
            
            
    
            // Aquí se espera un solo objeto, no un array
            const perfil = data.result;
    
            if (perfil) {
                txt += "<tr>";
                txt += "<th>1</th>"; // Solo un perfil, por lo tanto, índice fijo en 1
                txt += "<td>" + perfil.nombre + "</td>";
                txt +=
                    '<td><a href="http://localhost/SG_CINE_2024/public/perfil/edit/' +
                    perfil.id +
                    '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                txt += "</tr>";
            } else {
                // Manejo si no se encuentra el perfil, puede ser opcional
                txt += "<tr><td colspan='3'>No se encontró el perfil.</td></tr>";
            }
    
            
        }
        else{txt = "<tr><td colspan='3' style='text-align: center;'>No se encontró el perfil.</td></tr>";}

        tabla.innerHTML = txt;
    }
    
    
        )
        .catch((error) => {
            console.error("Error al buscar perfil:", error);
        });
    },
    print: () => {
      const $elementoParaConvertir = document.getElementById("tablaPerfil"); // <-- Aquí puedes elegir cualquier elemento del DOM
  
      // Crear un contenedor temporal para añadir el título y la fecha
      const tempContainer = document.createElement("div");
  
      // Crear y añadir el título
      const title = document.createElement("h1");
      title.innerText = "Listado de Perfiles";
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
}
  
  document.addEventListener("DOMContentLoaded", () => {
    let btnPerfilAlta = document.getElementById("btnGuardarPerfil");
    let btnPerfilBuscar = document.getElementById("btnBuscarPerfil");
    let btnEliminarPerfiles = document.getElementById("btnEliminarPerfiles");
    let btnmodificarPerfil = document.getElementById("btnModificarPerfil");
    let btnPerfilLoad = document.getElementById("btnListarPerfil");
    let btnPDFPerfil=document.getElementById("btnPDFPerfil");
    if (btnPerfilAlta != null) {
      perfilController.list();
  
      btnPerfilAlta.addEventListener("click", function () {
        perfilController.save();
        perfilController.list();
      });
      btnPerfilBuscar.onclick = perfilController.loadByName;
      btnPerfilLoad.onclick = perfilController.list;
      btnPDFPerfil.onclick=perfilController.print
    } else if(btnmodificarPerfil!=null){
      
      btnmodificarPerfil.onclick = perfilController.update;
      btnEliminarPerfiles.onclick = perfilController.delete;
    }
  });