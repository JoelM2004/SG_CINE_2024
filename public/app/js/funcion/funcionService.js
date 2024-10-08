let funcionService = {
  save: (data) => {
    return fetch("funcion/save", {
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

        return data;
      })
      .catch((error) => {
        console.error("Error en la Petición ", error);
        throw error;
      });
  },
  delete: (data) => {
    return fetch("funcion/delete", {
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
            throw new Error(data.error); 
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
  update: (data) => {
    return fetch("funcion/update", {
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

        return data;
      })
      .catch((error) => {
        console.error("Error en la Petición ", error);
        throw error;
      });
  },

  load: (id) => {
    return fetch(`funcion/load/${id}`, {
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
    return fetch("funcion/listF", {
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

  load: (nombre) => {
    return fetch(`funcion/loadByNameAccount`, {
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

  loadByNumeroSala: (sala) => {
    return fetch(`funcion/loadByNumeroSala`, {
      method: "POST", // Cambié el método a POST
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ sala }), // Envío el parámetro en el cuerpo de la solicitud
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

  loadByFechaProgramacion: (programacion) => {
    return fetch(`funcion/loadByFechaProgramacion`, {
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

  loadByNombrePelicula: (pelicula) => {
    return fetch(`funcion/loadByNombrePelicula`, {
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

  loadByNumeroFuncion: (numeroFuncion) => {
    return fetch(`funcion/loadByNumeroFuncion`, {
      method: "POST", // Cambié el método a POST
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ numeroFuncion }), // Envío el parámetro en el cuerpo de la solicitud
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

  listFunciones: (id) => {
    return fetch(`funcion/listFunciones`, {
      method: "POST", // Cambié el método a POST
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ id }), // Envío el parámetro en el cuerpo de la solicitud
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
