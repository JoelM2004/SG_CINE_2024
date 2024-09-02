let salaService = {
    save: (data) => {
      return fetch("sala/save", {
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
  
    delete: (data) => {
      return fetch("sala/delete", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify(data),
      })
      .then((response) => {
          if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
      })
      .then((data) => {
          if (data.error) {
              console.error("Error Interno:", data.error);
              throw new Error(data.error); // Lanzar error para ser capturado en el catch
          } else {
              console.info("Operación exitosa");
              return data; // Devolver datos en caso de éxito
          }
      })
      .catch((error) => {
          console.error("Error en la Petición:", error);
          throw new Error(error); // Lanzar error general
      });
  },
  
    load: (id) => {
      return fetch(`sala/load/${id}`, {
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
  
    update: (data) => {
      return fetch("sala/update", {
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
    
    list: () => {
      return fetch("sala/list", {
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
          console.error("Error en la petición de listado de salaes:", error);
          throw error;
        });
    },

    loadByCapacidad: (min,max) => {
      // console.log("Enviando solicitud con datos:", dato)
      return fetch(`sala/loadByCapacidad`, {
          method: "POST", // Cambié el método a POST
          headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
          },
          body: JSON.stringify({ min,max }), // Envío el parámetro en el cuerpo de la solicitud
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
  

  loadByEstado: (estado) => {
    return fetch(`sala/loadByEstado`, {
        method: "POST", // Cambié el método a POST
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify({ estado }), // Envío el parámetro en el cuerpo de la solicitud
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


loadByNumeroSala: (numeroSala) => {
  return fetch(`sala/loadByNumeroSala`, {
      method: "POST", // Cambié el método a POST
      headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
      },
      body: JSON.stringify({ numeroSala }), // Envío el parámetro en el cuerpo de la solicitud
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

    

  };