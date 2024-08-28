<?php
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: ../vistas/from_menu_admi.php");
    exit();
}
?>