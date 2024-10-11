<?php
session_start();
include("../Modelo/Configuracion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var($_POST['Usuario'], FILTER_SANITIZE_EMAIL);
    $contrasena = $_POST['Contraseña'];

    if (!empty($correo) && !empty($contrasena)) {
        // Consulta para administradores en la tabla registro_admi
        $query_admin = "SELECT * FROM registro_admi WHERE correo = ? AND contraseña = ?";
        $stmt_admin = $mysqli->prepare($query_admin);
        $stmt_admin->bind_param('ss', $correo, $contrasena);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result()->fetch_assoc();

        if ($result_admin) {
            // Inicio de sesión para administrador
            $_SESSION['correo'] = $correo;
            $_SESSION['nombre_usuario'] = $result_admin['nombre_usuario'];
            header("Location: ../vistas/Form_menu_admi.php");
            exit();
        } else {
            // Consulta para usuarios normales en la tabla registros
            $query_normal = "SELECT * FROM registros WHERE correo = ? AND contraseña = ?";
            $stmt_normal = $mysqli->prepare($query_normal);
            $stmt_normal->bind_param('ss', $correo, $contrasena);
            $stmt_normal->execute();
            $result_normal = $stmt_normal->get_result()->fetch_assoc();

            if ($result_normal) {
                // Inicio de sesión para usuario normal
                $_SESSION['correo'] = $correo;
                $_SESSION['nombre_usuario'] = $result_normal['nombre_usuario'];
                header("Location: ../Vistas/Form_Menu.php");
                exit();
            } else {
                // Consulta para empresas en la tabla empresas
                $query_empresa = "SELECT * FROM empresas WHERE CorreoNuevo = ? AND Contraseña = ?";
                $stmt_empresa = $mysqli->prepare($query_empresa);
                $stmt_empresa->bind_param('ss', $correo, $contrasena);
                $stmt_empresa->execute();
                $result_empresa = $stmt_empresa->get_result()->fetch_assoc();

                if ($result_empresa) {
                    // Inicio de sesión para empresa
                    $_SESSION['correo'] = $correo;
                    $_SESSION['nombre_usuario'] = $result_empresa['Nombre']; // Suponiendo que el nombre de usuario de empresa es el campo 'Nombre'
                    header("Location: ../Vistas/Form_MenuEmpresa.php");
                    exit();
                } else {
                    // Si no se encontró ningún usuario válido
                    echo '<script language="javascript">';
                    echo 'alert("Contraseña o Correo incorrecto");';
                    echo 'window.location="../Vistas/Form_Login.html"';
                    echo '</script>';
                    exit();
                }
            }
        }
    } else {
        // Si el correo o la contraseña están vacíos
        header("Location: ../Vistas/Form_Login.html?error=vacio");
        exit();
    }
}
?>
