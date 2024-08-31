let inicioController = {
  list: async () => {
    
        const data = await inicioService.list();
        let carteleraContainer = document.getElementById("cartelera");
        carteleraContainer.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevas tarjetas

        data.result.forEach(async (pelicula) => {
            // Crear la tarjeta de película

            let imagen = await inicioController.loadImagen(pelicula.id);
            const formatDate = (dateString) => {
                const [year, month, day] = dateString.split("-");
                return `${day}/${month}/${year}`;
            };

            let card = `<div class="container mt-5 d-flex justify-content-center flex-column align-items-center">
                <!-- Tarjeta de Película -->
                <div class="card mb-4 mt-4 shadow-sm w-75">
                    <div class="row g-0">
                        <!-- Contenido de la tarjeta -->
                        <div class="col-md-8">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div>
                                    <h5 class="card-title mb-3"><i class="fas fa-film"></i> ${pelicula.nombre}</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="far fa-clock"></i> <strong>Duración:</strong> ${pelicula.duracion} min</li>
                                        <li class="list-group-item"><i class="fas fa-theater-masks"></i> <strong>Género:</strong> ${pelicula.genero}</li>
                                        <li class="list-group-item"><i class="fas fa-star"></i> <strong>Calificación:</strong> ${pelicula.calificacion} ⭐</li>
                                        <li class="list-group-item"><i class="fas fa-calendar-alt"></i> <strong>Fecha de Ingreso:</strong> ${formatDate(pelicula.fechaIngreso)}</li>
                                        <li class="list-group-item"><i class="fas fa-tags"></i> <strong>Tipo:</strong> ${pelicula.tipo}</li>
                                        <li class="list-group-item"><i class="fas fa-headphones-alt"></i> <strong>Audio:</strong> ${pelicula.audio}</li>
                                        <li class="list-group-item"><i class="fas fa-calendar-check"></i> <strong>Año de Estreno:</strong> ${pelicula.anoEstreno} 📅</li>
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <a href="http://localhost/SG_CINE_2024/public/pelicula/view/${pelicula.id}" class="btn btn-primary">
                                        <i class="fas fa-info-circle"></i> Ver Más
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Imagen -->
                        <div class="col-md-4">
                            <img src="${imagen}" class="img-fluid rounded-end h-100" style="object-fit: cover; width: 100%;" alt="Imagen de la película">
                        </div>
                    </div>
                </div>
                <!-- Puedes repetir esta estructura de tarjeta para mostrar más películas -->
            </div>`;

            // Agregar la tarjeta al contenedor
            carteleraContainer.insertAdjacentHTML("beforeend", card);
        });
    
},

loadImagen: async (id) => {
    console.log("Cargando Usuario...");
  
      // Llamar al servicio para cargar el usuario
      let data = await inicioService.loadImagen(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Imagen cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        return ""
      }
    
  }}

document.addEventListener("DOMContentLoaded",inicioController.list)