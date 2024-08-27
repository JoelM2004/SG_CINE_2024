<div class="container mt-5">
    <!-- Logo de Los Pollos Hermanos -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Tarjeta para Registrarse -->
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Registrarse</h2>
            
            <!-- Formulario de Registro -->
            <form id="register-form">
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombres" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" placeholder="Ingresa tu apellido" required>
                </div>
                <div class="mb-3">
                    <label for="cuenta" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="cuenta" placeholder="Ingresa tu nombre de Usuario" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="clave" placeholder="Ingresa tu contraseña" required>
                        <span class="input-group-text">
                            <i class="fas fa-eye toggle-password" data-toggle="clave"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="claveConfirm" class="form-label">Repita su Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="claveConfirm" placeholder="Ingresa tu contraseña" required>
                        <span class="input-group-text">
                            <i class="fas fa-eye toggle-password" data-toggle="claveConfirm"></i>
                        </span>
                    </div>
                </div>

                <!-- Botón de Registro -->
                <button id="btnRegister" type="button" class="btn btn-primary w-100">Registrarse</button>
                
                <!-- Botón para Volver al Inicio de Sesión -->
                <div class="text-center mt-3">
                    <a href="<?= APP_FRONT . 'autentication/index' ?>" class="btn btn-secondary w-100">Volver al Inicio de Sesión</a>
                </div>
            </form>
        </div>
    </div>
</div>
