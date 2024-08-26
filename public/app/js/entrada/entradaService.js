let entradaService = {
    save: (data) => {
     return fetch("entrada/save", {
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
     return fetch("entrada/delete", {
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
     return fetch("entrada/update", {
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
      return fetch(`entrada/load/${id}`, {
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
  
    list: async () => {
      return fetch("entrada/list", {
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
          console.error("Error en la petición de listado de entradas:", error);
          throw error;
        });
    },
    
    cantidadEntradaDisponibles: (funcion) => {
      return fetch(`entrada/cantidadEntradasDisponibles`, {
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

     loadByCuenta: (cuenta) => {
      return fetch(`entrada/loadByCuenta`, {
          method: "POST", // Cambié el método a POST
          headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
          },
          body: JSON.stringify({ cuenta }), // Envío el parámetro en el cuerpo de la solicitud
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

  loadByFuncion: (funcion) => {
    return fetch(`entrada/loadByFuncion`, {
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

loadByNumeroTicket: (numeroTicket) => {
    return fetch(`entrada/loadByNumeroTicket`, {
        method: "POST", // Cambié el método a POST
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify({ numeroTicket }), // Envío el parámetro en el cuerpo de la solicitud
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
loadByProgramacion: (programacion) => {
  return fetch(`entrada/loadByProgramacion`, {
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

loadByPelicula: (pelicula) => {
  return fetch(`entrada/loadByPelicula`, {
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
  };