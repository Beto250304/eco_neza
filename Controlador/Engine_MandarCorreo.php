<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargar las clases de PHPMailer
require '../Controlador/Exception.php';
require '../Controlador/PHPMailer.php';
require '../Controlador/SMTP.php';

// Obtener datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$correo = $_POST['correo'];
$nombre_campaña = $_POST['nombre_campaña'];
$descripcion_corta = $_POST['descripcion_corta'];
$descripcion_completa = $_POST['descripcion_completa'];
$cita_id = $_POST['cita_id'];
$imagen = $_POST['Imagen'];

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->SMTPDebug = 0; // Deshabilitar salida de depuración
    $mail->isSMTP(); // Enviar usando SMTP
    $mail->Host       = 'smtp.gmail.com'; // Establecer el servidor SMTP
    $mail->SMTPAuth   = true; // Habilitar autenticación SMTP
    $mail->Username   = 'econezagreen21@gmail.com'; // Nombre de usuario SMTP
    $mail->Password   = 'k y i k l t s r x v v v y p q y'; // Contraseña SMTP o contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilitar encriptación TLS implícita
    $mail->Port       = 465; // Puerto TCP para conectarse

    // Destinatarios
    $mail->setFrom('econezagreen21@gmail.com', 'ECO_NEZA'); // Remitente
    $mail->addAddress($correo, $nombre_usuario); // Destinatario principal
    $mail->addReplyTo('econezagreen21@gmail.com', 'Information'); // Dirección de respuesta

    // Adjuntar la imagen al correo

    // Contenido del correo
    $mail->isHTML(true); // Establecer formato de correo a HTML
    $mail->Subject = 'Detalles de la Cita'; // Asunto del correo
    $mail->Body    = "
        <h2>Detalles de la Cita</h2>
        <p><strong>Nombre del Usuario:</strong> $nombre_usuario</p>
        <p><strong>Correo Electrónico:</strong> $correo</p>
        <p><strong>Nombre de la Campaña:</strong> $nombre_campaña</p>
        <p><strong>Descripción Corta:</strong> $descripcion_corta</p>
        <p><strong>Descripción Completa:</strong></p>
        <p>$descripcion_completa</p>
        <p><strong>Imagen de la Campaña:</strong></p>
        <img src='cid:imagen' alt='Imagen de la campaña' style='width: 200px; height: auto;'>
    "; // Cuerpo del correo en HTML
    $mail->AltBody = "Detalles de la Cita\n
        Nombre del Usuario: $nombre_usuario\n
        Correo Electrónico: $correo\n
        Nombre de la Campaña: $nombre_campaña\n
        Descripción Corta: $descripcion_corta\n
        Descripción Completa: $descripcion_completa\n"; // Cuerpo alternativo en texto plano

    $mail->send();

    // Redireccionar a la página de éxito
    header('Location: ../Vistas/Form_CorreoExitoso.php');
    exit; // Asegura que el script se detenga después de la redirección

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
