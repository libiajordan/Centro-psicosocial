<?php
session_start();

// Verifica si la variable de sesión está definida
if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso'] === true) {
    echo '<script>alert("Registro exitoso");</script>';
    
    // Limpia la variable de sesión
    unset($_SESSION['registro_exitoso']);
}

// Verifica si hay mensajes de error en las variables de sesión y los muestra
if (isset($_SESSION['error_correo'])) {
    echo '<script>alert("' . $_SESSION['error_correo'] . '");</script>';
    unset($_SESSION['error_correo']);
}

if (isset($_SESSION['error_contrasena'])) {
    echo '<script>alert("' . $_SESSION['error_contrasena'] . '");</script>';
    unset($_SESSION['error_contrasena']);
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ingreso</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/Logo-Uniclaretiana-Favicon V2.webp" rel="icon">
  <link href="assets/img/unicla.png" rel="apple-touch-icon">
  <link href="assets/css/estilo.css" rel="stylesheet">

  <style>
    select.input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
</style>

 
</head>

<body>
  
  <div class="form-structor">
    <div class="header">
      <img src="assets/img/fucla.png" alt="Logo de tu sitio" class="logo">
    </div>
  
    <div class="signup">
      <h2 class="form-title" id="signup"><span>o </span>Crea una cuenta</h2>
      <div class="form-holder">
       <form method="POST" action="registro.php">
          
          <input type="text" class="input" name="nombre" placeholder="Nombre" autocomplete="off"/> 
          <input type="email" class="input" name="email" placeholder="Email" autocomplete="off"/> 
          <input type="password" class="input" name="contrasena" placeholder="Contraseña" autocomplete="off"/>
          <select name="rol" class="input">
            <option value="1">Administrador</option>
            <option value="2">Psicólogo</option>
            <option value="3">Practicante</option>
          </select>
          <button type="submit" class="submit-btn">Crear cuenta</button>
        </form>
      </div>
    </div>
    <div class="login slide-up">
      <div class="center">
        <h2 class="form-title" id="login"><span>o </span>Ingresa</h2>
        <div class="form-holder">
         <form method="POST" action="inicio_sesion.php">
            
            <input type="email" class="input" name="email" placeholder="Email" /> 
            <input type="password" class="input" name="contrasena" placeholder="Contraseña" /> 
            <button type="submit" class="submit-btn">Ingresar</button>
          </form>
        </div>
      </div>
      
    </div>
    
  </div>
 
  
  
  <script>

    console.clear();

    const loginBtn = document.getElementById('login');
    const signupBtn = document.getElementById('signup');
    
    loginBtn.addEventListener('click', (e) => {
        let parent = e.target.parentNode.parentNode;
        Array.from(e.target.parentNode.parentNode.classList).find((element) => {
            if(element !== "slide-up") {
                parent.classList.add('slide-up')
            }else{
                signupBtn.parentNode.classList.add('slide-up')
                parent.classList.remove('slide-up')
            }
        });
    });
    
    signupBtn.addEventListener('click', (e) => {
        let parent = e.target.parentNode;
        Array.from(e.target.parentNode.classList).find((element) => {
            if(element !== "slide-up") {
                parent.classList.add('slide-up')
            }else{
                loginBtn.parentNode.parentNode.classList.add('slide-up')
                parent.classList.remove('slide-up')
            }
        });
    });

    
  </script>
</body>

</html>

