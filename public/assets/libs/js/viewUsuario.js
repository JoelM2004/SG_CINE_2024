document.getElementById('filterType').addEventListener('change', function() {
    // Ocultar todos los filtros
    document.getElementById('filterCuenta').classList.add('d-none');
    document.getElementById('filterPerfil').classList.add('d-none');

    // Mostrar el filtro seleccionado
    const selectedFilter = this.value;
    if (selectedFilter === 'cuenta') {
        document.getElementById('filterCuenta').classList.remove('d-none');
    } else if (selectedFilter === 'perfil') {
        document.getElementById('filterPerfil').classList.remove('d-none');
    }
});

