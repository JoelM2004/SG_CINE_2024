
if(document.getElementById('filterForm')!=null){
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const vigenteFilter = document.getElementById('filterVigente').value;

    // Aquí agregas la lógica para filtrar la tabla según el valor de 'vigente'
    // Por ejemplo:
    // Filtrar las programaciones donde el campo 'vigente' es igual a 'vigenteFilter'
});
}

function toggleFilters() {
    const filterType = document.getElementById("filterType").value;

    const filterVigenteDiv = document.getElementById("filterVigenteDiv");
    const filterFechaRangoDiv = document.getElementById("filterFechaRangoDiv");

    // Ocultar ambos filtros por defecto
    filterVigenteDiv.classList.add('d-none');
    filterFechaRangoDiv.classList.add('d-none');

    // Mostrar el filtro seleccionado
    if (filterType === "vigente") {
        filterVigenteDiv.classList.remove('d-none');
        filterVigenteDiv.classList.add('d-block');
    } else if (filterType === "fechaRango") {
        filterFechaRangoDiv.classList.remove('d-none');
        filterFechaRangoDiv.classList.add('d-block');
    }
}
