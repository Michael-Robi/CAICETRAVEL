//Limitar cajas de texto cuentabar

function cuentabar(){
  var nombre,email,password;

  // txtId= document.getElementById("txtId").value;
  nombre= document.getElementById("nombre").value;
  email= document.getElementById("email").value;
  password= document.getElementById("password").value;

  if(nombre === "" || email === "" || password === ""){
     alert("Formulario incompleto por favor diligencie todos los campos");
     return false;
  }

  else{

    if(nombre.length<5){
      alert("El nombre del usuario es muy corto");
      return false;
    }

    if(nombre.length>20){
      alert("El nombre del usuario es muy largo");
      return false;
    }

    if(email.length<12){
      alert("El email es muy corto");
      return false;
    }

    if(email.length>45){
      alert("El email es muy largo");
      return false;
    }

    if(password.length<4){
      alert("La contraseña requiere un minimo de 4 digitos");
      return false;
    }

    if(password.length>15){
      alert("La contraseña no pude ser mayor de 15 digitos");
      return false;
    }
  }

}