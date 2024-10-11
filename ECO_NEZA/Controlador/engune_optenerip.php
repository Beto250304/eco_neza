<?php
class YourController {
    public function getUserIp() {
        // Obtener la dirección IP
        $ip = $_SERVER['REMOTE_ADDR'];

        // Si estás detrás de un proxy, intenta obtener la IP original
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    public function someAction() {
        // Llama al método para obtener la IP
        $userIp = $this->getUserIp();

        // Hacer algo con la IP, como guardarla en la base de datos o mostrarla
        echo "La dirección IP del usuario es: " . $userIp;
    }
}
?>