<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra y Venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/CompraVenta.css">
</head>

<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<body>
    <header id="header">
        <h1><a href="">COMPRA DE MATERIALES</a></h1>
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
        <section class="welcome-section">
            <h1>COMPRA</h1>
            <div class="row justify-content-center">
                <br><br>
                <?php
                include ("../Modelo/Configuracion.php");

                $sql = "SELECT * FROM precios";
                $result = $mysqli->query($sql);

                $campaigns = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $campaigns[] = $row;
                    }
                } else {
                    echo "No se encontraron materiales.";
                    exit;
                }
                $mysqli->close();
                ?>
                <?php foreach ($campaigns as $campaign): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card campaign-card">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($campaign['ImagenMaterial']); ?>" alt="Imagen de la campaña" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo isset($campaign['NombreEmpresa']) ? $campaign['NombreEmpresa'] : 'Nombre no disponible'; ?></h5>
                                <p class="card-text"><?php echo isset($campaign['Material']) ? $campaign['Material'] : 'Nombre del material no disponible'; ?></p>
                                <p class="card-text"><?php echo isset($campaign['Compra']) ? 'Compra: $' . $campaign['Compra'] . ' Pesos' : 'Precio de compra no disponible'; ?></p>
                                <p class="card-text"><?php echo isset($campaign['Venta']) ? 'Venta: $' . $campaign['Venta'] . ' Pesos' : 'Precio de venta no disponible'; ?></p>
                                <a href="../Controlador/Engine_MostrarVenta.php?Id=<?php echo $campaign['Id']; ?>" class="btn btn-primary">Contactar</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

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
</body>

</html>
