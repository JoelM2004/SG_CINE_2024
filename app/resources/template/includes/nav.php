<!-- <nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= APP_FRONT . "usuario/datos" ?>">Ver Mis datos en la Aplicación</a>

    <button class="btn btn-secondary" onclick="window.location.href='autenticacion/logout'">Cerrar Sesión</button>

</nav> -->

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ir al Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Opciones</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= APP_FRONT . "usuario/datos" ?>">Ver Información sobre mi Cuenta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clases
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="usuario/create" <?php if ($_SESSION["perfil"] !== "Administrador") {

                                                                    echo "hidden";
                                                                  }

                                                                  ?>>Usuarios</a></li>

              <li><a class="dropdown-item" href="cliente/create">Clientes</a></li>

              <li><a class="dropdown-item" href="perfil/create" <?php if ($_SESSION["perfil"] !== "Administrador") {

                                                                  echo "hidden";
                                                                } ?>>Perfiles</a></li>
            </ul>
          </li>
        </ul>

        <button class="btn btn-danger mt-3 " onclick="window.location.href='autenticacion/logout'">Cerrar Sesión</button>

      </div>
    </div>
  </div>
</nav>