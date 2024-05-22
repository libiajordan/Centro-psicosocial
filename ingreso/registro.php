<?php
include("validacion.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // Encripta la contraseña
    $rol = $_POST["rol"]; 


    // Realiza la validación del correo electrónico
    if (preg_match("/@(practicante.com|psicologo.com|admin.com)$/", $email)){
        // El correo cumple con las condiciones, Realiza la inserción en la tabla "usuarios"
        $sql = "INSERT INTO usuarios (nombre, email, contrasena, id_rol) VALUES ('$nombre', '$email', '$contrasena', '$rol')";

        if ($conn->query($sql) === TRUE){
            session_start(); // Inicia la sesión
            $_SESSION['registro_exitoso'] = true;
            header("Location: ingreso.php");
            exit();

        } else {
            echo "Error: " . $conn->error;
        }

    } else {
        // Muestra un mensaje de error en una ventana emergente usando JavaScript y redirige a ingreso.php
        echo '<script>alert("El correo electrónico ingresado no es válido."); window.location.href = "ingreso.php";</script>';
    }
}
?>


