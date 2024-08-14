let perfilController = {
    data: {
      id: 59,
      nombre: "",
    },
  
    save: () => {
      if (confirm("Quieres crear el perfil?")) {
        let perfilForm = document.forms["formPerfil"];
  
        if (perfilForm.nombrePerfil.value.length > 45) {
          alert("Nombre demasiado largo");
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
        perfilController.data.nombre =
          document.getElementById("nombrePerfil").value;
  
        perfilService
          .update(perfilController.data)
          .then((data) => {
            console.log("Actualizando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al actualizar el perfil: " + data.error);
            } else {
              alert("Perfil actualizado con éxito");
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
        console.log("Buscando perfiles...");
    
        perfilService.loadByName(nombre).then((data) => {

            if(data.error==""){

            console.log("Perfil encontrado:", data);
            
            let tabla = document.getElementById("tbodyPerfil");
            let txt = "";
    
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
    
            tabla.innerHTML = txt;
        }
        else{alert("El perfil no fue encontrado")}
    }
        )
        .catch((error) => {
            console.error("Error al buscar perfil:", error);
        });
    },
    
}
  
  document.addEventListener("DOMContentLoaded", () => {
    let btnPerfilAlta = document.getElementById("btnGuardarPerfil");
    let btnPerfilBuscar = document.getElementById("btnBuscarPerfil");
    let btnEliminarPerfiles = document.getElementById("btnEliminarPerfiles");
    let btnmodificarPerfil = document.getElementById("btnModificarPerfil");
    let btnPerfilLoad = document.getElementById("btnListarPerfil");
  
    if (btnPerfilAlta != null) {
      perfilController.list();
  
      btnPerfilAlta.addEventListener("click", function () {
        perfilController.save();
        perfilController.list();
      });
      btnPerfilBuscar.onclick = perfilController.loadByName;
      btnPerfilLoad.onclick = perfilController.list;
    } else if(btnmodificarPerfil!=null){
      
      btnmodificarPerfil.onclick = perfilController.update;
      btnEliminarPerfiles.onclick = perfilController.delete;
    }
  });