let comentarioController = {
  data: {
    id: 0,
    usuarioId: 0,
    peliculaId: 0,
    comentario: "",
  },
  save: () => {
    if (confirm("¿Quieres dejar tu comentario?")) {
      let comentarioForm = document.forms["comment-form"];

      comentarioController.data.usuarioId = parseInt(
        comentarioForm.dataset.iduser
      );
      comentarioController.data.peliculaId = parseInt(
        comentarioForm.dataset.idpelicula
      );
      if(comentarioForm.comment.value<=0|| comentarioForm.comment.value>255){
        alert("Su comentario es muy largo, o está insertando texto vacío")
        return
      }
      comentarioController.data.comentario = comentarioForm.comment.value;

      // Guardar la función
      comentarioService
        .save(comentarioController.data)
        .then((data) => {
          console.log("Guardando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al guardar la comentario: " + data.error);
          } else {
            alert("comentario guardada con éxito");
            // Opcional: actualizar la lista o redirigir
            comentarioController.list();
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar la función");
        });
    }
  },

  list: async () => {
    console.log("Listando comentarios...");

    let comentarioForm = document.forms["comment-form"];

    // Obtener comentarios de la API
    let data = await comentarioService.list(parseInt(comentarioForm.dataset.idpelicula));
    console.log("Comentarios listados:", data);

    let commentsList = document.getElementById("comments-list");
    let txt = ""; // Inicializamos la variable para construir el HTML dinámicamente

    // Datos del usuario actual
    let idUser = parseInt(comentarioForm.dataset.iduser);
    let perfil = comentarioForm.dataset.perfil;

    console.log(perfil)

    // Verificar si hay comentarios
    if (data.result.length === 0) {
        txt = "<p class='text-center'>No hay comentarios</p>";
    } else {
        // Procesar cada comentario
        for (let element of data.result) {
            // Obtener información del usuario que hizo el comentario
            let usuarioData = await singletonController.loadUsuario(element.usuarioId);

            // Asegúrate de que `usuarioData` y `usuarioData.cuenta` existen antes de acceder a la propiedad `cuenta`
            let nombreUsuario = usuarioData?.cuenta || 'Usuario Desconocido';
          
            // Determinar si se debe mostrar el botón "Eliminar"
            let mostrar = ""
            if (usuarioData.id === idUser || perfil === "Administrador ") {
                mostrar = "visibility"; // Mostrar el botón
            } else {
                mostrar = "none"; // Ocultar el botón
            }

            // Construir el HTML para cada comentario
            txt += `
      <div class="comment mb-4 p-3 border rounded">
        <div class="d-flex justify-content-between align-items-center">
          <h5><i class="fas fa-user"></i> ${nombreUsuario}</h5>
          <div>
            <button class="btn btn-sm btn-danger eliminar" data-id="${element.id}" style="display: ${mostrar};">
              <i class="fas fa-trash-alt"></i> Eliminar
            </button>
          </div>
        </div>
        <p class="comment-text mt-2"><i class="fas fa-comment"></i> ${element.comentario}</p>
      </div>
    `;
        }
    }

    // Asignar el HTML construido a la lista de comentarios
    commentsList.innerHTML = txt;

    // Agregar eventos para los botones de eliminar
    document.querySelectorAll(".eliminar").forEach((button) => {
        button.addEventListener("click", () => {
            comentarioController.delete(button.dataset.id);
            comentarioController.list();
        });
    });
},


  
  

  delete: (id) => {
    if (confirm("¿Quiere eliminar el comentario?")) {
      comentarioController.data.id = id
      comentarioService
        .delete(comentarioController.data)
        .then((data) => {
          alert(data.mensaje); // Muestra el mensaje del servidor al usuario
        })
        .catch((error) => {
          console.error("Error al eliminar el comentario:", error);
          alert(
            "Hubo un problema al eliminar el comentario. Por favor, inténtelo de nuevo más tarde." +
              error
          );
        });
    }
  },

};



// Al cargar la página, llamamos al método list para cargar los comentarios
document.addEventListener("DOMContentLoaded", () => {
  let btnAltaComentario = document.getElementById("btnAltaComentario");

  comentarioController.list();
  btnAltaComentario.addEventListener("click", () => {
    comentarioController.save();
    comentarioController.list();
  });

  



});
