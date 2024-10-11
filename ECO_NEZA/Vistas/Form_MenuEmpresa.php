<?php
include ("../Modelo/Configuracion.php");

// Verificar si existe el correo en $_SESSION
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$correo = $_SESSION['correo'];

// Preparar consulta para obtener el nombre de la empresa
$stmt = $mysqli->prepare("SELECT NombreEmpresa FROM empresas WHERE CorreoNuevo = ?");
$stmt->bind_param("s", $correo); // Aquí se especifica el tipo de dato y se pasa el parámetro
$stmt->execute();
$stmt->bind_result($nombre_empresa);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza - Menú Empresa</title>
    <link rel="stylesheet" href="../Resources/css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="is-preload">
    <div id="page-wrapper">
        <header id="header">
            <h1><a href="">Eco Neza</a></h1>
            <nav id="nav">
                <ul>
                    <li><a href="../Vistas/Form_MenuEmpresa.php">Inicio</a></li>
                    <li><a href="../Vistas/Form_CampañasEmpresa.php">Altas y bajas de campañas</a></li>
                    <li><a href="../Vistas/Form_CitasEmpresa.php">Citas Empresa</a></li>
                    <li><a href="../Vistas/Form_EditarPrecios.php">Altas y bajas de precios</a></li>
                    <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="main" class="container medium">

                <h2
                    style="font-family: 'Arial', sans-serif; font-size: 36px; font-weight: bold; color: #2c3e50; text-align: center; margin-top: 20px;">
                    ¡Bienvenidos a nuestra comunidad de<br>reciclaje sostenible!
                </h2>
                <div class="box">
                    <p class="fancy-text">
                    <h2>Eco Neza</h2>
                    <p>¡Bienvenido <?php echo $nombre_empresa; ?>!</p>
                    <br><br>
                    <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                        Nos complace enormemente darles la bienvenida a bordo. En ECO_NEZA, estamos comprometidos con
                        hacer del reciclaje una tarea accesible y efectiva para todos.Con su registro, se unen a una red
                        dedicada a promover prácticas ambientales responsables y a facilitar el acceso a información
                        crucial sobre reciclaje.
                    </p>

                    <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-top: 20px;">
                        <strong>Estamos aquí para apoyarles en cada paso del camino.</strong>
                    </p>

                    <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                        Desde encontrar los puntos de recolección más cercanos hasta mantenerse al día con las últimas
                        iniciativas y campañas de concienciación, nuestra plataforma está diseñada para hacer que su
                        experiencia de reciclaje sea fluida y significativa.
                    </p>

                    <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                        Gracias por confiar en nosotros para ser su socio en este importante viaje hacia un futuro más
                        verde y sostenible. Esperamos trabajar juntos para lograr un impacto positivo en nuestro
                        entorno.
                    </p>

                    <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-bottom: 30px;">
                    ¡Juntos podemos hacer la diferencia!
                    </p>
                </div>
            </section>
            <section class="logo-section">
                <img src="../Resources/image.png" alt="Avatar" class="avatar-logo">
            </section>
        </main>
        <!-- Agregar el widget de chatbot web -->
        <div class="chatbot-widget">
            <div id="tawk_6665768a981b6c56477b401d"></div>
        </div>
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/6665768a981b6c56477b401d/1hvu5e3q0';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <footer id="footer">
            <ul class="icons">
                <li><a href="https://www.instagram.com/eco_neza?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>

            </ul>
            <ul class="copyright">
                <li>&copy; 2024 ECO Neza. Todos los derechos reservados.</li>
            </ul>
        </footer>

</body>

</html>