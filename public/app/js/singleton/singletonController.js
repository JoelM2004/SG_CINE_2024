let singletonController = {
  loadAudio: (id) => {
    let result;
    
    singletonService
      .loadAudio(id)
      .then((data) => {
        console.log("Audio listado:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar perfiles:", error);
      });

    return result;
  },

  listAudio: () => {
    console.log("Listando audios...");

    let array = [];
    singletonService
      .listAudio()
      .then((data) => {
        console.log("Audios listados:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar audios:", error);
      });

    return array;
  },

  loadIdioma: (id) => {
    let result;

    singletonService
      .loadIdioma(id)
      .then((data) => {
        console.log("Idioma listado:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar idiomas:", error);
      });

    return result;
  },

  listIdioma: () => {
    console.log("Listando idiomas...");

    let array = [];
    singletonService
      .listIdioma()
      .then((data) => {
        console.log("idiomas listados:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar idiomas:", error);
      });

    return array;
  },

  loadGenero: (id) => {
    let result;

    singletonService
      .loadGenero(id)
      .then((data) => {
        console.log("Género listado:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar géneros:", error);
      });

    return result;
  },

  listGenero: () => {
    console.log("Listando géneros...");

    let array = [];
    singletonService
      .listGenero()
      .then((data) => {
        console.log("géneros listados:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar géneros:", error);
      });

    return array;
  },

  loadTipo: (id) => {
    let result;

    singletonService
      .loadTipo(id)
      .then((data) => {
        console.log("Tipo listado:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar Tipos:", error);
      });

    return result;
  },

  listTipo: () => {
    console.log("Listando Tipos...");

    let array = [];
    singletonService
      .listTipo()
      .then((data) => {
        console.log("Tipos listados:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Tipos:", error);
      });

    return array;
  },

  loadPais: (id) => {
    let result;

    singletonService
      .loadPais(id)
      .then((data) => {
        console.log("País listado:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar Países:", error);
      });

    return result;
  },

  listPais: () => {
    console.log("Listando Países...");

    let array = [];
    singletonService
      .listPais()
      .then((data) => {
        console.log("Países listados:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Países:", error);
      });

    return array;
  },

  loadCalificacion: (id) => {
    let result;

    singletonService
      .loadCalificacion(id)
      .then((data) => {
        console.log("Calificacion listada:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar Calificaciones:", error);
      });

    return result;
  },

  listCalificacion: () => {
    console.log("Listando Calificaciones...");

    let array = [];
    singletonService
      .listCalificacion()
      .then((data) => {
        console.log("Calificaciones listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Calificaciones:", error);
      });

    return array;
  },
};
