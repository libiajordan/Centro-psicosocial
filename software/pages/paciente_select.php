<?php
include 'validacion.php'; 

//lista de pacientes desde la base de datos
$sql = "SELECT persona_id, nombre FROM persona";
$result = $conn->query($sql);

//arreglo para almacenar los pacientes
$pacientes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pacientes[$row['persona_id']] = $row['nombre'];
    }
}
?>

<!-- elemento select en el formulario de medicos.php -->
<label for="paciente_id">Seleccione un paciente:</label>
<select id="persona_id" name="persona_id">
    <option value="">Seleccione un paciente</option>
    <?php
    foreach ($pacientes as $id => $nombre) {
        echo "<option value='$id'>$nombre</option>";
    }
    ?>
</select>

<?php

$conn->close();
?>
