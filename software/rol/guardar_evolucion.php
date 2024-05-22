<?php
// Verificación del envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["persona_id"]) && isset($_POST["evolucion"]) && isset($_POST["medico_id"]) && isset($_POST["id_practicante"]) && isset($_POST["fecha_evolucion"])) {
    // Datos del formulario
    $personaId = $_POST["persona_id"];
    $evolucion = $_POST["evolucion"];
    $medicoId = $_POST["medico_id"];
    $practicanteId = $_POST["id_practicante"];
    $fechaEvolucion = $_POST["fecha_evolucion"]; 

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

    // Consulta SQL para insertar la evolución con la fecha_evolucion
    $sql = "INSERT INTO evolucion (persona_id, evolucion, id_medico, id_practicante, fecha_evolucion) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $personaId, $evolucion, $medicoId, $practicanteId, $fechaEvolucion);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo '<script>alert("Evolución guardada exitosamente."); window.location.href = "seguimiento.php";</script>';
    } else {
        echo "Error al guardar la evolución: " . $stmt->error;
    }

    // Cierra la conexión y la sentencia preparada
    $stmt->close();
    $conn->close();
} else {
    echo "Error: No se han proporcionado datos válidos para guardar la evolución.";
}
?>
