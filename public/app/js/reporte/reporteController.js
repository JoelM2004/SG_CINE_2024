let reporteController = {
    
    reporteUsuario : () => {
        let usuario = document.getElementById("nombreUsuario");
        let entradas=document.getElementById("entradasVendidas")
        let totalVendido= document.getElementById("totalRecaudado")
        let promedio=document.getElementById("precioPromedio");
        


        if (usuario.value.length <= 0) {
            alert("Inserte un Usuario válido");
            return;
        }
        
        reporteService.reporteUsuario(usuario.value)
            .then((data) => {
                console.log("Datos del reporte de usuario:", data);
                let tabla = document.getElementById("entradasTableBody");
                let txt = "";

                let index = 0;
                let total=0;

                if (data.error === "") {
                    // Limpiar la tabla antes de agregar nuevas filas
                    tabla.innerHTML = "";
                    

                    if(data.result.length==0){
                        tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> El usuario no contiene registros</td></tr>`;
                        return
                    }
                    // Obtener la lista de perfiles
                    data.result.forEach(element => {

                        txt += "<tr>";
                        txt += "<th>" + (index += 1) + "</th>";
                        txt += "<td>" + element.cuenta + "</td>";
                        txt += "<td>" + element.numeroTicket + "</td>";
                        txt += "<td>" + element.numeroFuncion + "</td>";
                        txt += "<td>" + formatDate(element.fecha) + "</td>";
                        txt += "<td>" + formatHour(element.horaInicio) + "</td>";
                        txt += "<td>" + element.nombre + "</td>";
                        txt += "<td>" + element.precio + "</td>";
                        total+=element.precio
                        txt += "</tr>";

                    });
    
                    // Reemplazar el contenido HTML de la tabla con las filas generadas
                    entradas.value=index
                    totalVendido.value="$"+total
                    promedio.value="$"+(total/index)
                    tabla.innerHTML = txt;

                } else {
                    alert("El Usuario No Existe");
                    // Limpiar la tabla y mostrar un mensaje si no hay resultados
                    tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
                }
            })
            .catch((error) => {
                console.error("Error al listar Reportes:", error);
                let tabla = document.getElementById("entradasTableBody");
                // Limpiar la tabla y mostrar un mensaje de error
                tabla.innerHTML = "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
            });
    }
    ,
    reporteProgramacion : () => {
        let programacion = document.getElementById("programacionInput");
        let entradas=document.getElementById("entradasVendidas")
        let totalVendido= document.getElementById("totalRecaudado")
        let promedio=document.getElementById("precioPromedio");
        
        if (programacion.value == "") {
            alert("Inserte una programacion válida");
            return;
        }
        
        reporteService.reporteProgramacion(programacion.value)
            .then((data) => {
                console.log("Datos del reporte de usuario:", data);
                let tabla = document.getElementById("entradasTableBody");
                let txt = "";

                let index = 0;
                let total=0;

                if (data.error === "") {
                    // Limpiar la tabla antes de agregar nuevas filas
                    tabla.innerHTML = "";
                    

                    if(data.result.length==0){
                        tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
                        return
                    }
                    // Obtener la lista de perfiles
                    data.result.forEach(element => {

                        txt += "<tr>";
                        txt += "<th>" + (index += 1) + "</th>";
                        txt += "<td>" + element.cuenta + "</td>";
                        txt += "<td>" + element.numeroTicket + "</td>";
                        txt += "<td>" + element.numeroFuncion + "</td>";
                        txt += "<td>" + formatDate(element.fecha) + "</td>";
                        txt += "<td>" + formatHour(element.horaInicio) + "</td>";
                        txt += "<td>" + element.nombre + "</td>";
                        txt += "<td>" + element.precio + "</td>";
                        total+=element.precio
                        txt += "</tr>";

                    });
    
                    // Reemplazar el contenido HTML de la tabla con las filas generadas
                    entradas.value=index
                    totalVendido.value="$"+total
                    promedio.value="$"+(total/index)
                    tabla.innerHTML = txt;

                } else {
                    alert("El Usuario No Existe");
                    // Limpiar la tabla y mostrar un mensaje si no hay resultados
                    tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
                }
            })
            .catch((error) => {
                console.error("Error al listar Reportes:", error);
                let tabla = document.getElementById("entradasTableBody");
                // Limpiar la tabla y mostrar un mensaje de error
                tabla.innerHTML = "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
            });
    },
    reporteFuncion : () => {
        let funcion = document.getElementById("funcionInput");
        let entradas=document.getElementById("entradasVendidas")
        let totalVendido= document.getElementById("totalRecaudado")
        let promedio=document.getElementById("precioPromedio");
        
        if (funcion.value == "") {
            alert("Inserte una funcion válida");
            return;
        }
        
        reporteService.reporteFuncion(funcion.value)
            .then((data) => {
                console.log("Datos del reporte de usuario:", data);
                let tabla = document.getElementById("entradasTableBody");
                let txt = "";

                let index = 0;
                let total=0;

                if (data.error === "") {
                    // Limpiar la tabla antes de agregar nuevas filas
                    tabla.innerHTML = "";
                    

                    if(data.result.length==0){
                        tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
                        return
                    }
                    // Obtener la lista de perfiles
                    data.result.forEach(element => {

                        txt += "<tr>";
                        txt += "<th>" + (index += 1) + "</th>";
                        txt += "<td>" + element.cuenta + "</td>";
                        txt += "<td>" + element.numeroTicket + "</td>";
                        txt += "<td>" + element.numeroFuncion + "</td>";
                        txt += "<td>" + formatDate(element.fecha) + "</td>";
                        txt += "<td>" + formatHour(element.horaInicio) + "</td>";
                        txt += "<td>" + element.nombre + "</td>";
                        txt += "<td>" + element.precio + "</td>";
                        total+=element.precio
                        txt += "</tr>";

                    });
    
                    // Reemplazar el contenido HTML de la tabla con las filas generadas
                    entradas.value=index
                    totalVendido.value="$"+total
                    promedio.value="$"+(total/index)
                    tabla.innerHTML = txt;

                } else {
                    alert("La Funcion No Existe");
                    // Limpiar la tabla y mostrar un mensaje si no hay resultados
                    tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
                }
            })
            .catch((error) => {
                console.error("Error al listar Reportes:", error);
                let tabla = document.getElementById("entradasTableBody");
                // Limpiar la tabla y mostrar un mensaje de error
                tabla.innerHTML = "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
            });
    },
    reportePelicula : () => {
        let pelicula = document.getElementById("peliculaInput");
        let entradas=document.getElementById("entradasVendidas")
        let totalVendido= document.getElementById("totalRecaudado")
        let promedio=document.getElementById("precioPromedio");
        
        if (pelicula.value == "") {
            alert("Inserte una funcion válida");
            return;
        }
        
        reporteService.reportePelicula(pelicula.value)
            .then((data) => {
                console.log("Datos del reporte:", data);
                let tabla = document.getElementById("entradasTableBody");
                let txt = "";

                let index = 0;
                let total=0;

                if (data.error === "") {
                    // Limpiar la tabla antes de agregar nuevas filas
                    tabla.innerHTML = "";
                    

                    if(data.result.length==0){
                        tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'> No contiene registros</td></tr>`;
                        return
                    }
                    // Obtener la lista de perfiles
                    data.result.forEach(element => {

                        txt += "<tr>";
                        txt += "<th>" + (index += 1) + "</th>";
                        txt += "<td>" + element.cuenta + "</td>";
                        txt += "<td>" + element.numeroTicket + "</td>";
                        txt += "<td>" + element.numeroFuncion + "</td>";
                        txt += "<td>" + formatDate(element.fecha) + "</td>";
                        txt += "<td>" + formatHour(element.horaInicio) + "</td>";
                        txt += "<td>" + element.nombre + "</td>";
                        txt += "<td>" + element.precio + "</td>";
                        total+=element.precio
                        txt += "</tr>";

                    });
    
                    // Reemplazar el contenido HTML de la tabla con las filas generadas
                    entradas.value=index
                    totalVendido.value="$"+total
                    promedio.value="$"+(total/index)
                    tabla.innerHTML = txt;

                } else {
                    alert("La Funcion No Existe");
                    // Limpiar la tabla y mostrar un mensaje si no hay resultados
                    tabla.innerHTML = `<tr><td colspan='8' style='text-align: center;'>${data.error}</td></tr>`;
                }
            })
            .catch((error) => {
                console.error("Error al listar Reportes:", error);
                let tabla = document.getElementById("entradasTableBody");
                // Limpiar la tabla y mostrar un mensaje de error
                tabla.innerHTML = "<tr><td colspan='8' text-align='center'>NO HAY ENTRADAS NI REGISTROS</td></tr>";
            });
    }

}
  
function formatDate(dateString) {
    const dateParts = dateString.split("-");
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
}

const formatHour = (hourString) => {
    // Asumiendo que `hourString` es una cadena en formato "HH:mm:ss"
    return hourString.split(":").slice(0, 2).join(":");
};


document.addEventListener("DOMContentLoaded",()=>{

    let generarReporteBtn=document.getElementById("generarReporteBtn");
    
    generarReporteBtn.addEventListener("click",function(){
        if(document.getElementById("tipoReporte").value=="usuario"){
  
          reporteController.reporteUsuario()
  
        }
        else if(document.getElementById("tipoReporte").value=="programaciones"){
  
          reporteController.reporteProgramacion()
  
        }
        else if(document.getElementById("tipoReporte").value=="peliculas"){
  
          reporteController.reportePelicula()
  
        }
        else if(document.getElementById("tipoReporte").value=="funciones"){
  
          reporteController.reporteFuncion()
  
        }
        
      })
  }




)