let config=document.getElementById('filterType');

if(config!=null){
config.addEventListener('change', function() {
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
}

if(document.getElementById("btnChangePassword")!=null){
document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', event => {
        const input = document.getElementById(item.getAttribute('data-toggle'));
        if (input.type === 'password') {
            input.type = 'text';
            item.classList.remove('fa-eye');
            item.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            item.classList.remove('fa-eye-slash');
            item.classList.add('fa-eye');
        }
    });
})}