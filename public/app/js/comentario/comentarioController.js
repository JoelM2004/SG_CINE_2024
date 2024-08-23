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

    let usuarios = await singletonController.listUsuario();

    await comentarioService
      .list(parseInt(comentarioForm.dataset.idpelicula))
      .then((data) => {
        console.log("Comentarios listados:", data);

        let commentsList = document.getElementById("comments-list");
        let txt = ""; // Inicializamos la variable para construir el HTML dinámicamente

        data.result.forEach((element) => {
          // Construimos el HTML para cada comentario

          usuarios.forEach((elemento) => {
            if (element.usuarioId == elemento.id)
              nombreUsuario = elemento.cuenta;
          });

          txt += `
  <div class="comment mb-4 p-3 border rounded">
    <div class="d-flex justify-content-between">
      <h5>${nombreUsuario}</h5>
      <div>
        <button class="btn btn-sm btn-warning me-2" data-id="${element.id}" >Editar</button>
        <button class="btn btn-sm btn-danger" data-id="${element.id}">Eliminar</button>
      </div>
    </div>
    <p class="comment-text">${element.comentario}</p>
  </div>
`;
        });

        commentsList.innerHTML = txt; // Reemplazamos el contenido HTML de la lista de comentarios
      })
      .catch((error) => {
        console.error("Error al listar comentarios:", error);
      });
  },

  delete: () => {
    if (confirm("¿Quiere eliminar el comentario?")) {
      comentarioController.data.id = document.getElementById(
        "filaModificarPerfil"
      ).dataset.id;

      comentarioService
        .delete(comentarioController.data)
        .then((data) => {
          alert(data.mensaje); // Muestra el mensaje del servidor al usuario
        })
        .catch((error) => {
          console.error("Error al eliminar el comentario:", error);
          alert(
            "Hubo un problema al eliminar el comentario. Por favor, inténtelo de nuevo más tarde."+ error
          );
        });
    }
  },

  update: () => {
    if (confirm("¿Quieres editar tu comentario?")) {
        let comentarioForm = document.forms["comment-form"];
  
        comentarioController.data.usuarioId = parseInt(
          comentarioForm.dataset.iduser
        );
        comentarioController.data.peliculaId = parseInt(
          comentarioForm.dataset.idpelicula
        );
        comentarioController.data.comentario = comentarioForm.comment.value;

      comentarioService
        .update(comentarioController.data)
        .then((data) => {
          console.log("Actualizando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al actualizar el comentario: " + data.error);
          } else {
            alert("Perfil actualizado con éxito");
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al actualizar el comentario");
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
