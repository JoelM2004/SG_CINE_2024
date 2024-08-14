let singletonService = {
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

  listAudio: () => {
    return singletonService.fetchData("audio/list");
  },

  loadAudio: (id) => {
    return singletonService.fetchData(`audio/load/${id}`);
  },

  listIdioma: () => {
    return singletonService.fetchData("idioma/list");
  },

  loadIdioma: (id) => {
    return singletonService.fetchData(`idioma/load/${id}`);
  },

  listGenero: () => {
    return singletonService.fetchData("genero/list");
  },

  loadGenero: (id) => {
    return singletonService.fetchData(`genero/load/${id}`);
  },

  listTipo: () => {
    return singletonService.fetchData("tipo/list");
  },

  loadTipo: (id) => {
    return singletonService.fetchData(`tipo/load/${id}`);
  },

  listPais: () => {
    return singletonService.fetchData("pais/list");
  },

  loadPais: (id) => {
    return singletonService.fetchData(`pais/load/${id}`);
  },

  listCalificacion: () => {
    return singletonService.fetchData("calificacion/list");
  },

  loadCalificacion: (id) => {
    return singletonService.fetchData(`calificacion/load/${id}`);
  },
};
