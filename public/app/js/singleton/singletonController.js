let singletonController = {
  loadAudio: async (id) => {
    console.log("Cargando Audio...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadAudio(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Audio cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Audio.");
      }
    
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

  loadIdioma: async (id) => {
    console.log("Cargando Idioma...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadIdioma(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Idioma cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Idioma.");
      }
    
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

  loadGenero: async (id) => {
    console.log("Cargando Genero...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadGenero(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Genero cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Genero.");
      }
    
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

  loadTipo: async (id) => {
    console.log("Cargando Tipo...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadTipo(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Tipo cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Tipo.");
      }
    
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

  loadPais: async (id) => {
    console.log("Cargando Pais...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadPais(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Pais cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Pais.");
      }
    
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

  loadCalificacion: async (id) => {
    console.log("Cargando Calificacion...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadCalificacion(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Calificacion cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Calificacion.");
      }
    
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

  loadPerfil: async (id) => {
    console.log("Cargando Perfil...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadPerfil(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Perfil cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Perfil.");
      }
    
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

  loadSala: async (id) => {
    console.log("Cargando Sala...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadSala(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Sala cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Sala.");
      }
    
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

  loadPelicula: async (id) => {
    console.log("Cargando Pelicula...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadPelicula(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Pelicula cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Pelicula.");
      }
    
  },

  loadUsuario: async (id) => {
    console.log("Cargando Usuario...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadUsuario(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Usuario cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el usuario.");
      }
    
  },

  loadFuncion: async (id) => {
    console.log("Cargando Funcion...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadFuncion(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Funcion cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Funcion.");
      }
    
  },

  ////////////////////////////////////////////////////////////////////

  loadImagen: async (id) => {
    console.log("Cargando Usuario...");
  
      // Llamar al servicio para cargar el usuario
      let data = await singletonService.loadImagen(id);
  
      // Verificar y retornar el resultado
      if (data && data.result) {
        console.log("Imagen cargado:", data);
        return data.result; // Devolver el objeto de usuario
      } else {
        throw new Error("No se encontró el Imagen.");
      }
    
  },

  listImagenes: async (id) => {
    console.log("Listando Peliculas...");

    let array = [];
    
    await singletonService
      .listImagenes(id)
      .then((data) => {
        console.log("Imagenes listadas:", data);
        data.result.forEach((element) => {
          array.push(element);
        });
      })
      .catch((error) => {
        console.error("Error al listar Imagenes:", error);
      });

    return array;
  },

};
