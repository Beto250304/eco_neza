<?php
session_start();

// Verificar sesión activa


// Incluir la configuración de la base de datos
include("../Modelo/Configuracion.php");

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
        header("Location: ../Vistas/Form_Login.html");
        exit();
    }
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $correo = $_SESSION['correo'];
    // Obtener datos del formulario y escaparlos para prevenir inyección SQL
    $nombre_empresa = mysqli_real_escape_string($mysqli, $_POST['nombre_empresa']);
    $certificaciones = mysqli_real_escape_string($mysqli, $_POST['certificaciones']);
    $recoleccion = mysqli_real_escape_string($mysqli, $_POST['recoleccion']);
    $volumen_reciclado = mysqli_real_escape_string($mysqli, $_POST['volumen_reciclado']);
    $materiales_reciclados = mysqli_real_escape_string($mysqli, $_POST['materiales_reciclados']);
    $educacion_concientizacion = mysqli_real_escape_string($mysqli, $_POST['educacion_concientizacion']);
    $certificaciones_reconocimientos = mysqli_real_escape_string($mysqli, $_POST['certificaciones_reconocimientos']);
    $responsabilidad_social = mysqli_real_escape_string($mysqli, $_POST['responsabilidad_social']);

    // Preparar la consulta SQL para insertar datos
    $sql = "INSERT INTO alta (nombre_usuario,correo,nombre_empresa, certificaciones, recoleccion, volumen_reciclado, materiales_reciclados, educacion_concientizacion, certificaciones_reconocimientos, responsabilidad_social)
            VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la declaración: " . $mysqli->error);
    }

    // Enlazar parámetros y ejecutar la consulta
    $stmt->bind_param("ssssssssss",$nombre_usuario,$correo, $nombre_empresa, $certificaciones, $recoleccion, $volumen_reciclado, $materiales_reciclados, $educacion_concientizacion, $certificaciones_reconocimientos, $responsabilidad_social);

    if ($stmt->execute()) {
        // Redireccionar a una página de confirmación o éxito
        header("Location: ../Vistas/Form_Exito.php");
        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    // Cerrar declaración y conexión
    $stmt->close();
    $mysqli->close();
}
?>
