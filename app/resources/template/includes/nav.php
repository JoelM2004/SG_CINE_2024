<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid text-align-between">
    <a class="navbar-brand" href="#">
      <img src="assets/img/logo.png" width="32px" height="32px" alt="Logo Cine Pollos Hermanos">
    </a>

    <h2 style="color:aliceblue">Los Pollos Hermanos</h2>


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
            <a class="nav-link active" aria-current="page" href="<?= APP_FRONT . "inicio/index" ?>">Inicio </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= APP_FRONT . "usuario/view" ?>">Mi Cuenta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cartelera">Cartelera-Programación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= APP_FRONT . "info/index" ?>">Acerca de Nosotros</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Funcionalidades para Operarios y Administradores
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="usuario/create" <?php if ($_SESSION["perfil"] !== "Administrador") {

                                                                        echo "hidden";
                                                                      }

                                                                      ?>>Usuarios</a></li>

              <li><a class="dropdown-item" href="cliente/create">Clientes</a></li>

              <li><a class="dropdown-item" href="perfil/create" <?php if ($_SESSION["perfil"] !== "Administrador") {

                                                                  echo "hidden";
                                                                } ?>>Perfiles</a></li>

                                                          
            </ul>-->

              <li><a class="dropdown-item" href="<?= APP_FRONT . "sala/index" ?>"> Gestionar Salas</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "pelicula/index" ?>"> Gestionar Películas</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "programacion/index" ?>"> Gestionar Programaciones</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "funcion/index" ?>"> Gestionar Funciones</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "entrada/index" ?>"> Gestionar Entradas</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "usuario/index" ?>"> Gestionar Usuarios</a></li>
              <li><a class="dropdown-item" href="<?= APP_FRONT . "perfil/index" ?>"> Gestionar Perfiles</a></li>

          </li>
        </ul>


        <button class="btn btn-success mt-3" onclick="window.location.href='<?= APP_FRONT . 'autentication/index' ?>'">
          Iniciar Sesión o Registrarse
        </button>

        <button class="btn btn-danger mt-3 " onclick="window.location.href='autenticacion/logout'">Cerrar Sesión</button>

      </div>


    </div>
  </div>
</nav>