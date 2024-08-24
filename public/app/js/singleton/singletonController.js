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

  listFuncion: async () => {
    console.log("Listando Funciones...");

    let array = [];
    
    await singletonService
      .listFuncion()
      .then((data) => {
        console.log("Funciones listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar funciones:", error);
      });

    return array;
  },

  listUsuario: async () => {
    console.log("Listando Usuarios...");

    let array = [];
    
    await singletonService
      .listUsuario()
      .then((data) => {
        console.log("Usuarios listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Usuarios:", error);
      });

    return array;
  },

  ////////////////////////////////////////////////////////////////////

  listProgramacion: async () => {
    console.log("Listando Programaciones...");

    let array = [];
    
    await singletonService
      .listProgramacion()
      .then((data) => {
        console.log("Programaciones listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Programaciones:", error);
      });

    return array;
  },

  listSala: async () => {
    console.log("Listando Salas...");

    let array = [];
    
    await singletonService
      .listSala()
      .then((data) => {
        console.log("Salas listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Salas:", error);
      });

    return array;
  },

  loadSala: (id) => {
    let result;

     singletonService
      .loadSala(id)
      .then((data) => {
        console.log("Sala listada:", data);

        result = data.result;
      })
      .catch((error) => {
        console.error("Error al listar Sala:", error);
      });

    return result;
  },

  listPelicula: async () => {
    console.log("Listando Peliculas...");

    let array = [];
    
    await singletonService
      .listPelicula()
      .then((data) => {
        console.log("Peliculas listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Peliculas:", error);
      });

    return array;
  },

  loadPelicula: (id) => {
    let result;

     singletonService
      .loadPelicula(id)
      .then((data) => {
        console.log("Película listada:", data);

        return data.result;
      })
      .catch((error) => {
        console.error("Error al listar Película:", error);
      });

    
  },

  loadUsuario: (id) => {
    let result;

     singletonService
      .loadUsuario(id)
      .then((data) => {
        console.log("Película listada:", data);

        return data.result;
      })
      .catch((error) => {
        console.error("Error al listar Película:", error);
      });

    
  },
};
