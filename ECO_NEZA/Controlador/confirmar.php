<?php
include("../Modelo/Configuracion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $nombre_empresa = $_POST['nombre_empresa'];

    // Preparar consulta para obtener la contraseña desde registros
    $stmt = $mysqli->prepare("SELECT contraseña FROM registros WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($contraseña);
    $stmt->fetch();
    $stmt->close();

    // Insertar en la tabla empresas
    $sqlInsert = "INSERT INTO empresas (Nombre, CorreoNuevo, Contraseña, NombreEmpresa) VALUES (?, ?, ?,?)";
    $stmtInsert = $mysqli->prepare($sqlInsert);
    $stmtInsert->bind_param("ssss", $nombreUsuario, $correo, $contraseña,$nombre_empresa);

    if ($stmtInsert->execute()) {
        // Eliminar de la tabla alta
        $sqlDeleteAlta = "DELETE FROM alta WHERE nombre_usuario = ?";
        $stmtDeleteAlta = $mysqli->prepare($sqlDeleteAlta);
        $stmtDeleteAlta->bind_param("s", $nombreUsuario);

        if ($stmtDeleteAlta->execute()) {
            // Eliminar de la tabla registros
            $sqlDeleteRegistros = "DELETE FROM registros WHERE correo = ?";
            $stmtDeleteRegistros = $mysqli->prepare($sqlDeleteRegistros);
            $stmtDeleteRegistros->bind_param("s", $correo);

            if ($stmtDeleteRegistros->execute()) {
                echo "<script>
                        alert('Usuario registrado como empresa correctamente y eliminado de registros');
                        window.location.href = '../Vistas/Form_solicitud_altas_admi.php';
                      </script>";
            } else {
                echo "Error al eliminar el registro de registros: " . $mysqli->error;
            }
        } else {
            echo "Error al eliminar el registro de alta: " . $mysqli->error;
        }
    } else {
        echo "Error al insertar el registro en empresas: " . $mysqli->error;
    }

    // Cerrar conexiones y liberar recursos
    $stmtInsert->close();
    $mysqli->close();
}
?>
