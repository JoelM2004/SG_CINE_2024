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

    registrarCuenta:()=>{
        let form=document.forms["register-form"]
        if(confirm("¿Quieres crear tu cuenta?")){
        if (form.apellido.value.length > 45) {
            alert("Supero el limite de caracteres con su apellido");
          } else {
            authController.dataRegister.apellido = form.apellido.value;
          }
    
          if (form.nombres.value.length > 45) {
            alert("Supero el limite de caracteres con su nombre");
          } else {
            authController.dataRegister.nombres = form.nombres.value;
          }
    
          if (form.cuenta.value.length > 45) {
            alert("Supero el limite de caracteres con su cuenta");
          } else {
            authController.dataRegister.cuenta = form.cuenta.value;
          }
    



          if (
            form.clave.value.length > 6 &&
            form.clave.value.length < 45
            && form.clave.value==form.claveConfirm.value
          ) {
            authController.dataRegister.clave = form.clave.value;
          } else {
            alert("Su clave es demasiado corta o muy largo (7 a 44 caracteres) o no coincide con la verificación solicitada");
          }
    
          if (form.correo.value.length > 255) {
            alert("El correo es muy largo");
          } else {
            authController.dataRegister.correo = form.correo.value;
          }

          authService.save(authController.dataRegister)
        .then(response => {
            if(response.error === "" && response.mensaje === "OK"){
                alert("Cuenta creda con éxito")
                window.location.href = "autentication/index"
            }
            else{
  
              alert(response.error)
  
            }
        })
    }
    }


  
    
  }
  
  document.addEventListener("DOMContentLoaded", ()=>{
    let btnLogin = document.getElementById("btnLogin")
    let btnRegister = document.getElementById("btnRegister")

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


  })