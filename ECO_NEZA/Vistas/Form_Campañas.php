<?php
include ("../Modelo/Configuracion.php");

$sql = "SELECT * FROM campañas";
$result = $mysqli->query($sql);

$campaigns = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $campaigns[] = $row;
    }
} else {
    echo "No se encontraron campañas.";
    exit;
}
$mysqli->close();
?>
<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campañas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/Campañas.css">
</head>

<body>
    <header id="header">
        <h1><a href="">CAMPAÑAS</a></h1>
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

    <main class="container mt-4">
    <section class="welcome-section"><br><br>
        <div class="row justify-content-center">
            <?php foreach ($campaigns as $campaign): ?>
                <div class="col-md-4 mb-4">
                <br><br>
                    <div class="card campaign-card">
                        <?php if (!empty($campaign['Imagen'])): ?>
                            <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($campaign['Imagen']); ?>" alt="Imagen de la campaña">
                        <?php else: ?>
                            <img class="card-img-top" src="../path_to_default_image.jpg" alt="Imagen por defecto">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo isset($campaign['NombreEmpresa']) ? $campaign['NombreEmpresa'] : 'Nombre de la empresa no disponible'; ?></h5>
                            <p class="card-text"><?php echo isset($campaign['DescripcionCorta']) ? $campaign['DescripcionCorta'] : 'Descripción corta no disponible'; ?></p>
                            <a href="../Controlador/Engine_MostrarCampaña.php?Id=<?php echo $campaign['Id']; ?>" class="btn btn-primary btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<footer id="footer">
            <ul class="icons">
                <li><a href="https://www.instagram.com/eco_neza?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>

            </ul>
            <ul class="copyright">
                <li>&copy; 2024 ECO Neza. Todos los derechos reservados.</li>
            </ul>
        </footer>




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
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/jquery.dropotron.min.js"></script>
    <script src="../Resources/js/jquery.scrollex.min.js"></script>
    <script src="../Resources/js/browser.min.js"></script>
    <script src="../Resources/js/breakpoints.min.js"></script>
    <script src="../Resources/js/util.js"></script>
    <script src="../Resources/js/main.js"></script>
    <script></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>