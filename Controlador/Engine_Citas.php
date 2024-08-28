<?php
// Incluir la configuración de la base de datos
include("../Modelo/Configuracion.php");

session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$correo = $_SESSION['correo'];

// Obtener datos del formulario de cita
$producto = $_POST['producto'];
$cantidad = floatval($_POST['cantidad']);
$direccion = $_POST['direccion'];
$hora = $_POST['hora'];
$fecha = $_POST['fecha'];
$costo = floatval($_POST['costo']);
$nombre = $_POST['nombre'];

// Preparar y ejecutar la inserción en la tabla de citas
$sqlCitas = "INSERT INTO citas (usuario, correo,NombreEmpresa, producto, cantidad, direccion, hora, fecha, costo) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
$stmtCitas = $mysqli->prepare($sqlCitas);

if ($stmtCitas === false) {
    die("Error en la preparación de la declaración para citas: " . $mysqli->error);
}

$stmtCitas->bind_param("ssssissds", $nombre_usuario, $correo,$nombre, $producto, $cantidad, $direccion, $hora, $fecha, $costo);

if (!$stmtCitas->execute()) {
    die("Error al ejecutar la consulta de citas: " . $stmtCitas->error);
}

// Obtener el ID de la cita insertada
$idCita = $stmtCitas->insert_id;

$stmtCitas->close();

// Preparar y ejecutar la inserción en la tabla del carrito
$sqlCarrito = "INSERT INTO carrito (nombre_usuario, nombre_material, cantidad_kg, costo_unitario, nombre_empresa) VALUES (?, ?, ?, ?, ?)";
$stmtCarrito = $mysqli->prepare($sqlCarrito);

if ($stmtCarrito === false) {
    die("Error en la preparación de la declaración para carrito: " . $mysqli->error);
}

// Calcular el costo unitario correctamente
$costoUnitario = $costo / $cantidad;

$stmtCarrito->bind_param("ssdss", $nombre_usuario, $producto, $cantidad, $costoUnitario, $nombre);

if ($stmtCarrito->execute()) {
    header("Location: ../Vistas/Form_Gracias.php");
    exit();
} else {
    die("Error al ejecutar la consulta de carrito: " . $stmtCarrito->error);
}

$stmtCarrito->close();
$mysqli->close();
?>
