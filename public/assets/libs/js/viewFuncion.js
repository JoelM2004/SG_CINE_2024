if(document.getElementById('filterType')!=null){document.getElementById('filterType').addEventListener('change', function() {
    // Ocultar todos los filtros
    document.getElementById('filterNumeroSala').classList.add('d-none');
    document.getElementById('filterNombrePelicula').classList.add('d-none');
    document.getElementById('filterNumeroFuncion').classList.add('d-none');
    document.getElementById('filterFechaProgramacion').classList.add('d-none');

    // Mostrar el filtro seleccionado
    const selectedFilter = this.value;
    if (selectedFilter === 'numeroSala') {
        document.getElementById('filterNumeroSala').classList.remove('d-none');
    } else if (selectedFilter === 'nombrePelicula') {
        document.getElementById('filterNombrePelicula').classList.remove('d-none');
    } else if (selectedFilter === 'numeroFuncion') {
        document.getElementById('filterNumeroFuncion').classList.remove('d-none');
    } else if (selectedFilter === 'fechaProgramacion') {
        document.getElementById('filterFechaProgramacion').classList.remove('d-none');
    }
});}

toggleInputs = async () => {
    const duracionPelicula = document.getElementById("duracion");
    const pelicula= document.getElementById("nombrePelicula")
    // Llamada a la función para cargar los detalles de la función.
    console.log(duracionPelicula)
    let peliculaDur = await singletonController.loadPelicula(pelicula.value);
  
    duracionPelicula.value=peliculaDur.duracion;
  };




if(document.getElementById('filterForm')!=null){
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const filterType = document.getElementById('filterType').value;
    let filterValue;

    if (filterType === 'numeroSala') {
        filterValue = document.getElementById('filterNumeroSalaInput').value;
        // Lógica para filtrar la tabla según el número de sala
    } else if (filterType === 'nombrePelicula') {
        filterValue = document.getElementById('filterNombrePeliculaInput').value;
        // Lógica para filtrar la tabla según el nombre de la película
    } else if (filterType === 'numeroFuncion') {
        filterValue = document.getElementById('filterNumeroFuncionInput').value;
        // Lógica para filtrar la tabla según el número de función
    } else if (filterType === 'fechaProgramacion') {
        filterValue = document.getElementById('filterFechaProgramacionInput').value;
        // Lógica para filtrar la tabla según la fecha de programación
    }

    // Aquí puedes agregar la lógica para realizar el filtrado en la tabla
});}

if(document.getElementById("duracion")!=null){
    document.getElementById("nombrePelicula").onchange=toggleInputs;
}
    
