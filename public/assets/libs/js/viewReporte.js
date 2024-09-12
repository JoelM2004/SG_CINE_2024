document.addEventListener('DOMContentLoaded', function() {
    // Variables para las secciones
    const tipoReporte = document.getElementById('tipoReporte');
    const funcionSection = document.getElementById('funcionSection');
    const peliculaSection = document.getElementById('peliculaSection');
    const programacionSection = document.getElementById('programacionSection');
    const usuarioSection = document.getElementById('usuarioSection');
    const metricasSection = document.getElementById('metricasSection');
    const reporteResultado = document.getElementById('reporteResultado');
    const reporteTexto = document.getElementById('reporteTexto');
    const entradasTableBody = document.getElementById('entradasTableBody');

    // Función para mostrar/ocultar secciones dependiendo del tipo de reporte seleccionado
    tipoReporte.addEventListener('change', function() {
        ocultarSecciones();
        const valor = tipoReporte.value;
        if (valor === 'funciones') {
            funcionSection.style.display = 'block';
        } else if (valor === 'peliculas') {
            peliculaSection.style.display = 'block';
        } else if (valor === 'programaciones') {
            programacionSection.style.display = 'block';
        } else if (valor === 'usuario') {
            usuarioSection.style.display = 'block';
        }
    });

    // Función para ocultar todas las secciones
    function ocultarSecciones() {
        funcionSection.style.display = 'none';
        peliculaSection.style.display = 'none';
        programacionSection.style.display = 'none';
        usuarioSection.style.display = 'none';
    }

    // Evento para generar el reporte
    document.getElementById('generarReporteBtn').addEventListener('click', function() {
        // Simulación de generar reporte
        let reporte = `Reporte generado con los siguientes datos:\n`;
        

        // Mostrar la sección de métricas y limpiar la tabla
        metricasSection.style.display = 'block';
        entradasTableBody.innerHTML = ''; // Limpiar la tabla antes de llenarla

        // Limpiar los campos de métricas
        document.getElementById('entradasVendidas').value = '';
        document.getElementById('totalRecaudado').value = '';
        document.getElementById('precioPromedio').value = '';
        
        // Mostrar resultado
        reporteResultado.style.display = 'block';
        reporteTexto.innerText = reporte;
    });

    function formatDate(dateString) {
        const dateParts = dateString.split("-");
        return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
    }
});
