<?php
include("../Modelo/Configuracion.php");

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la campaña y los datos actualizados
    $campaign_id = $_POST['campaign_id'];
    $titulo = $_POST['titulo'];
    $descripcion_corta = $_POST['descripcion_corta'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen'];

    // Verificar si se cargó una nueva imagen
    if ($imagen['size'] > 0) {
        // Verificar el tipo de imagen
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($imagen['type'], $allowed_types)) {
            echo "Error: Solo se permiten imágenes JPEG, PNG o GIF.";
            exit;
        }

        // Convertir la imagen a base64 para almacenamiento
        $imagen_base = base64_encode(file_get_contents($imagen['tmp_name']));

        // Actualizar los datos de la campaña con la nueva imagen
        $sql = "UPDATE campañas SET Nombre = ?, DescripcionCorta = ?, Descripcion = ?, Imagen = ? WHERE Id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssi", $titulo, $descripcion_corta, $descripcion, $imagen_base, $campaign_id);
    } else {
        // Actualizar los datos de la campaña sin cambiar la imagen
        $sql = "UPDATE campañas SET Nombre = ?, DescripcionCorta = ?, Descripcion = ? WHERE Id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $titulo, $descripcion_corta, $descripcion, $campaign_id);
    }

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página principal de campañas con un mensaje de éxito
        header("Location: ../Vistas/Form_CampañasEmpresa.php?mensaje=La campaña se actualizó correctamente.");
        exit;
    } else {
        // Mostrar un mensaje de error si la actualización falla
        echo "Error al actualizar la campaña: " . $stmt->error;
    }

    // Cerrar la declaración preparada y la conexión a la base de datos
    $stmt->close();
    $mysqli->close();
} else {
    // Si se intenta acceder directamente a este script sin enviar datos del formulario, redirigir a la página principal de campañas
    header("Location: ../Vistas/Form_CampañasEmpresa.php");
    exit;
}
?>