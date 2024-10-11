<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Neza</title>
    <link rel="stylesheet" href="../Resources/css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<body class="is-preload">
    <div id="page-wrapper">

        <!-- Header -->
        <header id="header">
            <h1><a href="">Eco Neza</a></h1>
            <nav id="nav">
                <ul>
                    <li><a href="../Vistas/Form_Menu.php">Inicio</a></li>
                    <li><a href="../Vistas/Form_Campañas.php">Campañas</a></li>
                    <li><a href="../Vistas/Form_CompraVenta.php">Compra y venta</a></li>
                    <li><a href="../Vistas/Form_DardeAltaEmpresa.php">Dar de alta tu empresa</a></li>
                    <li><a href="../Vistas/Form_Carrito.php">Carrito de compra</a></li>
                    <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <section id="main" class="container medium">
            <header>
                <h2>Eco Neza</h2>
                <p>¡Bienvenido <?php echo $nombre_usuario; ?>!</p>
            </header>
            <div class="box">
            <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-top: 20px; text-align: center;">
                    <strong>¡Eco Neza te da la bienvenida!</strong>
                </p>
                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                     En nuestra comunidad, no solo reciclamos, ¡transformamos! Cada acción
                    cuenta para reducir residuos, proteger el medio ambiente y crear un futuro más sostenible.
                </p>

                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-top: 20px;">
                    <strong>¿Por qué reciclar con nosotros?</strong>
                </p>

                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                    <strong>Transformación Sostenible:</strong> Más que reciclar, convertimos residuos en recursos
                    valiosos para preservar nuestros ecosistemas.
                </p>

                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                    <strong>Participación Activa:</strong> Únete a eventos educativos y jornadas de recolección para
                    aprender y contribuir directamente.
                </p>

                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;">
                    <strong>Chatbot de Ayuda:</strong> Nuestro chatbot está aquí para responder tus preguntas y
                    ofrecerte asistencia inmediata.
                </p>

                <p style="font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6; margin-bottom: 30px;">
                    Tu compromiso hace la diferencia. ¡Explora y participa en nuestras iniciativas para un planeta más
                    limpio y saludable!
                </p>

            </div>
            <div class="text-center my-4">
                <img src="../Resources/image.png" alt="" class="" style="width: 500px;">
            </div>


        </section>

        <!-- Footer -->
        <footer id="footer">
            <ul class="icons">
                <li><a href="https://www.instagram.com/eco_neza?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>

            </ul>
            <ul class="copyright">
                <li>&copy; 2024 ECO Neza. Todos los derechos reservados.</li>
            </ul>
        </footer>

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
    <!-- Scripts -->
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/jquery.dropotron.min.js"></script>
    <script src="../Resources/js/jquery.scrollex.min.js"></script>
    <script src="../Resources/js/browser.min.js"></script>
    <script src="../Resources/js/breakpoints.min.js"></script>
    <script src="../Resources/js/util.js"></script>
    <script src="../Resources/js/main.js"></script>

</body>

</html>