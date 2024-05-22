<?php
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
    // Datos del formulario
    $nombre = validarCampo("nombre_medico", "/^[a-zA-Z-' ]+$/");
    $telefono = validarCampo("telefono", "/^[0-9]+$/");
    $email = validarCampo("email", "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/");
    $tarjeta = validarCampo("tarjeta_profesional", "/^[a-zA-Z0-9-' ]+$/");

    // Verificación de persona_id
    $persona_id = validarCampo("persona_id", "/^[0-9]+$/");

    // Consulta SQL para verificar persona_id
    $sqlVerificarPersona = "SELECT persona_id FROM persona WHERE persona_id = ?";
    $stmtVerificarPersona = $conn->prepare($sqlVerificarPersona);
    $stmtVerificarPersona->bind_param("i", $persona_id);
    $stmtVerificarPersona->execute();
    $resultVerificarPersona = $stmtVerificarPersona->get_result();

    if ($resultVerificarPersona->num_rows === 0) {
        // Muestra un mensaje de error o redirecciona a la página de registro
        echo '<script>alert("El valor de persona_id no es válido."); window.location.href = "medicos.php";</script>';
    } else {
        // Consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO medico (persona_id, nombre_medico, telefono, email, tarjeta_profesional) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Bind de los parámetros
        $stmt->bind_param("issss", $persona_id, $nombre, $telefono, $email, $tarjeta);

        // Se ejecuta la consulta
        $stmt->execute();

        // Muestra una alerta de éxito
        echo '<script>alert("Registro de medico exitoso."); window.location.href = "medicos.php";</script>';
    }
}

$conn->close();

// Función para validar campos
function validarCampo($campo, $patron)
{
    global $conn;
    $valor = $_POST[$campo];

    if (empty($valor) || !preg_match($patron, $valor)) {
        die('<script>alert("Por favor, ingrese un valor válido para ' . $campo . '."); window.location.href = "medicos.php";</script>');
    }

    // Evitar inyección SQL
    $valor = mysqli_real_escape_string($conn, $valor);

    return $valor;
}
?>
