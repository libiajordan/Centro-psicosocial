<?php
include("validacion.php");

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear_seguimiento"])) {
    // Recoger datos del formulario
    $fecha_sesion = $_POST["fecha_sesion"];
    $id_paciente = $_POST["persona_id"];
    $id_medico = $_POST["medico_id"];
    $id_practicante = $_POST["id_practicante"];
    $objetivos = $_POST["objetivos"];
    $estado_paciente = $_POST["estado_paciente"];
    $tareas = $_POST["tareas"];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO sesiones (fecha_sesion, id_paciente, id_medico, id_practicante, objetivos, estado_paciente, tareas) VALUES ('$fecha_sesion', $id_paciente, $id_medico, $id_practicante, '$objetivos', '$estado_paciente', '$tareas')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Sesión registrada exitosamente."); window.location.href = "sesiones.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error al registrar la sesión: ' . $conn->error . '"); window.location.href = "sesiones.php";</script>';
        exit();
    }
}
?>


