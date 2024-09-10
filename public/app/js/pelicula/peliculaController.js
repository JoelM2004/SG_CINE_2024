let peliculaController = {
  data: {
    id: 0,
    nombre: "",
    tituloOriginal: "",
    duracion: 0,
    anoEstreno: 0,
    disponibilidad: 0,
    fechaIngreso: "",
    sitioWebOficial: "",
    sinopsis: "",
    actores: "",
    generoId: 0,
    idiomaId: 0,
    calificacionId: 0,
    tipoId: 0,
    audioId: 0,
  },

  save: () => {
    if (confirm("¿Seguro que quieres guardar la película?")) {
      let form = document.forms["formPelicula"];

      if (form.nombre.value.length > 255) {
        alert("Superaste el límite de caracteres en el nombre.");return
      } else {
        peliculaController.data.nombre = form.nombre.value;
      }

      if (form.tituloOriginal.value.length > 255) {
        alert("Superaste el límite de caracteres en el título original.");return
      } else {
        peliculaController.data.tituloOriginal = form.tituloOriginal.value;
      }

      if (form.duracion.value <= 0) {
        alert("La duración debe ser mayor a 0.");return
      } else {
        peliculaController.data.duracion = parseInt(form.duracion.value);
      }

      if (form.sinopsis.value.length > 1000) {
        alert("Superaste el límite de caracteres para la sinopsis");return
      } else {
        peliculaController.data.sinopsis = form.sinopsis.value;
      }

      if (form.actores.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");return
      } else {
        peliculaController.data.actores = form.actores.value;
      }

      if (form.sitioWeb.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");return
      } else {
        peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      }

      if (form.anioEstreno.value.length != 4) {
        alert("El año de estreno debe tener 4 dígitos.");return
      } else {
        peliculaController.data.anoEstreno = parseInt(form.anioEstreno.value);
      }

      peliculaController.data.disponibilidad = parseInt(
        form.disponibilidad.value
      );
      peliculaController.data.fechaIngreso = form.fechaIngreso.value;
      peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      peliculaController.data.sinopsis = form.sinopsis.value;
      peliculaController.data.actores = form.actores.value;
      peliculaController.data.paisId = parseInt(form.pais.value);
      peliculaController.data.generoId = parseInt(form.genero.value);
      peliculaController.data.idiomaId = parseInt(form.idioma.value);
      peliculaController.data.calificacionId = parseInt(form.calificacion.value);
      peliculaController.data.tipoId = parseInt(form.tipo.value);
      peliculaController.data.audioId = parseInt(form.audio.value);

      peliculaService
        .save(peliculaController.data)
        .then((data) => {
          console.log("Guardando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al guardar la película: " + data.error);
          } else {
            alert("película guardada con éxito");
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

  update: () => {
    if (confirm("¿Seguro que lo quieres actualizar?")) {
      let form = document.forms["formPeliculaM"];
      peliculaController.data.id = document.getElementById(
        "borrarPelicula"
      ).dataset.id;
      peliculaController.data.nombre = form.nombre.value;
      peliculaController.data.disponibilidad=parseInt(form.disponibilidad.value)
      peliculaController.data.tituloOriginal = form.tituloOriginal.value;
      peliculaController.data.id = parseInt(peliculaController.data.id);
      peliculaController.data.duracion = parseInt(form.duracion.value);
      peliculaController.data.anoEstreno = parseInt(form.anioEstreno.value);
      peliculaController.data.fechaIngreso = form.fechaIngreso.value;
      peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      peliculaController.data.sinopsis = form.sinopsis.value;
      peliculaController.data.actores = form.actores.value;
      peliculaController.data.paisId = parseInt(form.pais.value);
      peliculaController.data.generoId = parseInt(form.genero.value);
      peliculaController.data.idiomaId = parseInt(form.idioma.value);
      peliculaController.data.calificacionId = parseInt(form.calificacion.value);
      peliculaController.data.tipoId = parseInt(form.tipo.value);
      peliculaController.data.audioId = parseInt(form.audio.value);

      if (form.nombre.value.length > 255) {
        alert("Superaste el límite de caracteres en el nombre.");
        return
      } else {
        peliculaController.data.nombre = form.nombre.value;
      }

      if (form.tituloOriginal.value.length > 255) {
        alert("Superaste el límite de caracteres en el título original.");
        return
      } else {
        peliculaController.data.tituloOriginal = form.tituloOriginal.value;
      }

      if (form.duracion.value <= 0) {
        alert("La duración debe ser mayor a 0.");
        return
      } else {
        peliculaController.data.duracion = parseInt(form.duracion.value);
      }

      if (form.sinopsis.value.length > 1000) {
        alert("Superaste el límite de caracteres para la sinopsis");
        return
      } else {
        peliculaController.data.sinopsis = form.sinopsis.value;
      }

      if (form.actores.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
        return
      } else {
        peliculaController.data.actores = form.actores.value;
      }

      if (form.sitioWeb.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
        return
      } else {
        peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      }

      if (form.anioEstreno.value.length != 4) {
        alert("El año de estreno debe tener 4 dígitos.");
        return
      } else {
        peliculaController.data.anoEstreno = parseInt(form.anioEstreno.value);
      }

      peliculaService
        .update(peliculaController.data)
        .then((data) => {
          console.log("Actualizando Datos");
          // Aquí puedes manejar la respuesta
          if (data.error !== "") {
            alert("Error al actualizar el película: " + data.error);
          } else {
            alert("película actualizada con éxito");
            setTimeout(() => {
              location.reload();
            }, 300);
          }
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          alert("Ocurrió un error al actualizar la película");
        });
    }
  },
 
  print: () => {
    const $elementoParaConvertir = document.getElementById("tablaPelicula"); // <-- Aquí puedes elegir cualquier elemento del DOM

    // Crear un contenedor temporal para añadir el título y la fecha
    const tempContainer = document.createElement("div");

    // Crear y añadir el título
    const title = document.createElement("h1");
    title.innerText = "Listado de Películas";
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
  list: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    index = 0;
    await peliculaService
      .list()
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
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
  delete: () => {
    if (confirm("¿Quiere eliminar la película?")) {
      peliculaController.data.id = document.getElementById(
        "borrarPelicula"
      ).dataset.id;

      peliculaService
        .delete(peliculaController.data)
        .then((data) => {
          alert(data.mensaje); // Muestra el mensaje del servidor al usuario
          setTimeout(() => {
            location.reload();
        }, 300);
        })
        .catch((error) => {
          console.error("Error al eliminar la película:", error);
          alert(
            "Hubo un problema al eliminar la película. Por favor, inténtelo de nuevo más tarde." +
              error
          );
        });
    }
  },

  loadByGenero: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    index = 0;
    await peliculaService
      .loadByGenero(document.getElementById("filterGeneroInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        if(data.result.length>0){
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        })
      } else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron películas.</td></tr>";}
        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      })
  },

  loadByPais: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    index = 0;
    await peliculaService
      .loadByPais(document.getElementById("filterPaisInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        if(data.result.length>0){
        // Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        });
      }else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron películas.</td></tr>";}
        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },

  loadByIdioma: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    index = 0;
    await peliculaService
      .loadByIdioma(document.getElementById("filterIdiomaInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        if(data.result.length>0){// Obtener la lista de perfiles
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        })}
        else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron películas.</td></tr>";}
        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },

  loadByCalificacion: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    index = 0;
    await peliculaService
      .loadByCalificacion(document.getElementById("filterCalificacionInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        if(data.result.length>0){
        data.result.forEach((element) => {
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        })}
        else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron películas.</td></tr>"}

        tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },

  loadByNombrePelicula: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    if(document.getElementById("filterTituloInput").value.length<=0){
      alert("Inserte un título válido")
      return
    }

    index = 0;
    await peliculaService
      .loadByNombrePelicula(document.getElementById("filterTituloInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        element=data.result
        
        if(data.error===""){

        
        // Obtener la lista de perfiles
          txt += "<tr>";
          txt += "<th>" + (index = index + 1) + "</th>";
          txt += "<td>" + element.nombre + "</td>";
          txt += "<td>" + element.duracion + "</td>";
          txt += "<td>" + element.anoEstreno + "</td>";

          if (element.disponibilidad === 1) {
            txt +=
              "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
          } else {
            txt +=
              "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
          }

          txt += "<td>" + formatDate(element.fechaIngreso) + "</td>";

          generos.forEach((elemento) => {
            if (elemento.id == element.generoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          paises.forEach((elemento) => {
            if (elemento.id == element.paisId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          idiomas.forEach((elemento) => {
            if (elemento.id == element.idiomaId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          calificaciones.forEach((elemento) => {
            if (elemento.id == element.calificacionId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          tipos.forEach((elemento) => {
            if (elemento.id == element.tipoId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          audios.forEach((elemento) => {
            if (elemento.id == element.audioId)
              txt += "<td>" + elemento.nombre + "</td>";
          });

          txt +=
            '<td><a href="http://localhost/SG_CINE_2024/public/pelicula/edit/' +
            element.id +
            '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
          txt += "</tr>";
        }else{ txt = "<tr><td colspan='15' style='text-align: center;'>No se encontraron películas.</td></tr>";}


          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },

  listImagenes: async () => {
    // Llama a la función del controlador para obtener las imágenes
    const peliculaId = parseInt(document.getElementById("borrarPelicula").dataset.id);
    const imagenes = await singletonController.listImagenes(peliculaId);

    // Selecciona el contenedor del carrusel
    const carouselInner = document.querySelector("#carruselFotos .carousel-inner");

    // Limpiar contenido previo (si hay)
    carouselInner.innerHTML = '';

    // Verifica si hay imágenes
    if (imagenes.length > 0) {
        imagenes.forEach((imgSrc, index) => {
            // Crea un div para cada imagen
            const carouselItem = document.createElement('div');
            carouselItem.className = 'carousel-item';
            if (index === 0) {
                // Establece la primera imagen como activa
                carouselItem.classList.add('active');
            }
            // Crea la etiqueta de imagen
            const imgElement = document.createElement('img');

            
            imgElement.src = imgSrc.imagen;
            imgElement.className = 'd-block w-100';
            imgElement.alt = 'Imagen de la película';

            // Crear botones para borrar y actualizar con dataset-id
            const buttonContainer = document.createElement('div');
            buttonContainer.style.position = 'absolute';
            buttonContainer.style.top = '10px';
            buttonContainer.style.right = '10px';
            buttonContainer.style.zIndex = '10';

            // Crear botón de borrar
            const deleteButton = document.createElement('button');
            deleteButton.innerText = 'Borrar';
            deleteButton.className = 'btn btn-danger';
            deleteButton.dataset.id = imgSrc.id; // Asignar el id de la imagen
            deleteButton.onclick = () => {
                peliculaController.deleteImagen(imgSrc.id); // Llamar a deleteImagen con el id de la imagen
            };

            // Crear botón de actualizar
            const updateButton = document.createElement('button');
            updateButton.innerText = 'Seleccionar como Portada';
            updateButton.className = 'btn btn-primary ml-2';
            updateButton.dataset.id = imgSrc.id; // Asignar el id de la imagen
            updateButton.dataset.peliculaId = imgSrc.peliculaId; // Asignar el id de la imagen
            updateButton.onclick = () => {
                peliculaController.updateImagen(imgSrc.id,imgSrc.peliculaId)
            };

            // Agregar botones al contenedor
            buttonContainer.appendChild(deleteButton);
            buttonContainer.appendChild(updateButton);

            // Agregar el contenedor de botones y la imagen al div del carrusel
            carouselItem.appendChild(buttonContainer);
            carouselItem.appendChild(imgElement);

            // Agregar el div al carrusel
            carouselInner.appendChild(carouselItem);
        });
    } 
}
,
deleteImagen: (id) => {
  if (confirm("¿Quiere eliminar la imagen?")) {
      imagenController.data.id = id; // Asignar el id de la imagen al objeto data

      imagenService
          .delete(imagenController.data)
          .then((data) => {
              alert(data.mensaje); // Muestra el mensaje del servidor al usuario
              setTimeout(() => {
                location.reload();
              }, 300);
          })
          .catch((error) => {
              console.error("Error al eliminar la imagen:", error);
              alert(
                  "Hubo un problema al eliminar la imagen. Por favor, inténtelo de nuevo más tarde." +
                  error
              );
          });
  }
}

,
updateImagen: (id,peliculaId) => {
  if (confirm("¿Quiere establecer esta imagen como portada?")) {
      imagenController.data.id = id; // Asignar el id de la imagen al objeto data
      imagenController.data.peliculaId = peliculaId; // Asignar el id de la imagen al objeto data

      imagenService
          .update(imagenController.data)
          .then((data) => {
              alert(data.mensaje); // Muestra el mensaje del servidor al usuario
             setTimeout(() => {
               location.reload();
             }, 300); 
          })
          .catch((error) => {
              console.error("Error al establecer esta imagen como portada:", error);
              alert(
                  "Hubo un problema al eliminar la imagen. Por favor, inténtelo de nuevo más tarde." +
                  error
              );
          });
  }
}

,
  listImagenesUsuarios:async()=>{
    // Llama a la función del controlador para obtener las imágenes
    const peliculaId = parseInt(document.getElementById("peliculaUsuario").dataset.id);
    const imagenes = await singletonController.listImagenes(peliculaId);

    // console.log(imagenes)
    // Selecciona el contenedor del carrusel
    const carouselInner = document.querySelector("#movieCarousel .carousel-inner");

    // Limpiar contenido previo (si hay)
    carouselInner.innerHTML = '';

    // Verifica si hay imágenes
    if (imagenes.length > 0) {
        imagenes.forEach((imgSrc, index) => {
            // Crea un div para cada imagen
            const carouselItem = document.createElement('div');
            carouselItem.className = 'carousel-item';
            if (index === 0) {
                // Establece la primera imagen como activa
                carouselItem.classList.add('active');
            }
            // Crea la etiqueta de imagen
            const imgElement = document.createElement('img');
            imgElement.src = imgSrc.imagen;
            imgElement.className = 'd-block w-100';
            imgElement.alt = 'Imagen de la película';

            // Agrega la imagen al div
            carouselItem.appendChild(imgElement);
            // Agrega el div al carrusel
            carouselInner.appendChild(carouselItem);
        });
    } 
  }

  }

  const formatDate = (dateString) => {
    const [year, month, day] = dateString.split("-");
    return `${day}/${month}/${year}`;
  };



document.addEventListener("DOMContentLoaded", () => {
  let btnBuscarPelicula = document.getElementById("btnBuscarPelicula");
  let btnListarPelicula = document.getElementById("btnListarPelicula");
  let btnPDFPelicula = document.getElementById("btnPDFPelicula");
  let btnAltaPelicula = document.getElementById("btnAltaPelicula");

  let btnBorrarPelicula = document.getElementById("btnBorrarPelicula");
  let btnModificarPelicula = document.getElementById("btnModificarPelicula");

  if (btnAltaPelicula != null) {
    peliculaController.list();
    btnAltaPelicula.onclick = peliculaController.save;
    btnPDFPelicula.onclick = peliculaController.print;
    btnListarPelicula.onclick = peliculaController.list;

    btnBuscarPelicula.addEventListener("click",function(){
      if(document.getElementById("filterType").value=="genero"){

        peliculaController.loadByGenero()

      }
      else if(document.getElementById("filterType").value=="pais"){

        peliculaController.loadByPais()

      }
      else if(document.getElementById("filterType").value=="titulo"){

        peliculaController.loadByNombrePelicula()

      }
      else if(document.getElementById("filterType").value=="idioma"){

        peliculaController.loadByIdioma()

      }
      else if(document.getElementById("filterType").value=="calificacion"){

        peliculaController.loadByCalificacion()

      }
    })


  } else if (btnModificarPelicula != null) {
    
    peliculaController.listImagenes()
    btnModificarPelicula.onclick = peliculaController.update;
    btnBorrarPelicula.onclick = peliculaController.delete;

  }else if(document.getElementById("divListarImagenes")!=null){
    peliculaController.listImagenesUsuarios()
  }
});
