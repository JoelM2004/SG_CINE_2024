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
                        <label for="first-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="first-name" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="last-name" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="last-name" placeholder="Ingresa tu apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="account-name" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="account-name" placeholder="Ingresa tu nombre de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </form>
            </div>
        </div>
    </div>