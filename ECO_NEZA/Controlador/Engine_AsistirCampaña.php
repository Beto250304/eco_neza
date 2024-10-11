<?php
// Incluir la configuración de la base de datos
include("../Modelo/Configuracion.php");

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $descripcioncorta = isset($_POST['descripcioncorta']) ? $_POST['descripcioncorta'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : '';
    $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : '';

    // Preparar la consulta SQL para insertar la campaña
    $sql = "INSERT INTO campañascitas (nombre_usuario, correo, Nombre, DescripcionCorta, Descripcion, Imagen) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
        exit;
    }

    $stmt->bind_param("ssssss", $nombre_usuario, $email, $nombre, $descripcioncorta, $descripcion, $imagen);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Redirigir a la página principal de campañas con un mensaje de éxito
        header("Location: ../Vistas/Form_GraciasCitas.php?mensaje=En un momento se te enviara la informacion.");
        exit;
    } else {
        // Mostrar un mensaje de error si la inserción falla
        echo "Error al agregar la campaña: " . $stmt->error;
    }

    // Cerrar la declaración preparada y la conexión a la base de datos
    $stmt->close();
    $mysqli->close();
} else {
    // Si se intenta acceder directamente a este script sin enviar datos del formulario, redirigir a la página principal de campañas
    header("Location: ../Vistas/Form_Campañas.php");
    exit;
}
?>
