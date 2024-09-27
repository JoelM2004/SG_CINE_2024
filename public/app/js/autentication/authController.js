let authController = {
    data: {
        usuario: "joel1234",
        contrasena: "joel1234"
    },
  
   /* cuenta usuario ADMIN:
   contraseña 123456
    */

    dataRegister:{
        id:0,
        cuenta:"",
        nombres:"",
        clave:"",
        correo:"",
        perfilId:2,
        apellido:""

    },
    
    dataForget:{
      correo:""

    }
    ,

    forgetPassword:()=>{
        if (!confirm("¿Quieres solicitar una nueva contraseña?")) {
            return;
        }
    
        let form = document.forms["password-reset-form"];
        
        // Validación del correo
        if (form.email.value.length > 255 || form.email.value.length < 5) {
            alert("Introduzca un correo válido");
            return;
        } else {
            authController.dataForget.correo = form.email.value;
        }
    
        // Mostrar el spinner y deshabilitar el botón
        document.getElementById('loading-spinner').style.display = 'block';
        document.getElementById('btnforgetAuth').disabled = true;
    
        // Realizar la solicitud
        authService.forgetPassword(authController.dataForget)
            .then(response => {
                // Ocultar el spinner
                document.getElementById('loading-spinner').style.display = 'none';
                document.getElementById('btnforgetAuth').disabled = false;
    
                if (response.error == "") {
                    alert("Clave generada con éxito, revise su correo para obtener la nueva clave");
                    console.log(response);
                    window.location.href = "autentication/index";
                } else {
                    alert(response.error);
                }
            })
            .catch(error => {
                // Ocultar el spinner
                document.getElementById('loading-spinner').style.display = 'none';
                document.getElementById('btnforgetAuth').disabled = false;
    
                // Manejo de errores
                alert("Ocurrió un error al procesar la solicitud. Por favor, inténtelo de nuevo.");
                console.error(error);
            });
    }

    ,

    login: ()=>{
        let form = document.forms["auth-form"];
  
        authController.data.usuario=form.username.value;
        authController.data.clave=form.password.value
  
        authService.login(authController.data)
        .then(response => {
            if(response.error === "" && response.mensaje === "OK"){
                window.location.href = "inicio/index"
            }
            else{
  
              alert(response.error)
  
            }
        })
    }
  ,

  registrarCuenta: () => {
    let form = document.forms["register-form"];
    
    if (!confirm("¿Quieres crear tu cuenta?")) {
        return;
    }
    
    // Validación del apellido
    if (form.apellido.value.length > 45 ) {
        alert("El apellido supera el límite de caracteres permitidos (45).");
        return;
    } else {
        authController.dataRegister.apellido = form.apellido.value;
    }
    
    // Validación del nombre
    if (form.nombres.value.length > 45) {
        alert("El nombre supera el límite de caracteres permitidos (45).");
        return;
    } else {
        authController.dataRegister.nombres = form.nombres.value;
    }
    
    // Validación del nombre de usuario
    if (form.cuenta.value.length > 45) {
        alert("El nombre de usuario supera el límite de caracteres permitidos (45).");
        return;
    } else {
        authController.dataRegister.cuenta = form.cuenta.value;
    }
    
    // Validación de la contraseña
    const password = form.clave.value;
    const confirmPassword = form.claveConfirm.value;
    
    if (password.length < 7 || password.length > 44) {
        alert("La contraseña debe tener entre 7 y 44 caracteres.");
        return;
    }
    
    if (password !== confirmPassword) {
        alert("La contraseña y su confirmación no coinciden.");
        return;
    }
    
    // Validación del correo electrónico
    const email = form.correo.value;
    if (email.length > 255) {
        alert("El correo electrónico es demasiado largo.");
        return;
    }
    
    // Validación de formato de correo electrónico
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("El formato del correo electrónico no es válido.");
        return;
    }
    
    authController.dataRegister.clave = password;
    authController.dataRegister.correo = email;
    
    // Llamada al servicio para guardar los datos
    authService.save(authController.dataRegister)
        .then(response => {
            if (response.error =="") {
                alert("Cuenta creada con éxito.");
                window.location.href = "autentication/index";
            } else {
                alert(response.error);
            }
        })
        .catch(error => {
            // Manejo de errores en caso de fallo en la llamada al servicio
            alert("Ocurrió un error al crear la cuenta. Por favor, inténtelo de nuevo.");
            console.error(error);
        });
}



  
    
  }
  
  document.addEventListener("DOMContentLoaded", ()=>{
    let btnLogin = document.getElementById("btnLogin")
    let btnRegister = document.getElementById("btnRegister")
    let btnforgetAuth=document.getElementById("btnforgetAuth");

    if(btnLogin!=null){

    btnLogin.onclick = () => {
        authController.login()
    }
    }

    if(btnRegister!=null){

        btnRegister.onclick = () => {
            authController.registrarCuenta()
        }
        }

      if(btnforgetAuth!=null){

        btnforgetAuth.onclick = () => {
              authController.forgetPassword()
          }
          }
  })