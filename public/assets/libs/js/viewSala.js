document.getElementById('filterType').addEventListener('change', function() {
    // Ocultar todos los filtros
    document.getElementById('filterNumero').classList.add('d-none');
    document.getElementById('filterEstado').classList.add('d-none');
    document.getElementById('filterCapacidad').classList.add('d-none');

    // Mostrar el filtro seleccionado
    const selectedFilter = this.value;
    if (selectedFilter === 'numero') {
        document.getElementById('filterNumero').classList.remove('d-none');
    } else if (selectedFilter === 'estado') {
        document.getElementById('filterEstado').classList.remove('d-none');
    } else if (selectedFilter === 'capacidad') {
        document.getElementById('filterCapacidad').classList.remove('d-none');
    }
});