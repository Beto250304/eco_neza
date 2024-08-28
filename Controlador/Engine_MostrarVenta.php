<?php
include ("../Modelo/Configuracion.php");

$id = intval($_GET['Id']);
$sql = "SELECT * FROM precios WHERE Id = $id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['NombreEmpresa'];
    $Material = $row['Material'];
    $Compra = $row['Compra'];
    $Venta = $row['Venta'];
    $imagen = $row['ImagenMaterial'];
} else {
    echo "No se encontró la campaña.";
    exit();
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
    <title>Detalles de la venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/Ventas.css">
</head>

<body>
    <header id="header">
        <h1><a href="">VENTA</a></h1>
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
        <section class="campaign-detail">
            <br><br>
            <h1><?php echo htmlspecialchars($nombre); ?></h1>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen de la campaña" class="card-img-top">
            <div class="card-body">
                <p class="card-title"><?php echo htmlspecialchars($Material); ?></p>
                <p class="card-text"><?php echo htmlspecialchars('Compra $' . $Compra) . ' pesos'; ?></p>
                <button class="asistir-button" onclick="location.href='../Vistas/Form_Recoleccion.php?tipo=compra&material=<?php echo urlencode($Material); ?>&costo=<?php echo $Compra; ?>&empresa=<?php echo urlencode($nombre); ?>'">Comprar</button>
                <div id="mensaje"></div>
            </div>
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
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/jquery.dropotron.min.js"></script>
    <script src="../Resources/js/jquery.scrollex.min.js"></script>
    <script src="../Resources/js/browser.min.js"></script>
    <script src="../Resources/js/breakpoints.min.js"></script>
    <script src="../Resources/js/util.js"></script>
    <script src="../Resources/js/main.js"></script>
    <!-- Agregar el script del widget de chatbot web -->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
</body>

</html>



