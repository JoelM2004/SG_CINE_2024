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
        alert("Superaste el límite de caracteres en el nombre.");
      } else {
        peliculaController.data.nombre = form.nombre.value;
      }

      if (form.tituloOriginal.value.length > 255) {
        alert("Superaste el límite de caracteres en el título original.");
      } else {
        peliculaController.data.tituloOriginal = form.tituloOriginal.value;
      }

      if (form.duracion.value <= 0) {
        alert("La duración debe ser mayor a 0.");
      } else {
        peliculaController.data.duracion = parseInt(form.duracion.value);
      }

      if (form.sinopsis.value.length > 255) {
        alert("Superaste el límite de caracteres para la sinopsis");
      } else {
        peliculaController.data.sinopsis = form.sinopsis.value;
      }

      if (form.actores.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
      } else {
        peliculaController.data.actores = form.actores.value;
      }

      if (form.sitioWeb.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
      } else {
        peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      }

      if (form.anioEstreno.value.length != 4) {
        alert("El año de estreno debe tener 4 dígitos.");
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
      } else {
        peliculaController.data.nombre = form.nombre.value;
      }

      if (form.tituloOriginal.value.length > 255) {
        alert("Superaste el límite de caracteres en el título original.");
      } else {
        peliculaController.data.tituloOriginal = form.tituloOriginal.value;
      }

      if (form.duracion.value <= 0) {
        alert("La duración debe ser mayor a 0.");
      } else {
        peliculaController.data.duracion = parseInt(form.duracion.value);
      }

      if (form.sinopsis.value.length > 255) {
        alert("Superaste el límite de caracteres para la sinopsis");
      } else {
        peliculaController.data.sinopsis = form.sinopsis.value;
      }

      if (form.actores.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
      } else {
        peliculaController.data.actores = form.actores.value;
      }

      if (form.sitioWeb.value.length > 255) {
        alert("Superaste el límite de caracteres para los actores.");
      } else {
        peliculaController.data.sitioWebOficial = form.sitioWeb.value;
      }

      if (form.anioEstreno.value.length != 4) {
        alert("El año de estreno debe tener 4 dígitos.");
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

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

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

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

    index = 0;
    await peliculaService
      .loadByGenero(document.getElementById("filterGeneroInput").value)
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

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

    index = 0;
    await peliculaService
      .loadByPais(document.getElementById("filterPaisInput").value)
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

  loadByIdioma: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

    index = 0;
    await peliculaService
      .loadByIdioma(document.getElementById("filterIdiomaInput").value)
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

  loadByCalificacion: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

    index = 0;
    await peliculaService
      .loadByCalificacion(document.getElementById("filterCalificacionInput").value)
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

  loadByNombrePelicula: async () => {
    console.log("Listando Películas...");

    tipos = await singletonController.listTipo();
    audios = await singletonController.listAudio();
    generos = await singletonController.listGenero();
    calificaciones = await singletonController.listCalificacion();
    idiomas = await singletonController.listIdioma();
    paises = await singletonController.listPais();

    const formatDate = (dateString) => {
      const [year, month, day] = dateString.split("-");
      return `${day}/${month}/${year}`;
    };

    index = 0;
    await peliculaService
      .loadByNombrePelicula(document.getElementById("filterTituloInput").value)
      .then((data) => {
        console.log("Películas listados:", data);
        let tabla = document.getElementById("tbodyPelicula");
        let txt = "";

        element=data.result
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
          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });
  },
}



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
    btnModificarPelicula.onclick = peliculaController.update;
    btnBorrarPelicula.onclick = peliculaController.delete;
  }
});
