let imagenController = {
    data: {
        id: 0,
        peliculaId: 0,
        imagen: "",
    },
    
    save: () => {
        imagenController.data.peliculaId = 2;

        const inputFile = document.getElementById("imagen1");
        if (inputFile.files.length > 0) {
            const formData = new FormData();
            formData.append("peliculaId", imagenController.data.peliculaId);
            formData.append("imagen", inputFile.files[0]);

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