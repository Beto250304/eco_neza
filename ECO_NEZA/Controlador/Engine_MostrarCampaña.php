<?php
include ("../Modelo/Configuracion.php");

$id = intval($_GET['Id']);

$sql = "SELECT * FROM campañas WHERE Id = $id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = htmlspecialchars($row['Nombre']);
    $descripcioncorta = htmlspecialchars($row['DescripcionCorta']);
    $descripcion = htmlspecialchars($row['Descripcion']);
    $imagen = base64_encode($row['Imagen']);
} else {
    echo "No se encontró la campaña.";
    exit;
}

session_start();

if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Campaña</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/MostrarCampañas.css">
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
        <br><br>
        <section class="campaign-detail">

            <h1><?php echo $nombre; ?></h1>
            <img src="data:image/jpeg;base64,<?php echo $imagen; ?>" alt="Imagen de la campaña" class="img-fluid mb-4">
            <p><?php echo $descripcioncorta; ?></p>
            <p><?php echo $descripcion; ?></p>
            <form id="asistirForm" action="../Controlador/Engine_AsistirCampaña.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['Id']); ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                <input type="hidden" name="descripcioncorta" value="<?php echo htmlspecialchars($descripcioncorta); ?>">
                <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>">
                <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($imagen); ?>">
                <input type="hidden" name="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>">
                <div class="form-group">
                    <label for="email">Introduce tu correo</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Introduce tu correo"
                        required>
                </div>
                <button type="submit" class="btn btn-primary asistir-button">Asistir</button>
            </form>
            <div id="mensaje"></div>
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
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/jquery.dropotron.min.js"></script>
    <script src="../Resources/js/jquery.scrollex.min.js"></script>
    <script src="../Resources/js/browser.min.js"></script>
    <script src="../Resources/js/breakpoints.min.js"></script>
    <script src="../Resources/js/util.js"></script>
    <script src="../Resources/js/main.js"></script>
</body>

</html>