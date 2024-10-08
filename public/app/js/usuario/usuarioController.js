let userController = {
  data: {
    id: 0,
    apellido: "",
    nombres: "",
    cuenta: "",
    clave: "123456798",
    correo: "",
    perfilId: 0,
  },

  save: () => {
    if (confirm("¿Seguro que lo quieres guardar?")) {
      let form = document.forms["formUsuario"];

      if (form.apellidoUsuario.value.length > 45 ||form.apellidoUsuario.value.length <=0) {
        alert("Supero el limite de caracteres con su apellido o el campo se encuentra vacío");
        return
      } else {
        userController.data.apellido = form.apellidoUsuario.value;
      }

      if (form.nombreUsuario.value.length > 45||form.nombreUsuario.value.length <=0) {
        alert("Supero el limite de caracteres con su nombre o el campo se encuentra vacío")
        return
      } else {
        userController.data.nombres = form.nombreUsuario.value;
      }

      if (form.cuentaUsuario.value.length > 45 ||form.cuentaUsuario.value.length <=0) {
        alert("Supero el limite de caracteres con su cuenta o el campo se encuentra vacío");return
      } else {
        userController.data.cuenta = form.cuentaUsuario.value;
      }

      if (
        form.claveUsuario.value.length > 6 &&
        form.claveUsuario.value.length < 45
      ) {
        userController.data.clave = form.claveUsuario.value;
      } else {
        alert("Su clave es demasiado corta o muy largo (7 a 44 caracteres)");return
      }

      if (form.correoUsuario.value.length > 255 ||form.correoUsuario.value.length <=0) {
        alert("El correo es muy largo o el campo se encuentra vacío");return
      } else {
        userController.data.correo = form.correoUsuario.value;
      }

      userController.data.perfilId = form.tipoPerfil.value;
      userController.data.perfilId = parseInt(userController.data.perfilId);

      userService
        .save(userController.data)
        .then((data) => {
          console.log("Guardando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al guardar el user: " + data.error);
          } else {
            alert("user guardado con éxito");
            setTimeout(() => {
              location.reload();
            }, 300);
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al guardar el user");
        });
    }
  },

  delete: () => {
    if (confirm("¿Seguro que quieres eliminar al Usuario?")) {
      userController.data.id = parseInt(document.getElementById(
        "filaModificarUsuario"
      ).dataset.id);

      userService
        .delete(userController.data)
        .then((data) => {
          alert(data.mensaje);
          setTimeout(() => {
            location.reload();
        }, 300);
        })
        .catch((error) => {
          // Maneja cualquier error que ocurra durante el cambio de contraseña
          console.error("Error al eliminar el Usuario:",error);
          alert(
            "Hubo un problema al eliminar el Usuario. Por favor, inténtelo de nuevo más tarde."+ error
          );
        });
    }
  },

  loadByNameAccount: () => {
    const nombre = document.getElementById("filterNombreCuenta").value;
    let txt = "";
    let index = 0; // Inicializa el índice

    console.log("Buscando Usuarios...");
    let tabla = document.getElementById("tbodyUsuario");

    userService
        .loadByNameAccount(nombre)
        .then((data) => {
            // Verificar si no se encontraron usuarios
            if (data.result.length === 0) {
                txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron Usuarios.</td></tr>";
                tabla.innerHTML = txt;
                return;
            }

            // Si no hay error y se encontraron usuarios
            if (data.error === "") {
                console.log("Usuario encontrado:", data);

                data.result.forEach((element) => {
                    txt += "<tr>";
                    txt += "<th>" + (++index) + "</th>"; // Incrementa el índice correctamente
                    txt += "<td>" + element.cuenta + "</td>";
                    txt += "<td>" + element.nombres + "</td>";
                    txt += "<td>" + element.apellido + "</td>";
                    txt += "<td>" + element.correo + "</td>";

                    let perfil = element.perfil; // Utiliza directamente el perfil
                    txt += "<td>" + perfil + "</td>";

                    // Botón de edición
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/usuario/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });

                // Actualiza el contenido HTML de la tabla
                tabla.innerHTML = txt;
            }
        })
        .catch((error) => {
            console.error("Error al listar Usuarios:", error);
        });
},


  update: () => {
    if (confirm("¿Seguro que lo quieres actualizar?")) {
      let form = document.forms["formUsuarioM"];
      userController.data.id = document.getElementById(
        "filaModificarUsuario"
      ).dataset.id;
      userController.data.id = parseInt(userController.data.id);

      userController.data.apellido = form.apellidoUsuarioM.value;
      userController.data.nombres = form.nombreUsuarioM.value;
      userController.data.cuenta = form.cuentaUsuarioM.value;
      userController.data.correo = form.correoUsuarioM.value;

      if (form.apellidoUsuarioM.value.length > 45||form.apellidoUsuarioM.value.length <=0 ) {
        alert("Supero el limite de caracteres con su apellido o el campo se encuentra vacío");
        return
      } else {
        userController.data.apellido = form.apellidoUsuarioM.value;
      }

      if (form.nombreUsuarioM.value.length > 45 ||form.nombreUsuarioM.value.length <=0 ) {
        alert("Supero el limite de caracteres con su nombre o el campo se encuentra vacío");return
      } else {
        userController.data.nombres = form.nombreUsuarioM.value;
      }

      if (form.cuentaUsuarioM.value.length > 45 || form.cuentaUsuarioM.value.length <=0) {
        alert("Supero el limite de caracteres con su cuenta o el campo se encuentra vacío");return
      } else {
        userController.data.cuenta = form.cuentaUsuarioM.value;
      }

      if (form.correoUsuarioM.value.length > 255 || form.correoUsuarioM.value.length <=0) {
        alert("El correo es muy largo o el campo se encuentra vacío");return
      } else {
        userController.data.correo = form.correoUsuarioM.value;
      }

      userController.data.perfilId = form.tipoPerfilUsuarioM.value;
      userController.data.perfilId = parseInt(userController.data.perfilId);

      userService
        .update(userController.data)
        .then((data) => {
          console.log("Actualizando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al actualizar el user: " + data.error);
          } else {
            alert("user actualizado con éxito");
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

  list:  () => {
    console.log("Listando Usuarios...");
    
    index = 0;
    userService
      .list()
      .then((data) => {
        console.log("Usuarios listados:", data);
        let tabla = document.getElementById("tbodyUsuario");
        let txt = "";

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.cuenta + "</td>";
          txt += "<td>" + element.nombres + "</td>";
          txt += "<td>" + element.apellido + "</td>";
          txt += "<td>" + element.correo + "</td>";

          let txts;
          txts = element.perfil;
          

          // let perfil = perfiles.find(p => p.id === element.perfilId);
          // let txtAux = perfil ? perfil.nombre : "Desconocido";

          txt += "<td>" + txts + "</td>";
          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/usuario/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },


  dataPass:{
    id:0,
    actual:"",
    nueva:""

  }

  ,

  changePassword: () => {
    if (confirm("¿Seguro que quieres cambiar la contraseña del Usuario?")) {

      let form=document.forms["change-password-form"];

      userController.dataPass.id = parseInt(document.getElementById("profile").dataset.id);
      
      if(form.claveActual.value.length>6 && form.claveActual.value.length<45){userController.dataPass.actual = form.claveActual.value}
      else{alert("Su clave actual es demasiado corta o muy largo (7 a 44 caracteres)")
        return
      }


      if (
        form.claveNueva.value.length > 6 &&
        form.claveNueva.value.length < 45
        && form.claveNueva.value==form.claveConfirmacion.value
      ) {
        userController.dataPass.nueva = form.claveConfirmacion.value
      } else {
        alert("Su clave nueva es demasiado corta o muy largo (7 a 44 caracteres) o no coincide con la verificación solicitada" );
        return
      }

        userService
          .changePassword(userController.dataPass)
          .then((data) => {
            if (data.error =="") {
              alert("Contraseña cambiada con éxito.");
          } else {
              alert(data.error);
          }
          })
          .catch((error) => {
            // Maneja cualquier error que ocurra durante el cambio de contraseña
            // console.error("Error al cambiar la contraseña:", error);
            alert(
              "Hubo un problema al cambiar la contraseña. Por favor, inténtelo de nuevo más tarde."
            );
          });
      

    }
  },

  print: () => {
    const $elementoParaConvertir = document.getElementById("tablaUsuario"); // <-- Aquí puedes elegir cualquier elemento del DOM

    // Crear un contenedor temporal para añadir el título y la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título
    const title = document.createElement("h1");
    title.innerText = "Listado de Usuarios";
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

  loadByPerfil: () => {
    console.log("Listando Usuarios...");
    let tabla = document.getElementById("tbodyUsuario");
    let index = 0; // Inicializa el índice correctamente
    let txt = ""; // Asegura la inicialización de txt

    userService
        .loadByPerfil(document.getElementById("filterTipoPerfil").value)
        .then((data) => {
            // Verificar si no se encontraron usuarios
            if (data.result.length === 0) {
                txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron Usuarios.</td></tr>";
                tabla.innerHTML = txt;
                return;
            }

            // Si no hay error y se encontraron usuarios
            if (data.error === "") {
                console.log("Usuario encontrado:", data);

                data.result.forEach((element) => {
                    txt += "<tr>";
                    txt += "<th>" + (++index) + "</th>"; // Incrementa el índice correctamente
                    txt += "<td>" + element.cuenta + "</td>";
                    txt += "<td>" + element.nombres + "</td>";
                    txt += "<td>" + element.apellido + "</td>";
                    txt += "<td>" + element.correo + "</td>";

                    let perfil = element.perfil; // Utiliza directamente el perfil
                    txt += "<td>" + perfil + "</td>";

                    // Botón de edición
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/usuario/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });

                // Actualiza el contenido HTML de la tabla
                tabla.innerHTML = txt;
            } else {
                console.error("Error en la respuesta:", data.error);
            }
        })
        .catch((error) => {
            console.error("Error al listar Usuarios:", error);
        });
},



};

document.addEventListener("DOMContentLoaded", () => {
  let btnUsuarioAlta = document.getElementById("btnAltaUsuario");
  let btnEliminarUsuarios = document.getElementById("btnEliminarUsuarios");
  let btnUsuarioListar = document.getElementById("btnListarUsuario");
  let modificarUsuario = document.getElementById("btnModificarUsuario");
  let btnBuscarUsuario=document.getElementById("btnBuscarUsuario")
  let imprimirUsuarios = document.getElementById("btnImprimirUsuario");
  let btnChangePassword = document.getElementById("btnChangePassword");

  if (btnUsuarioAlta != null) {
    userController.list();

    btnUsuarioAlta.addEventListener("click", function () {
      userController.save();
    });

    btnBuscarUsuario.addEventListener("click",function(){
      if(document.getElementById("filterType").value=="cuenta"){

        userController.loadByNameAccount()

      }else if(document.getElementById("filterType").value=="perfil"){

        userController.loadByPerfil()

      }
    })


    


    imprimirUsuarios.onclick=userController.print
    btnUsuarioListar.onclick = userController.list;
  } else if (modificarUsuario != null) {
    modificarUsuario.onclick = userController.update;
    btnEliminarUsuarios.onclick = userController.delete;
    // btnUsuarioListar.onclick=userController.list;
  } else {
    if(btnChangePassword!=null){

      btnChangePassword.onclick=userController.changePassword

    }
  }
});
