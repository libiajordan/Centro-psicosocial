<?php
include 'validacion.php'; // Incluye el archivo de conexión

if (isset($_GET["paciente_id"])) {
    $pacienteId = $_GET["paciente_id"];

    // Prepara y ejecuta una consulta SQL para obtener el motivo de consulta del paciente
    $sql = "SELECT motivo_consulta FROM persona WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pacienteId);
    $stmt->execute();
    $stmt->bind_result($motivoConsulta);

    if ($stmt->fetch()) {
        // Devuelve el motivo de consulta como respuesta
        echo $motivoConsulta;
    } else {
        echo "Motivo de consulta no encontrado.";
    }
}

// Coloca aquí la lógica para cerrar la conexión a la base de datos si es necesario
?>
