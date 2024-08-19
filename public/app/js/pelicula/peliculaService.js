let peliculaService = {
    save: (data) => {
     return fetch("pelicula/save", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(response.status);
          }
  
          return response.json();
        }) //aca dentro está la funcion monitor
        .then((data) => {
          if (data.error != "") {
            console.log("Error Interno");
          } else {
            console.info("todo bien");
          }
  
          return data
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          throw error
        });
    },
    delete: (data) => {
     return fetch("pelicula/delete", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
  
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(response.status);
          }
  
          return response.json();
        })
        .then((data) => {
          if (data.error != "") {
            console.log("Error Interno");
          } else {
            console.info("todo bien");
          }
  
          return data
  
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          return error
        });
    },
    update: (data) => {
     return fetch("pelicula/update", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
  
        body: JSON.stringify(data),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(response.status);
          }
  
          return response.json();
        })
        .then((data) => {
          if (data.error != "") {
            console.log("Error Interno");
          } else {
            console.info("todo bien");
          }
  
          return data
        })
        .catch((error) => {
          console.error("Error en la Petición ", error);
          throw error
        });
    },
    
    load: (id) => {
      return fetch(`pelicula/load/${id}`, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
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
  
    list: () => {
      return fetch("pelicula/list", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => {
          return data; // Devuelve los datos obtenidos
        })
        .catch((error) => {
          console.error("Error en la petición de listado de perfiles:", error);
          throw error;
        });
    },
  
     loadByNameAccount: (nombre) => {
      return fetch(`pelicula/loadByNameAccount`, {
          method: "POST", // Cambié el método a POST
          headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
          },
          body: JSON.stringify({ nombre }), // Envío el parámetro en el cuerpo de la solicitud
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

    loadByPerfil: (perfil) => {
    return fetch(`pelicula/loadByPerfil`, {
        method: "POST", // Cambié el método a POST
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify({ perfil }), // Envío el parámetro en el cuerpo de la solicitud
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
}   ,



  };