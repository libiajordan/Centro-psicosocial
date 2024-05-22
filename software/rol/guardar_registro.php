<?php
try {
    $host = 'localhost'; 
    $db = 'proyecto';
    $user = 'root';
    $pass = '';

    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $pass, $db);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //datos del formulario
        $personaId = $_POST["persona_id"];
        $patologicos = $_POST["patologicos"];
        $quirurgicos = $_POST["quirurgicos"];
        $psicopatologicos = $_POST["psicopatologicos"];
        $traumaticos = $_POST["traumaticos"];
        $consumoSustancias = $_POST["consumo_sustancias"];
        $otros = $_POST["otros"];

        // Validaciones
        $validacion = "/^[a-zA-Z-'áéíóúÁÉÍÓÚüÜñÑ\s]+$/u";

        $errores = [];

        if (empty($patologicos) || !preg_match($validacion, $patologicos)) {
            $errores[] = "Por favor, ingrese información válida en Patológicos.";
        }
        if (empty($quirurgicos) || !preg_match($validacion, $quirurgicos)) {
            $errores[] = "Por favor, ingrese información válida en Quirúrgicos.";
        }
        if (empty($psicopatologicos) || !preg_match($validacion, $psicopatologicos)) {
            $errores[] = "Por favor, ingrese información válida en Psicopatológicos.";
        }
        if (empty($traumaticos) || !preg_match($validacion, $traumaticos)) {
            $errores[] = "Por favor, ingrese información válida en Traumáticos.";
        }
        if (empty($consumoSustancias) || !preg_match($validacion, $consumoSustancias)) {
            $errores[] = "Por favor, ingrese información válida en Consumo de Sustancias.";
        }

        // Si hay errores, muestra un mensaje y termina el script
        if (!empty($errores)) {
            $mensajeError = implode("<br>", $errores);
            echo '<script>alert("' . $mensajeError . '"); window.location.href = "antecedentes.php";</script>';
            exit;
        }
    }

    //consulta SQL para insertar los antecedentes en la tabla "antecedentes"
    $sql = "INSERT INTO antecedente_f (persona_id, patologicos, quirurgicos, psicopatologicos, traumaticos, consumo_sustancias, otros) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issssss", $personaId, $patologicos, $quirurgicos, $psicopatologicos, $traumaticos, $consumoSustancias, $otros);


   // Ejecuta la consulta
   if ($stmt->execute()) {
       // Muestra una alerta de éxito 
       echo '<script>alert("Registro de antecedentes exitoso."); window.location.href = "antecedentes.php";</script>';
   } else {
       // Muestra una alerta de error 
       echo '<script>alert("Error al registrar los antecedentes: ' . $stmt->error . '"); window.location.href = "antecedentes.php";</script>';
   }

   // Cierra la conexión
   $stmt->close();
   $conn->close();
} catch (Exception $e) {
   // Muestra una alerta de error 
   echo '<script>alert("Error al registrar los antecedentes: ' . $e->getMessage() . '"); window.location.href = "antecedentes.php";</script>';
}
?>

