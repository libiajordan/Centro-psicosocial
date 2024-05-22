<?php
try {
    
    $host = 'localhost'; 
    $db = 'proyecto';
    $user = 'root';
    $pass = '';

    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $pass, $db);

    // Verificación de la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //datos del formulario
        $nombre = $_POST["nombre"];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $fechaNacimiento = date("Y-m-d", strtotime($fechaNacimiento));
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $numeroIdentificacion = $_POST['numeroIdentificacion'];
        $ocupacion = $_POST['ocupacion'];
        $religion = $_POST['religion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $remitido = $_POST['remitido'];
        $motivoConsulta = $_POST['motivoConsulta'];

        // Validaciones
        if (empty($nombre) || !preg_match("/^[a-zA-Z-' ]+$/", $nombre)) {
            throw new Exception("Por favor, ingrese un nombre y apellido válido.");
        }

        if (empty($numeroIdentificacion) || !preg_match("/^[0-9]+$/", $numeroIdentificacion)) {
            throw new Exception("Por favor, ingrese un número de identificación válido.");
        }

        if (empty($ocupacion) || !preg_match("/^[a-zA-Z-' ]+$/", $ocupacion)) {
            throw new Exception("Por favor, ingrese una ocupación válida.");
        }

        if (empty($religion) || !preg_match("/^[a-zA-Z-' ]+$/", $religion)) {
            throw new Exception("Por favor, ingrese una religión válida.");
        }

        

    }
    
    //consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO persona (nombre, fecha_nacimiento, tipo_identificacion, numero_identificacion, ocupacion, religion, telefono, email, remitido_por, motivo_consulta) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    // Bind de los parámetros
    $stmt->bind_param("ssssssssss", $nombre, $fechaNacimiento, $tipoIdentificacion, $numeroIdentificacion, $ocupacion, $religion, $telefono, $email, $remitido, $motivoConsulta);

    // Se ejecuta la consulta
    $stmt->execute();

    // Muestra una alerta 
    echo '<script>alert("Registro de paciente exitoso."); window.location.href = "pacientes.php";</script>';
} catch (Exception $e) {
    // Muestra una alerta de error utilizando JavaScript
    echo '<script>alert("Error al registrar al paciente: ' . $e->getMessage() . '"); window.location.href = "pacientes.php";</script>';
}

// Cierra la conexión
if ($conn) {
    $conn->close();
}
?>
