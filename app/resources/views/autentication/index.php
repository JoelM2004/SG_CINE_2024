<div class="container mt-5">
    <!-- Logo de Los Pollos Hermanos -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Tarjeta para Registro/Iniciar Sesión -->
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Registrarse / Iniciar Sesión</h2>
            
            <!-- Formulario -->
            <form id="auth-form">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>

            <!-- Enlaces adicionales -->
            <div class="text-center mt-3">
                <a href="<?= APP_FRONT . 'autentication/register' ?>" id="register-link">¿No tienes una cuenta? Regístrate aquí</a>
            </div>
            <div class="text-center mt-2">
                <a href="<?= APP_FRONT . 'autentication/forgot' ?>" id="forgot-password-link">¿Has olvidado tu contraseña?</a>
            </div>
        </div>
    </div>
</div>
