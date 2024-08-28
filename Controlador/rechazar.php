<?php
include("../Modelo/Configuracion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombre_usuario'];

    // Eliminar de la tabla solicitud_de_altas
    $sqlDelete = "DELETE FROM alta WHERE nombre_usuario = '$nombreUsuario'";
    if ($mysqli->query($sqlDelete) === TRUE) {
        echo "<script>
                alert('Usuario rechazado correctamente');
                window.location.href = '../Vistas/Form_solicitud_altas_admi.php';
              </script>";
    } else {
        echo "Error al eliminar el registro: " . $mysqli->error;
    }
}
?>