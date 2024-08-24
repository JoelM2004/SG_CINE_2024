let authService = {
    login: (data)=>{
        return fetch("autentication/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if(!response.ok){
                throw new Error(response.status)
            }
            return response.json()
        })
        .catch(error => {
            console.error("ERROR EN LA PETICION", error)
        })
    }
    ,
    save: (data) => {
        return fetch("autentication/registrarCuenta", {
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

    
}