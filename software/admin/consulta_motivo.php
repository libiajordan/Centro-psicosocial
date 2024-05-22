<?php
// conexión a la base de datos (asegúrate de incluir la conexión)
include("validacion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["paciente_id"])) {
    $paciente_id = $_POST["paciente_id"];

    // Consulta SQL para obtener el motivo de consulta del paciente seleccionado
    $sql = "SELECT motivo_consulta FROM persona WHERE id = $paciente_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtén el motivo de consulta
        $row = $result->fetch_assoc();
        echo "Motivo de Consulta: " . $row["motivo_consulta"];
    } else {
        echo "No se encontró motivo de consulta para este paciente.";
    }
}
?>
