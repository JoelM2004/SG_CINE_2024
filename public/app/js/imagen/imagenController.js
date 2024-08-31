let imagenController = {
    data: {
        id: 0,
        peliculaId: 0,
        imagen: "",
        estado: 0,
        tipo:""
    },
    
    save: () => {
        if (confirm("¿Quieres guardar la foto?")) {
            imagenController.data.peliculaId = parseInt(document.getElementById("borrarPelicula").dataset.id);
            imagenController.data.estado = parseInt(document.getElementById("esPortada").value);
            const inputFile = document.getElementById("inputImagen").files[0]; // Cambiado a .files[0]
            if (inputFile) {
                const fileType = inputFile.type;
                const formData = new FormData();
                formData.append("id", 0);
                formData.append("peliculaId", imagenController.data.peliculaId);
                formData.append("imagen", inputFile);
                formData.append("estado", imagenController.data.estado);
                formData.append("tipo",fileType)
                
                imagenService.save(formData)
                    .then((data) => {
                        console.log("Guardando Datos");
                        if (data.error !== "") {
                            alert("Error al guardar la imagen: " + data.error);
                        } else {
                            alert("Imagen guardada con éxito");
                            setTimeout(() => {
                                location.reload();
                            }, 300);
                        }
                    })
                    .catch((error) => {
                        console.error("Error en la Petición ", error);
                        alert("Ocurrió un error al guardar la imagen");
                    });
            } else {
                alert("Por favor, seleccione una imagen para subir.");
            }
        }
    }

    ,

    // loadImagen:()=>{

    //     imagenController.data.id=parseInt(document.getElementById("borrarPelicula").dataset.id);

    //     imagenService.loadImagen(imagenController.data)
    //                 .then((data) => {
    //                     console.log("Guardando Datos");
    //                     if (data.error !== "") {
    //                         alert("Error al guardar la imagen: " + data.error);
    //                     } else {
    //                         alert("Imagen guardada con éxito");
    //                         setTimeout(() => {
    //                             location.reload();
    //                         }, 300);
    //                     }
    //                 })
    //                 .catch((error) => {
    //                     console.error("Error en la Petición ", error);
    //                     alert("Ocurrió un error al guardar la imagen");
    //                 });
    // }        

}


document.addEventListener("DOMContentLoaded",()=>{


    btnAgregarImagen=document.getElementById("btnAgregarImagen")


    if(btnAgregarImagen!=null){
        // imagenController.loadImagen()
        btnAgregarImagen.onclick=imagenController.save
    }

})