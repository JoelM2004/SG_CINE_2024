<div class="container mt-5">
        <!-- Logo de Los Pollos Hermanos -->
        <div class="text-center mb-4">
            <img src="assets/img/logo.png" alt="Los Pollos Hermanos Logo" class="img-fluid" style="max-width: 150px;">
        </div>

        <!-- Viñeta para cambiar entre secciones -->
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Perfil</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="purchase-history-tab" data-bs-toggle="tab" href="#purchase-history" role="tab" aria-controls="purchase-history" aria-selected="false">Historial de Compras</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Cambiar Contraseña</a>
            </li>
        </ul>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="myTabContent">
            <!-- Perfil -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Información de la Cuenta</h3>
                        <p><strong>Cuenta:</strong> usuario123</p>
                        <p><strong>Nombre:</strong> Juan</p>
                        <p><strong>Apellido:</strong> Pérez</p>
                        <p><strong>Correo:</strong> juan.perez@example.com</p>
                    </div>
                </div>
            </div>

            <!-- Historial de Compras -->
            <div class="tab-pane fade" id="purchase-history" role="tabpanel" aria-labelledby="purchase-history-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Historial de Compras</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Compra #1 - 01/08/2024 - $50.00</li>
                            <li class="list-group-item">Compra #2 - 15/07/2024 - $30.00</li>
                            <li class="list-group-item">Compra #3 - 20/06/2024 - $70.00</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cambiar Contraseña</h3>
                        <form id="change-password-form">
                            <div class="mb-3">
                                <label for="current-password" class="form-label">Contraseña Actual</label>
                                <input type="password" class="form-control" id="current-password" placeholder="Ingresa tu contraseña actual" required>
                            </div>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="new-password" placeholder="Ingresa tu nueva contraseña" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm-new-password" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="confirm-new-password" placeholder="Confirma tu nueva contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
