<?php
// Verificar si se ha enviado un ID de cita para eliminar
if (isset($_POST['cita_id'])) {
    // Incluir el archivo de configuración de la base de datos
    include("../Modelo/Configuracion.php");

    // Preparar y ejecutar la consulta SQL para eliminar la cita por ID
    $cita_id = $_POST['cita_id'];
    $sql = "DELETE FROM citas WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $cita_id);

    if ($stmt->execute()) {
        // Redireccionar de vuelta a la página de citas después de la eliminación
        header("Location: ../vistas/Form_citas_admi.php");
        exit();
    } else {
        // Manejo de errores si la eliminación falla
        echo "Error al intentar eliminar la cita: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $mysqli->close();
} else {
    // Si no se recibió un ID válido, redirigir de vuelta a la página de citas
    header("Location: ../vistas/Form_citas_admi.php");
    exit();
}
?>
