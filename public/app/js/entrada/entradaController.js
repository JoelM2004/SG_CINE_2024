let entradaController = {
    data: {
      id: 0,
      horarioFuncion: "",
      horaVenta: "",
      precio: 0,
      numeroTicket: 0,
      estado: 0,
      funcionId: 0,
      usuarioId:0
    },
  
    save: () => { revisar
      if (confirm("¿Seguro que lo quieres guardar?")) {
        let form = document.forms["formUsuario"];
  
        if (form.apellidoUsuario.value.length > 45) {
          alert("Supero el limite de caracteres con su apellido");
        } else {
          entradaController.data.apellido = form.apellidoUsuario.value;
        }
  
        if (form.nombreUsuario.value.length > 45) {
          alert("Supero el limite de caracteres con su nombre");
        } else {
          entradaController.data.nombres = form.nombreUsuario.value;
        }
  
        if (form.cuentaUsuario.value.length > 45) {
          alert("Supero el limite de caracteres con su cuenta");
        } else {
          entradaController.data.cuenta = form.cuentaUsuario.value;
        }
  
        if (
          form.claveUsuario.value.length > 6 &&
          form.claveUsuario.value.length < 45
        ) {
          entradaController.data.clave = form.claveUsuario.value;
        } else {
          alert("Su clave es demasiado corta o muy largo (7 a 44 caracteres)");
        }
  
        if (form.correoUsuario.value.length > 255) {
          alert("El correo es muy largo");
        } else {
          entradaController.data.correo = form.correoUsuario.value;
        }
  
        entradaController.data.perfilId = form.tipoPerfil.value;
        entradaController.data.perfilId = parseInt(entradaController.data.perfilId);
  
        entradaService
          .save(entradaController.data)
          .then((data) => {
            console.log("Guardando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al guardar el entrada: " + data.error);
            } else {
              alert("entrada guardado con éxito");
              setTimeout(() => {
                location.reload();
              }, 300);
            }
          })
          .catch((error) => {
            console.error("Error en la Petición ", error);
            alert("Ocurrió un error al guardar el entrada");
          });
      }
    },
  
    // delete: () => {
    //   if (confirm("¿Seguro que quieres eliminar al Usuario?")) {
    //     entradaController.data.id = document.getElementById(
    //       "filaModificarUsuario"
    //     ).dataset.id;
  
    //     entradaService
    //       .delete(entradaController.data)
    //       .then((data) => {
    //         alert(data.mensaje);
    //       })
    //       .catch((error) => {
    //         // Maneja cualquier error que ocurra durante el cambio de contraseña
    //         console.error("Error al eliminar el Usuario:", error);
    //         alert(
    //           "Hubo un problema al eliminar el Usuario. Por favor, inténtelo de nuevo más tarde."
    //         );
    //       });
    //   }
    // },
  
    // loadByNameAccount: async () => {
    //   const nombre = document.getElementById("filterNombreCuenta").value;
    //   aux = await singletonController.listPerfil();
    //   console.log("Buscando entrada...");
  
    //   await entradaService
    //     .loadByNameAccount(nombre)
    //     .then((data) => {
    //       if (data.error == "") {
    //         console.log("Usuario encontrado:", data);
  
    //         let tabla = document.getElementById("tbodyUsuario");
    //         let txt = "";
  
    //         // Aquí se espera un solo objeto, no un array
    //         const usuario = data.result;
  
    //         if (usuario) {
    //           txt += "<tr>";
    //           txt += "<th>1</th>"; // Solo un perfil, por lo tanto, índice fijo en 1
    //           txt += "<td>" + usuario.cuenta + "</td>";
    //           txt += "<td>" + usuario.nombres + "</td>";
    //           txt += "<td>" + usuario.apellido + "</td>";
    //           txt += "<td>" + usuario.correo + "</td>";
  
    //           let txts;
    //           aux.forEach((elemento) => {
    //             if (elemento.id == usuario.perfilId) txts = elemento.nombre;
    //           });
  
    //           // let perfil = perfiles.find(p => p.id === element.perfilId);
    //           // let txtAux = perfil ? perfil.nombre : "Desconocido";
  
    //           txt += "<td>" + txts + "</td>";
  
    //           txt +=
    //             '<td><a href="http://localhost/SG_CINE_2024/public/usuario/edit/' +
    //             usuario.id +
    //             '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
    //           txt += "</tr>";
    //         } else {
    //           // Manejo si no se encuentra el perfil, puede ser opcional
    //           txt += "<tr><td colspan='3'>No se encontró el perfil.</td></tr>";
    //         }
  
    //         tabla.innerHTML = txt;
    //       } else {
    //         alert("El Usuario "+ nombre +" no fue encontrado");
    //       }
    //     })
    //     .catch((error) => {
    //       console.error("Error al buscar perfil:", error);
    //     });
    // },
  
    update: () => {
      if (confirm("¿Seguro que lo quieres actualizar?")) {
        
        entradaController.data.estado=document.getElementById("btnToggleEntrada").value
  
        entradaService
          .update(entradaController.data)
          .then((data) => {
            console.log("Actualizando Datos");
            // Aquí puedes manejar la respuesta
            if (data.error !== "") {
              alert("Error al actualizar el entrada: " + data.error);
            } else {
              alert("entrada actualizado con éxito");
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
  
    list: async () => { //listo
      console.log("Listando entrada...");
      aux = await singletonController.listUsuario();
      aux2 = await singletonController.listFuncion();
        
      index = 0;
      await entradaService
        .list()
        .then((data) => {
          console.log("entrada listados:", data);
          let tabla = document.getElementById("tbodyEntradas");
          let txt = "";
  
          // Obtener la lista de perfiles
          data.result.forEach((element) => {
            txt += "<tr>";
            let txts2;
            txt += "<th>" + (index = index + 1) + "</th>";
            aux2.forEach((elemento2) => {
              if (elemento2.id == element.funcionId) txts2 = elemento2.numeroFuncion;
            });
            txt += "<td>" + txts2 + "</td>";
            txt += "<td>" + element.horaFuncion + "</td>";
            txt += "<td>" + element.horaVenta + "</td>";
            txt += "<td>" + element.precio + "</td>";
            txt += "<td>" + element.numeroTicket + "</td>";
  
            let txts;
            aux.forEach((elemento) => {
              if (elemento.id == element.usuarioId) txts = elemento.cuenta;
            });
            txt += "<td>" + txts + "</td>";
            
            if (element.estado === 1) {
                txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
            } else {
                txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
            }
            
            txt +=
              '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
              element.id +
              '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
            txt += "</tr>";
          });
  
          tabla.innerHTML = txt; // Reemplaza el contenido HTML de la tabla con las filas generadas
        })
        .catch((error) => {
          console.error("Error al listar entrada:", error);
        });
    },
    
    loadByCuenta: async () => {
        console.log("Listando entrada...");
        aux = await singletonController.listUsuario();
        aux2 = await singletonController.listFuncion();
        
        let cuenta = document.getElementById("filterCuentaCliente").value;
        if (typeof cuenta !== 'string' || cuenta.trim() === "") {
            alert("Por favor, ingresa una cuenta válida.");
            return;
        }
        
        index = 0;
        await entradaService
            .loadByCuenta(cuenta)
            .then((data) => {
                if (data.result.length === 0) {
                    alert("Cuenta no encontrada");
                    return;
                }
                
                console.log("Entrada listadas:", data);
                let tabla = document.getElementById("tbodyEntradas");
                let txt = "";
    
                data.result.forEach((element) => {
                    txt += "<tr>";
                    let txts2;
                    txt += "<th>" + (index = index + 1) + "</th>";
                    aux2.forEach((elemento2) => {
                        if (elemento2.id == element.funcionId) txts2 = elemento2.numeroFuncion;
                    });
                    txt += "<td>" + txts2 + "</td>";
                    txt += "<td>" + element.horaFuncion + "</td>";
                    txt += "<td>" + element.horaVenta + "</td>";
                    txt += "<td>" + element.precio + "</td>";
                    txt += "<td>" + element.numeroTicket + "</td>";
    
                    let txts;
                    aux.forEach((elemento) => {
                        if (elemento.id == element.usuarioId) txts = elemento.cuenta;
                    });
                    txt += "<td>" + txts + "</td>";
    
                    if (element.estado === 1) {
                        txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
                    } else {
                        txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
                    }
    
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });
    
                tabla.innerHTML = txt;
            })
            .catch((error) => {
                console.error("Error al listar entrada:", error);
            });
    },
    
    loadByFuncion: async () => {
        console.log("Listando entrada...");
        aux = await singletonController.listUsuario();
        aux2 = await singletonController.listFuncion();
    
        let funcionId = parseInt(document.getElementById("filterNumeroFuncion").value, 10);
        if (isNaN(funcionId) || funcionId <= 0) {
            alert("Por favor, ingresa un número de función válido.");
            return;
        }
    
        index = 0;
        await entradaService
            .loadByFuncion(funcionId)
            .then((data) => {
                if (data.result.length === 0) {
                    alert("Función no encontrada");
                    return;
                }
    
                console.log("Entrada listadas:", data);
                let tabla = document.getElementById("tbodyEntradas");
                let txt = "";
    
                data.result.forEach((element) => {
                    txt += "<tr>";
                    let txts2;
                    txt += "<th>" + (index = index + 1) + "</th>";
                    aux2.forEach((elemento2) => {
                        if (elemento2.id == element.funcionId) txts2 = elemento2.numeroFuncion;
                    });
                    txt += "<td>" + txts2 + "</td>";
                    txt += "<td>" + element.horaFuncion + "</td>";
                    txt += "<td>" + element.horaVenta + "</td>";
                    txt += "<td>" + element.precio + "</td>";
                    txt += "<td>" + element.numeroTicket + "</td>";
    
                    let txts;
                    aux.forEach((elemento) => {
                        if (elemento.id == element.usuarioId) txts = elemento.cuenta;
                    });
                    txt += "<td>" + txts + "</td>";
    
                    if (element.estado === 1) {
                        txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
                    } else {
                        txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
                    }
    
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });
    
                tabla.innerHTML = txt;
            })
            .catch((error) => {
                console.error("Error al listar entrada:", error);
            });
    },
    
    loadByNumeroTicket: async () => {
        console.log("Listando entrada...");
        aux = await singletonController.listUsuario();
        aux2 = await singletonController.listFuncion();
    
        let numeroTicket = parseInt(document.getElementById("filterNumeroTicket").value, 10);
        if (isNaN(numeroTicket) || numeroTicket <= 0) {
            alert("Por favor, ingresa un número de ticket válido.");
            return;
        }
    
        index = 0;
        await entradaService
            .loadByNumeroTicket(numeroTicket)
            .then((data) => {
                if (data.result.length === 0) {
                    alert("Número de Ticket no encontrado");
                    return;
                }
    
                console.log("Entrada listadas:", data);
                let tabla = document.getElementById("tbodyEntradas");
                let txt = "";
    
                data.result.forEach((element) => {
                    txt += "<tr>";
                    let txts2;
                    txt += "<th>" + (index = index + 1) + "</th>";
                    aux2.forEach((elemento2) => {
                        if (elemento2.id == element.funcionId) txts2 = elemento2.numeroFuncion;
                    });
                    txt += "<td>" + txts2 + "</td>";
                    txt += "<td>" + element.horaFuncion + "</td>";
                    txt += "<td>" + element.horaVenta + "</td>";
                    txt += "<td>" + element.precio + "</td>";
                    txt += "<td>" + element.numeroTicket + "</td>";
    
                    let txts;
                    aux.forEach((elemento) => {
                        if (elemento.id == element.usuarioId) txts = elemento.cuenta;
                    });
                    txt += "<td>" + txts + "</td>";
    
                    if (element.estado === 1) {
                        txt += "<td> <i class='fas fa-circle text-success' title='Activo'></i> </td>";
                    } else {
                        txt += "<td> <i class='fas fa-circle text-danger' title='Desactivado'></i> </td>";
                    }
    
                    txt +=
                        '<td><a href="http://localhost/SG_CINE_2024/public/entrada/edit/' +
                        element.id +
                        '" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>';
                    txt += "</tr>";
                });
    
                tabla.innerHTML = txt;
            })
            .catch((error) => {
                console.error("Error al listar entrada:", error);
            });
    },
    
    print: () => {//lista
      const $elementoParaConvertir = document.getElementById("tablaEntradas"); // <-- Aquí puedes elegir cualquier elemento del DOM
  
      // Crear un contenedor temporal para añadir el título y la fecha
      const tempContainer = document.createElement("div");
  
      // Crear y añadir el título
      const title = document.createElement("h1");
      title.innerText = "Listado de entradas";
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
  
  };
  
  document.addEventListener("DOMContentLoaded", () => {
    // let btnUsuarioAlta = document.getElementById("btnAltaUsuario");
    let btnListarEntrada = document.getElementById("btnListarEntrada");
    let modificarUsuario = document.getElementById("btnModificarUsuario");
    let btnBuscarEntrada=document.getElementById("btnBuscarEntrada")
  
    let btnPDFEntrada = document.getElementById("btnPDFEntrada");
  
    if (btnPDFEntrada != null) {
      entradaController.list();
  
      btnPDFEntrada.onclick=entradaController.print
  
      btnBuscarEntrada.addEventListener("click",function(){
        if(document.getElementById("filterType").value=="ticket"){
           entradaController.loadByNumeroTicket()
        }else if(document.getElementById("filterType").value=="funcion"){
           entradaController.loadByFuncion()
        }else if(document.getElementById("filterType").value=="cuenta"){
             entradaController.loadByCuenta()
        }
      })

      btnListarEntrada.onclick = entradaController.list;

    } else if (modificarUsuario != null) {
      modificarUsuario.onclick = entradaController.update;
    } 
  });