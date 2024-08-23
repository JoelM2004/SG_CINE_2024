let comentarioService = {
  save: (data) => {
    return fetch("comentario/save", {
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
    return fetch("comentario/delete", {
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
        return error;
      });
  },
  update: (data) => {
    return fetch("comentario/update", {
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
    return fetch(`comentario/load/${id}`, {
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

  list: (pelicula) => {
    return fetch(`comentario/list`, {
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
