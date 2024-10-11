<?php
session_start();
include ("../Modelo/Configuracion.php");

// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

// Obtener el correo del usuario logueado
$correo = $_SESSION['correo'];

// Preparar consulta para obtener las campañas de la empresa asociada al correo
$stmt = $mysqli->prepare("SELECT * FROM campañas WHERE NombreEmpresa = (SELECT NombreEmpresa FROM empresas WHERE CorreoNuevo = ?)");
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

$campaigns = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $campaigns[] = $row;
    }
} else {
    echo "No se encontraron campañas para esta empresa.";
    exit;
}

$stmt->close();
$mysqli->close();
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
                <li><a href="../Vistas/Form_MenuEmpresa.php">Inicio</a></li>
                <li><a href="../Vistas/Form_CampañasEmpresa.php">Altas y bajas de campañas</a></li>
                <li><a href="../Vistas/Form_CitasEmpresa.php">Citas Empresa</a></li>
                <li><a href="../Vistas/Form_EditarPrecios.php">Altas y bajas de precios</a></li>
                <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mt-4">
        <section class="welcome-section">
            <div class="row justify-content-center">
                <div class="col-12 text-right mb-3">
                    <br><br><br>
                    <button class="btn btn-success" onclick="location.href='../Vistas/Form_AgregarCampaña.php'">Agregar Nueva Campaña</button>
                </div>
                <?php foreach ($campaigns as $campaign): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card campaign-card">
                            <?php if (!empty($campaign['Imagen'])): ?>
                                <img class="card-img-top"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($campaign['Imagen']); ?>"
                                    alt="Imagen de la campaña">
                            <?php else: ?>
                                <img class="card-img-top" src="../path_to_default_image.jpg" alt="Imagen por defecto">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo isset($campaign['NombreEmpresa']) ? $campaign['NombreEmpresa'] : 'Nombre de la empresa no disponible'; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo isset($campaign['DescripcionCorta']) ? $campaign['DescripcionCorta'] : 'Descripción corta no disponible'; ?>
                                </p>
                                <button
                                    onclick="location.href='../Controlador/Engine_VisualizarCampaña.php?Id=<?php echo $campaign['Id']; ?>'">Visualizar</button>
                                <button onclick="confirmarBorrado(<?php echo $campaign['Id']; ?>)">Borrar</button>
                                <button
                                    onclick="location.href='../Vistas/Form_EditarCampaña.php?Id=<?php echo $campaign['Id']; ?>'">Editar</button>
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


    <script>
        function confirmarBorrado(campaignId) {
            if (confirm('¿Seguro que desea borrar la campaña?')) {
                window.location.href = `../Controlador/Engine_BorrarCampaña.php?Id=${campaignId}`;
            }
        }
    </script>

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
