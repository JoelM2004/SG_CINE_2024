<div class="container mt-5">
    <!-- Logo de Los Pollos Hermanos -->
    <div class="text-center mb-4">
        <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
    </div>

    <!-- Tarjeta para Solicitud de Nueva Contraseña -->
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Solicitar Nueva Contraseña</h2>
            
            <!-- Formulario -->
            <form id="password-reset-form">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <button type="button" id="btnforgetAuth" class="btn btn-primary w-100">Enviar Instrucciones</button>
            </form>

            <!-- Spinner oculto por defecto -->
            <div id="loading-spinner" class="text-center my-3" style="display: none;">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Procesando...</span>
                </div>
            </div>

            <!-- Botón de regreso -->
            <div class="text-center mt-3">
                <a href="<?= APP_FRONT . 'autentication/index' ?>" class="btn btn-secondary w-100" id="back-to-login-button">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</div>

