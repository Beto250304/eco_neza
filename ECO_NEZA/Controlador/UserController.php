<?php
// UserController.php

public function index() {
    $ip = $_SERVER['REMOTE_ADDR']; // Obtiene la IP
    $this->userModel->saveIP($ip); // Llama al método del modelo para guardar la IP
    // Cargar la vista correspondiente después de guardar la IP
}
?>