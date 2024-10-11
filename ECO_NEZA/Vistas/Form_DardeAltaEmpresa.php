<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza</title>
    <link rel="stylesheet" href="../Estilos/Altas.css">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function showForm() {
            var formSection = document.getElementById("form-section");
            formSection.style.display = "block";

            // Scroll to form section when showing it
            formSection.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</head>

<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
$correo = $_SESSION['correo'];
?>

<body>
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
    <main class="container">
        <section class="welcome-section" id="welcome-section">
            <br><br>
            <span style="display: block; font-weight: bold; font-size: 50px; color: #037216; text-align: center">¡Únete
                a nuestro equipo!</span>
            <div class="welcome-container" style="text-align: center">
                <h2>Hola <?php echo $nombre_usuario; ?></h2>
                <div class="welcome-content">
                    <p class="welcome-text">
                        ¡Conviértete en un héroe del medio ambiente con ECO_NEZA! <br>
                        Descubre cómo puedes marcar la diferencia y ser parte de nuestro equipo comprometido con el
                        planeta. <br><br>
                        Completa el formulario y únete a nuestra misión para un futuro más sostenible. <br>¡Tu
                        participación cuenta!
                    </p>
                    <button onclick="showForm()">LLENAR FORMULARIO</button>
                </div>
            </div>
        </section>

        <section id="form-section" style="display: none;">
            <form action="../Controlador/Engine_Alta.php" method="POST">
                <div class="form-container">
                    <input type="hidden" name="correo" value="<?php echo htmlspecialchars($correo); ?>">

                    <label for="nombre_empresa"><b>Nombre completo de la empresa</b></label>
                    <input type="text" placeholder="Nombre empresa" name="nombre_empresa" required><br>

                    <label><b>¿La empresa cuenta con certificaciones y licencias necesarias para operar en el sector de
                            reciclaje (si su respuesta es si diga cuales)?</b></label><br>
                    <input type="text" name="certificaciones" placeholder="Certificaciones" required><br>

                    <label><b>¿Cuentan con servicio de recolección de material reciclado (si su respuesta es si diga cuantas carros tiene)?</b></label><br>
                    <input type="text" name="recoleccion" placeholder="Recoleccion" required><br>


                    <label for="volumen_reciclado"><b>¿Qué volumen de material reciclado maneja su empresa
                            mensualmente?</b></label><br>
                    <input type="text" name="volumen_reciclado" placeholder="Volumen reciclado" required><br>

                    <label for="materiales_reciclados"><b>¿Qué tipos de materiales o productos reciclan?</b></label><br>
                    <input type="text" name="materiales_reciclados" placeholder="Materiales o productos reciclados"
                        required><br>

                    <label for="educacion_concientizacion"><b>¿Tienen planes o programas específicos para la educación y
                            concientización sobre reciclaje en la comunidad?</b></label><br>
                    <input type="text" name="educacion_concientizacion" placeholder="Educación y concientización"
                        required><br>

                    <label for="certificaciones_reconocimientos"><b>¿Tienen alguna certificación o reconocimiento en el
                            ámbito del reciclaje?</b></label><br>
                    <input type="text" name="certificaciones_reconocimientos"
                        placeholder="Certificaciones o reconocimientos" required><br>

                    <label for="responsabilidad_social"><b>¿Tienen algún programa de responsabilidad social corporativa
                            relacionado con el reciclaje?</b></label><br>
                    <input type="text" name="responsabilidad_social" placeholder="Responsabilidad social corporativa"
                        required><br>

                    <button type="submit">Enviar</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Agregar el widget de chatbot web -->
    <div id="tawk_6665768a981b6c56477b401d"></div>
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

    <!-- Agregar el script del widget de chatbot web -->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

    <!-- Script de Google Maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5S6vaPA_ZobY0U_NkYTWN2aDOLWKtmuw&libraries=places&callback=initMap"></script>
</body>

</html>