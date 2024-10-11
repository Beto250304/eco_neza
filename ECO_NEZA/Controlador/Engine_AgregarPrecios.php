<?php
include("../Modelo/Configuracion.php");

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreempresa = $_POST['nombre'];
    $material = $_POST['material'];
    $compra = $_POST['compra'];
    $venta = $_POST['venta'];

    // Procesar la imagen
    if ($_FILES['imagen']['size'] > 0) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        $ruta_imagen = '../Resources/' . $imagen_nombre; // Ruta relativa de la imagen
        
        // Mover la imagen a la carpeta resources
        move_uploaded_file($imagen_temp, $ruta_imagen);
    } else {
        $ruta_imagen = null; // Opcional: definir un valor por defecto si no se carga una imagen
    }

    // Preparar la consulta SQL para insertar la campaña
    $sql = "INSERT INTO precios (NombreEmpresa, Material, Compra,Venta, ImagenMaterial) VALUES (?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $nombreempresa, $material, $compra, $venta ,$ruta_imagen);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Redirigir a la página principal de campañas con un mensaje de éxito
        header("Location: ../Vistas/Form_EditarPrecios.php?mensaje=Material agregado correctamente.");
        exit;
    } else {
        // Mostrar un mensaje de error si la inserción falla
        echo "Error al agregar el material: " . $stmt->error;
    }

    // Cerrar la declaración preparada y la conexión a la base de datos
    $stmt->close();
    $mysqli->close();
} else {
    // Si se intenta acceder directamente a este script sin enviar datos del formulario, redirigir a la página principal de campañas
    header("Location: ../Vistas/Form_EditarPrecios.php");
    exit;
}
?>
