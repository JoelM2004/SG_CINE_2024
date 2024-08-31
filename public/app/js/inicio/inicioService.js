inicioService={

list: () => {
    return fetch("inicio/list", {
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
  fetchData: (url) => {
    return fetch(url, {
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
      .catch((error) => {
        console.error(`Error en la petición de ${url}:`, error);
        throw error;
      });
  },

  loadImagen: (id) => {
    return singletonService.fetchData(`inicio/loadImagen/${id}`);
  },
}