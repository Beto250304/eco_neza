<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

// Obtener los servicios que están en el carrito para este usuario
$nombre_usuario = $_SESSION['nombre_usuario'];

// Asumiendo que tienes una conexión a la base de datos
include ("../Modelo/Configuracion.php");

$sql = "SELECT * FROM carrito WHERE nombre_usuario = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

$carrito = [];

while ($row = $result->fetch_assoc()) {
    $carrito[] = $row;
}

$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/Carrito.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="is-preload">
    <div id="page-wrapper">
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
        <h1>Carrito de Compras</h1>
        <table>
            <tr>
                <th>Material</th>
                <th>Cantidad</th>
                <th>Costo Total</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($carrito as $item) { ?>
                <tr>
                    <td><?php echo isset($item['nombre_material']) ? htmlspecialchars($item['nombre_material']) : 'N/A'; ?>
                    </td>
                    <td><?php echo isset($item['cantidad_kg']) ? htmlspecialchars($item['cantidad_kg']) : 'N/A'; ?></td>
                    <td><?php echo isset($item['costo_unitario']) && isset($item['cantidad_kg']) ? htmlspecialchars($item['costo_unitario'] * $item['cantidad_kg']) : 'N/A'; ?>
                    </td>
                    <td>
                        <a
                            href="../Controlador/RemoveFromCart.php?id=<?php echo isset($item['id']) ? $item['id'] : ''; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a class="btn-volver" href="../Vistas/Form_CompraVenta.php">Volver al Servicio de Recolección</a>
        <?php if (!empty($carrito)) {
        $nombre_material = urlencode($carrito[0]['nombre_material']);
        $costo_unitario = urlencode($carrito[0]['costo_unitario']);
        $cantidad_kg = urlencode($carrito[0]['cantidad_kg']);
        $total_amount = $carrito[0]['costo_unitario'] * $carrito[0]['cantidad_kg'];
        ?>
        <a class="btn-pagar"
            href="../Vistas/Form_Pago.php?nombre_material=<?php echo $nombre_material; ?>&costo_unitario=<?php echo $costo_unitario; ?>&cantidad_kg=<?php echo $cantidad_kg; ?>&amount=<?php echo $total_amount; ?>">Pagar</a>
    <?php } ?>
    </div>
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