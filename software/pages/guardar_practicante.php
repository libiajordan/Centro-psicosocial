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
    $nombre = $_POST['nombre_practicante'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $id_medico = $_POST['medico_id']; // ID del médico seleccionado

    // Datos del formulario
    $nombre = validarCampo("nombre_practicante", "/^[a-zA-Z-' ]+$/");
    $telefono = validarCampo("telefono", "/^[0-9]+$/");
    $email = validarCampo("email", "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/");
    

    // Verificación de persona_id
    $id_medico = validarCampo("id_medico", "/^[0-9]+$/");

    

    // Consulta SQL para verificar que el ID del médico es válido
    $sqlVerificarMedico = "SELECT id_medico FROM medico WHERE id_medico = ?";
    $stmtVerificarMedico = $conn->prepare($sqlVerificarMedico);
    $stmtVerificarMedico->bind_param("i", $id_medico);
    $stmtVerificarMedico->execute();
    $resultVerificarMedico = $stmtVerificarMedico->get_result();

    if ($resultVerificarMedico->num_rows === 0) {
        // Muestra un mensaje de error o redirecciona a la página de registro
        echo '<script>alert("El valor de id_medico no es válido."); window.location.href = "practicante.php";</script>';
    } else {
        // Consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO practicantes (nombre_practicante, telefono, email, id_medico) 
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Bind de los parámetros
        $stmt->bind_param("sssi", $nombre, $telefono, $email, $id_medico);

        // Se ejecuta la consulta
        $stmt->execute();

        // Muestra una alerta de éxito
        echo '<script>alert("Registro de practicante exitoso."); window.location.href = "practicante.php";</script>';
    }
}

$conn->close();

// Función para validar campos
function validarCampo($campo, $patron)
{
    global $conn;
    $valor = $_POST[$campo];

    if (empty($valor) || !preg_match($patron, $valor)) {
        die('<script>alert("Por favor, ingrese un valor válido para ' . $campo . '."); window.location.href = "practicante.php";</script>');
    }

    // Evitar inyección SQL
    $valor = mysqli_real_escape_string($conn, $valor);

    return $valor;
}
?>
