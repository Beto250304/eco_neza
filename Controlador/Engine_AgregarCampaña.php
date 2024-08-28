<?php
include("../Modelo/Configuracion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    if (!isset($_SESSION['correo'])) {
        header("Location: ../Vistas/Form_Login.html");
        exit();
    }
    $correo = $_SESSION['correo'];

    $stmt = $mysqli->prepare("SELECT NombreEmpresa FROM empresas WHERE CorreoNuevo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($nombre_empresa);
    $stmt->fetch();
    $stmt->close();

    $titulo = $_POST['titulo'];
    $descripcion_corta = $_POST['descripcion_corta'];
    $descripcion = $_POST['descripcion'];

    // Procesar la imagen
    $ruta_imagen = null; // Inicializar la ruta de la imagen
    if (isset($_FILES['imagen'])) {
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_temp = $_FILES['imagen']['tmp_name'];
            $imagen_nombre = basename($_FILES['imagen']['name']);
            $ruta_imagen = '../Resources/' . $imagen_nombre;

            // Verificar si el archivo se mueve correctamente
            if (move_uploaded_file($imagen_temp, $ruta_imagen)) {
                echo "Imagen cargada con éxito: " . $ruta_imagen . "<br>";
            } else {
                echo "Error al mover el archivo de imagen.<br>";
                exit;
            }
        } else {
            echo "Error en la carga de la imagen: " . $_FILES['imagen']['error'] . "<br>";
            exit;
        }
    } else {
        echo "No se ha subido ninguna imagen.<br>";
        exit;
    }

    $sql = "INSERT INTO campañas (Nombre, NombreEmpresa, DescripcionCorta, Descripcion, Imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $titulo, $nombre_empresa, $descripcion_corta, $descripcion, $ruta_imagen);

    if ($stmt->execute()) {
        header("Location: ../Vistas/Form_CampañasEmpresa.php?mensaje=Campaña agregada correctamente.");
        exit;
    } else {
        echo "Error al agregar la campaña: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
} else {
    header("Location: ../Vistas/Form_CampañasEmpresa.php");
    exit;
}
?>
