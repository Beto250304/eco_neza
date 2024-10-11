<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

// Recibir los datos del servicio seleccionado
$nombre_usuario = $_SESSION['nombre_usuario'];
$material = $_GET['material'];
$costo = $_GET['costo'];
$cantidad = $_POST['cantidad']; // Esta cantidad la debe ingresar el usuario

// Asumiendo que tienes una conexión a la base de datos
include ("../Modelo/Configuracion.php");

// Guardar el servicio seleccionado en la tabla del carrito
$sql = "INSERT INTO carrito (nombre_usuario, material, costo, cantidad) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssdi", $nombre_usuario, $material, $costo, $cantidad);

if ($stmt->execute()) {
    echo "Servicio añadido al carrito.";
} else {
    echo "Error al añadir servicio al carrito: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
