if(document.getElementById('filterType')!=null){
document.getElementById('filterType').addEventListener('change', function() {
    // Ocultar todos los filtros
    document.getElementById('filterGenero').classList.add('d-none');
    document.getElementById('filterPais').classList.add('d-none');
    document.getElementById('filterIdioma').classList.add('d-none');
    document.getElementById('filterCalificacion').classList.add('d-none');
    document.getElementById('filterTitulo').classList.add('d-none');
    document.getElementById('filterEstreno').classList.add('d-none');
    document.getElementById('filterActores').classList.add('d-none');
    // Mostrar el filtro seleccionado
    const selectedFilter = this.value;
    if (selectedFilter === 'genero') {
        document.getElementById('filterGenero').classList.remove('d-none');
    } else if (selectedFilter === 'pais') {
        document.getElementById('filterPais').classList.remove('d-none');
    } else if (selectedFilter === 'idioma') {
        document.getElementById('filterIdioma').classList.remove('d-none');
    } else if (selectedFilter === 'calificacion') {
        document.getElementById('filterCalificacion').classList.remove('d-none');
    } else if (selectedFilter === 'titulo') {
        document.getElementById('filterTitulo').classList.remove('d-none');
    }
    else if (selectedFilter === 'estreno') {
        document.getElementById('filterEstreno').classList.remove('d-none');
    }
    else if (selectedFilter === 'actor') {
        document.getElementById('filterActores').classList.remove('d-none');
    }
});
}

if(document.getElementById('filterForm')!=null){
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const filterType = document.getElementById('filterType').value;
    let filterValue;

    if (filterType === 'genero') {
        filterValue = document.getElementById('filterGeneroInput').value;
        // Lógica para filtrar la tabla según el género
    } else if (filterType === 'pais') {
        filterValue = document.getElementById('filterPaisInput').value;
        // Lógica para filtrar la tabla según el país
    } else if (filterType === 'idioma') {
        filterValue = document.getElementById('filterIdiomaInput').value;
        // Lógica para filtrar la tabla según el idioma
    } else if (filterType === 'calificacion') {
        filterValue = document.getElementById('filterCalificacionInput').value;
        // Lógica para filtrar la tabla según la calificación
    } else if (filterType === 'titulo') {
        filterValue = document.getElementById('filterTituloInput').value;
        // Lógica para filtrar la tabla según el título de la película
    }else if (filterType === 'estreno') {
        filterValue = document.getElementById('filterEstrenoInput').value;
        // Lógica para filtrar la tabla según el ESTRENO de la película
    }
    else if (filterType === 'actor') {
        filterValue = document.getElementById('filterActoresInput').value;
        // Lógica para filtrar la tabla según el ACTOR de la película
    }

    // Aquí puedes agregar la lógica para realizar el filtrado en la tabla
});
}
if(document.getElementById('imagen1')!=null){
document.getElementById('imagen1').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagenPreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
});}


if(document.getElementById("inputImagen")!=null){
    document.getElementById('inputImagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previsualizarImagen');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });

}
