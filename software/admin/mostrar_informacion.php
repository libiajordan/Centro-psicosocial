<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["persona_id"])) {
    $persona_id = $_POST["persona_id"];
    
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

    // Consulta SQL para obtener la información de la persona seleccionada
    $sql = "SELECT p.nombre, p.fecha_nacimiento, p.motivo_consulta, m.nombre_medico AS nombre_medico
            FROM persona AS p
            INNER JOIN medico AS m ON p.persona_id = m.persona_id
            WHERE p.persona_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $persona_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Mostrar la información de la persona
        echo "<h3>Información de la Persona:</h3>";
        echo "<p>Nombre: " . $row["nombre"] . "</p>";
        echo "<p>Fecha de Nacimiento: " . $row["fecha_nacimiento"] . "</p>";
        echo "<p>Motivo de Consulta: " . $row["motivo_consulta"] . "</p>";
        echo "<p>Médico: " . $row["nombre_medico"] . "</p>";
    } else {
        echo "No se encontró información para la persona seleccionada.";
    }

    // Cierra la conexión
    $conn->close();
}
?>
