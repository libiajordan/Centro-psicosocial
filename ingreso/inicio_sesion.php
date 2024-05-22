<?php

include("validacion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Realiza la validación del correo electrónico
    if (preg_match("/@(practicante.com|psicologo.com|admin.com)$/", $email)) {
        // El correo cumple con las condiciones
        // Consulta la contraseña almacenada en la base de datos
        $sql = "SELECT id, email, contrasena, id_rol FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $contrasena_hash = $row["contrasena"];

            // Verifica la contraseña ingresada
            if (password_verify($contrasena, $contrasena_hash)) {
                // Inicia la sesión y redirige al usuario a la dashboard correspondiente
                session_start();
                $_SESSION["usuario_id"] = $row["id"];

                // Redirección basada en el rol del usuario
                switch ($row["id_rol"]) {
                    case "1":
                        header("Location: /Centro_psicosocial2/software/admin/dashboard.php");
                        break;
                    case "2":
                        header("Location: ../software/pages/dashboard.php");
                        break;
                    case "3":
                        header("Location: /Centro_psicosocial2/software/rol/dashboard.php");
                        break;
                    default:
                        // Tipo de usuario desconocido, manejar según sea necesario
                        header("Location: ../ingreso/ingreso.php");
                        break;
                }
                exit();
            } else {
                // Muestra un mensaje de error en una ventana emergente con JavaScript
                echo '<script>alert("Contraseña incorrecta");</script>';
                header("Location: ingreso.php"); // Redirige de vuelta a ingreso.php
                exit();
            }
        } else {
            // Muestra un mensaje de error en una ventana emergente con JavaScript
            echo '<script>alert("Correo electrónico no encontrado");</script>';
            header("Location: ingreso.php"); // Redirige de vuelta a ingreso.php
            exit();
        }
    } else {
        // Muestra un mensaje de error en una ventana emergente con JavaScript
        echo '<script>alert("Correo electrónico no válido.");</script>';
        header("Location: ingreso.php"); // Redirige de vuelta a ingreso.php
        exit();
    }
}
?>
