<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="assets/img/logo.png" width="32px" height="32px" alt="Logo Cine Pollos Hermanos" class="me-2">
      <span class="fw-bold">Cine Los Pollos Hermanos</span>
    </a>

    <h2 class="text-white text-center flex-grow-1 m-0"></h2>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title fw-bold" id="offcanvasDarkNavbarLabel">Opciones</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link active fw-bold" aria-current="page" href="<?= APP_FRONT . 'inicio/index' ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="<?= APP_FRONT . 'usuario/view' ?>" <?php if (!isset($_SESSION["token"]) || $_SESSION["token"] != APP_TOKEN) echo 'hidden'; ?> >Mi Cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="#cartelera">Cartelera-Programación</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="<?= APP_FRONT . 'info/index' ?>">Acerca de Nosotros</a>
        </li>
        <li class="nav-item dropdown" <?php if ((!isset($_SESSION["token"]) || $_SESSION["token"] != APP_TOKEN)||(($_SESSION["perfil"]) !=="Administrador")&&(($_SESSION["perfil"]) !=="Operador")) echo 'hidden'; ?>>
          <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Funcionalidades para Operarios y Administradores
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'sala/index' ?>"<?php if (($_SESSION["perfil"]) !=="Administrador") echo 'hidden'; ?>>Gestionar Salas</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'pelicula/index' ?>" <?php if (($_SESSION["perfil"]) !=="Administrador") echo 'hidden'; ?>>Gestionar Películas</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'programacion/index' ?>">Gestionar Programaciones</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'funcion/index' ?>">Gestionar Funciones</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'entrada/index' ?>">Gestionar Entradas</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'usuario/index' ?>"<?php if (($_SESSION["perfil"]) !=="Administrador") echo 'hidden'; ?>>Gestionar Usuarios</a></li>
            <li><a class="dropdown-item" href="<?= APP_FRONT . 'perfil/index' ?>"<?php if (($_SESSION["perfil"]) !=="Administrador") echo 'hidden'; ?>>Gestionar Perfiles</a></li>
          </ul>
        </li>
      </ul>

      <div class="mt-3 d-flex flex-column align-items-center">
        <!-- Botón para iniciar sesión o registrarse -->
        <button class="btn btn-success w-100 mb-2" onclick="window.location.href='<?= APP_FRONT . 'autentication/index' ?>'"
          <?php if (isset($_SESSION["token"]) && $_SESSION["token"] == APP_TOKEN) echo 'hidden'; ?>>
          Iniciar Sesión o Registrarse
        </button>

        <!-- Botón para cerrar sesión -->
        <button class="btn btn-danger w-100" onclick="window.location.href='<?= APP_FRONT . 'autentication/logout' ?>'" <?php if (!isset($_SESSION["token"]) || $_SESSION["token"] != APP_TOKEN) echo 'hidden'; ?>>
          Cerrar Sesión
        </button>
      </div>

    </div>
  </div>
</nav>