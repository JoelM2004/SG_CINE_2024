<div class="container mt-5">
    <!-- Logo de Los Pollos Hermanos -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Tarjeta para Registro/Iniciar Sesión -->
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
            
            <!-- Formulario -->
            <form id="auth-form">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                </div>
                <button id="btnLogin" type="button" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>

            <!-- Enlaces estilo botón -->
            <div class="text-center mt-3">
                <a href="<?= APP_FRONT . 'autentication/register' ?>" class="btn btn-secondary w-100" id="register-link">¿No tienes una cuenta? Regístrate aquí</a>
            </div>
            <div class="text-center mt-2">
                <a href="<?= APP_FRONT . 'autentication/forgot' ?>" class="btn btn-secondary w-100" id="forgot-password-link">¿Has olvidado tu contraseña?</a>
            </div>
        </div>
    </div>
</div>




