<?php
include ("../Modelo/Configuracion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirm_contrasena = $_POST['confirm-contrasena'];

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirm_contrasena) {
        echo '<script language="javascript">';
        echo 'alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");';
        echo 'window.location.href = "../Vistas/Form_Registro.html";';
        echo '</script>';
        exit();
    }

    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM registros WHERE correo = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        echo '<script language="javascript">';
        echo 'alert("El correo ya existe. Por favor, elija otro correo.");';
        echo 'window.location.href = "../Vistas/Form_Registro.html";';
        echo '</script>';
    } else {
        try {
            // Agregar el usuario a la base de datos sin encriptar la contraseña
            $sql_insert = "INSERT INTO registros (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sql_insert);
            $stmt->bind_param('sss', $usuario, $correo, $contrasena);
            if ($stmt->execute()) {
                echo '<script language="javascript">';
                echo 'alert("Usuario registrado correctamente.");';
                echo 'window.location.href = "../Vistas/Form_Login.html";';
                echo '</script>';
            } else {
                echo "Error al registrar el usuario.";
            }
        } catch (Exception $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }
}
?>

