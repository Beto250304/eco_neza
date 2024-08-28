<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../Vistas/Form_MenuEmpresa.php");
    exit();
}
?>
