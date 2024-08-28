<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Vistas/Form_Menu.php");
    exit();
}
?>
