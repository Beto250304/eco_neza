<?php
include("../Modelo/Configuracion.php");

// Verificar si se ha recibido el parámetro 'Id'
if (!isset($_GET['Id'])) {
    // Si no se proporcionó el Id, redirigir a la página principal de campañas
    header("Location: ../Vistas/Form_CampañasEmpresa.php");
    exit;
}

$campaign_id = $_GET['Id'];

// Preparar la consulta para eliminar la campaña
$sql = "DELETE FROM campañas WHERE Id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $campaign_id);

// Ejecutar la consulta preparada
if ($stmt->execute()) {
    // Redirigir de vuelta a la página principal de campañas con un mensaje de éxito
    header("Location: ../Vistas/Form_CampañasEmpresa.php?mensaje=La campaña se eliminó correctamente.");
    exit;
} else {
    // Mostrar un mensaje de error si la eliminación falla
    echo "Error al eliminar la campaña: " . $stmt->error;
}

// Cerrar la declaración preparada y la conexión a la base de datos
$stmt->close();
$mysqli->close();
?>
