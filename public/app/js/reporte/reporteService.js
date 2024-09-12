reporteService={

    reporteProgramacion: (programacion) => {
        return fetch("reporte/reporteProgramacion", {
          method: "POST", // Cambié el método a POST
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({ programacion }), // Envío el parámetro en el cuerpo de la solicitud
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
            return response.json();
          })
          .then((data) => {
            return data;
          })
          .catch((error) => {
            console.error("Error en la petición: ", error);
            throw error;
          });
      },

      reporteUsuario: (usuario) => {
        return fetch("reporte/reporteUsuario", {
          method: "POST", // Cambié el método a POST
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({ usuario }), // Envío el parámetro en el cuerpo de la solicitud
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
            return response.json();
          })
          .then((data) => {
            return data;
          })
          .catch((error) => {
            console.error("Error en la petición: ", error);
            throw error;
          });
      },

      reporteFuncion: (funcion) => {
        return fetch("reporte/reporteFuncion", {
          method: "POST", // Cambié el método a POST
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({ funcion }), // Envío el parámetro en el cuerpo de la solicitud
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
            return response.json();
          })
          .then((data) => {
            return data;
          })
          .catch((error) => {
            console.error("Error en la petición: ", error);
            throw error;
          });
      },

      reportePelicula: (pelicula) => {
        return fetch("reporte/reportePelicula", {
          method: "POST", // Cambié el método a POST
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({ pelicula }), // Envío el parámetro en el cuerpo de la solicitud
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.status);
            }
            return response.json();
          })
          .then((data) => {
            return data;
          })
          .catch((error) => {
            console.error("Error en la petición: ", error);
            throw error;
          });
      },
    }