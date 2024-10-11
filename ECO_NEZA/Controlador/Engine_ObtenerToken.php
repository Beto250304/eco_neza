<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

// Configura tus credenciales de Google
$clientId = '129949715710-9nls890md614j008k1uq9i5jehovmelk.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/proyecto/ECO_NEZA/Controlador/Engine_ObtenerToken.php'; // Asegúrate de que esta URI coincida con la URI configurada en Google Developers Console

$provider = new Google([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
]);

if (!isset($_GET['code'])) {
    // Si no hay código, generar URL de autenticación
    $authUrl = $provider->getAuthorizationUrl([
        'scope' => ['https://mail.google.com/'],
    ]);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    // Estado inválido, detener el proceso
    unset($_SESSION['oauth2state']);
    exit('Estado inválido.');
} else {
    // Obtener el token de acceso usando el código recibido
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Imprimir el refresh token
    echo 'Refresh Token: ' . $token->getRefreshToken();
}
?>
