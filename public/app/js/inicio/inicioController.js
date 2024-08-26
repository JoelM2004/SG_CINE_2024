let inicioController = {
  list: () => {
    inicioService
      .list()
      .then((data) => {
        let carteleraContainer = document.getElementById("cartelera");
        carteleraContainer.innerHTML = ""; // Limpiar el contenedor antes de agregar nuevas tarjetas

        data.result.forEach((pelicula) => {
          // Crear la tarjeta de película

          const formatDate = (dateString) => {
            const [year, month, day] = dateString.split("-");
            return `${day}/${month}/${year}`;
          };


          let card = `<div class="card mb-4 mt-4 shadow-sm">
  <div class="row g-0">
    <!-- Imagen -->
    <div class="col-md-4">
      <img src="" class="img-fluid rounded-start h-100" style="object-fit: cover; width: 100%;" alt="Imagen de la película">
    </div>

    <!-- Contenido de la tarjeta -->
    <div class="col-md-8">
      <div class="card-body d-flex flex-column justify-content-between h-100">
        <div>
          <h5 class="card-title mb-3">${pelicula.nombre}</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Duración:</strong> ${pelicula.duracion} min</li>
            <li class="list-group-item"><strong>Género:</strong> ${pelicula.genero}</li>
            <li class="list-group-item"><strong>Calificación:</strong> ${pelicula.calificacion}</li>
            <li class="list-group-item"><strong>Fecha de Ingreso:</strong> ${formatDate(pelicula.fechaIngreso)}</li>
            <li class="list-group-item"><strong>Tipo:</strong> ${pelicula.tipo}</li>
            <li class="list-group-item"><strong>Audio:</strong> ${pelicula.audio}</li>
            <li class="list-group-item"><strong>Fecha de Estreno:</strong> ${pelicula.anoEstreno}</li>
          </ul>
        </div>
        <div class="mt-3">
          <a href="http://localhost/SG_CINE_2024/public/pelicula/view/${pelicula.id}" class="btn btn-primary">Ver Más</a>
        </div>
      </div>
    </div>
  </div>
</div>

`;


          // Agregar la tarjeta al contenedor
          carteleraContainer.insertAdjacentHTML("beforeend", card);
        });
      })
      .catch((error) => {
        console.error("Error al listar cartelera:", error);
      });
  },
};

document.addEventListener("DOMContentLoaded",inicioController.list)