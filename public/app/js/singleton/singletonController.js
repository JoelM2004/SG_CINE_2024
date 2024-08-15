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

  listAudio:async () => {
    console.log("Listando audios...");

    let array = [];
    await singletonService
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

  listIdioma:async () => {
    console.log("Listando idiomas...");

    let array = [];
    await singletonService
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

  listGenero:async () => {
    console.log("Listando géneros...");

    let array = [];
    await singletonService
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

  listTipo:async () => {
    console.log("Listando Tipos...");

    let array = [];
    await singletonService
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

  listPais:async () => {
    console.log("Listando Países...");

    let array = [];
    await singletonService
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

  listCalificacion:async () => {
    console.log("Listando Calificaciones...");

    let array = [];
    await singletonService
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

  loadPerfil: (id) => {
    let result;

     singletonService
      .loadPerfil(id)
      .then((data) => {
        console.log("Perfil listada:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar Perfil:", error);
      });

    return result;
  },

  listPerfil: async () => {
    console.log("Listando Perfiles...");

    let array = [];
    
    await singletonService
      .listPerfil()
      .then((data) => {
        console.log("Perfiles listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Perfiles:", error);
      });

    return array;
  },
};
