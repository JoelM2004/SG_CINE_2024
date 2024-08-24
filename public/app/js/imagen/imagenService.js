let imagenService = {
    
  save: (formData) => {
    return fetch("imagen/save", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(response.status);
        }
        return response.json();
      })
      .then((data) => {
        if (data.error !== "") {
          console.log("Error Interno");
        } else {
          console.info("Todo bien");
        }
        return data;
      })
      .catch((error) => {
        console.error("Error en la Petición ", error);
        throw error;
      });
  },

  //     delete: (data) => {
  //       return fetch("imagen/delete", {
  //           method: "POST",
  //           headers: {
  //             "Content-Type": "application/json",
  //             Accept: "application/json",
  //           },
  //           body: JSON.stringify(data),
  //       })
  //       .then((response) => {
  //           if (!response.ok) {
  //               throw new Error(`HTTP error! Status: ${response.status}`);
  //           }
  //           return response.json();
  //       })
  //       .then((data) => {
  //           if (data.error) {
  //               console.error("Error Interno:", data.error);
  //               throw new Error(data.error); // Lanzar error para ser capturado en el catch
  //           } else {
  //               console.info("Operación exitosa");
  //               return data; // Devolver datos en caso de éxito
  //           }
  //       })
  //       .catch((error) => {
  //           console.error("Error en la Petición:", error);
  //           throw new Error("Existe un usuario que utiliza este imagen"); // Lanzar error general
  //       });
  //   },

  //     load: (id) => {
  //       return fetch(`imagen/load/${id}`, {
  //         method: "GET",
  //         headers: {
  //           "Content-Type": "application/json",
  //           Accept: "application/json",
  //         },
  //       })
  //         .then((response) => {
  //           if (!response.ok) {
  //             throw new Error(response.status);
  //           }
  //           return response.json();
  //         })
  //         .then((data) => {
  //           return data;
  //         })
  //         .catch((error) => {
  //           console.error("Error en la petición: ", error);
  //           throw error;
  //         });
  //     },

  //     update: (data) => {
  //       return fetch("imagen/update", {
  //         method: "POST",
  //         headers: {
  //           "Content-Type": "application/json",
  //           Accept: "application/json",
  //         },

  //         body: JSON.stringify(data),
  //       })
  //         .then((response) => {
  //           if (!response.ok) {
  //             throw new Error(response.status);
  //           }

  //           return response.json();
  //         })
  //         .then((data) => {
  //           if (data.error != "") {
  //             console.log("Error Interno");
  //           } else {
  //             console.info("todo bien");
  //           }
  //           return data
  //         })

  //         .catch((error) => {
  //           console.error("Error en la Petición ", error);
  //           throw error
  //         });
  //     },

  //     list: () => {
  //       return fetch("imagen/list", {
  //         method: "GET",
  //         headers: {
  //           "Content-Type": "application/json",
  //           Accept: "application/json",
  //         },
  //       })
  //         .then((response) => {
  //           if (!response.ok) {
  //             throw new Error(`HTTP error! Status: ${response.status}`);
  //           }
  //           return response.json();
  //         })
  //         .then((data) => {
  //           return data; // Devuelve los datos obtenidos
  //         })
  //         .catch((error) => {
  //           console.error("Error en la petición de listado de imagenes:", error);
  //           throw error;
  //         });
  //     },
};
