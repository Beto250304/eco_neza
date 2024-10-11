<?php
include ("../Modelo/Configuracion.php");

// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}

// Obtener el nombre de la empresa del usuario logueado
$correo = $_SESSION['correo'];
$stmt = $mysqli->prepare("SELECT NombreEmpresa FROM empresas WHERE CorreoNuevo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultEmpresa = $stmt->get_result();

if ($resultEmpresa->num_rows > 0) {
    $rowEmpresa = $resultEmpresa->fetch_assoc();
    $nombreEmpresa = $rowEmpresa['NombreEmpresa'];

    // Consulta SQL para obtener los precios de los materiales para la empresa actual
    $sql = "SELECT * FROM precios WHERE NombreEmpresa = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $nombreEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();

    $materials = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $materials[] = $row;
        }
    } else {
        echo "No se encontraron materiales para esta empresa.";
        exit;
    }
} else {
    echo "No se encontró la empresa asociada al usuario.";
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
    <title>Lista de precios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/Campañas.css">

</head>

<body>
    <header id="header">
        <h1><a href="">PRECIOS</a></h1>
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
            <h1>Editar Precios</h1>
                <div class="col-12 text-right mb-3">
                    <br><br>
                    <button class="btn btn-success" onclick="location.href='../Vistas/Form_AgregarPrecios.php'">Agregar
                        Producto</button>
                </div>
                    <?php foreach ($materials as $material): ?>
                        <div class="col-md-4 mb-4">
                            <div class="campaign">
                                <div class="card campaign-card">
                                    <p><?php echo isset($material['NombreEmpresa']) ? $material['NombreEmpresa'] : 'Nombre no disponible'; ?>
                                    </p>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($material['ImagenMaterial']); ?>"
                                        alt="Imagen del material">
                                    <p><?php echo isset($material['Material']) ? $material['Material'] : 'Nombre del material no disponible'; ?>
                                    </p>
                                    <!-- Asegúrate de especificar el tipo de imagen correcto (image/jpeg, image/png, etc.) -->
                                    <p>
                                        <?php echo isset($material['Compra']) ? 'Compra $' . $material['Compra'] . ' Pesos  ' : 'Precio no disponible'; ?>
                                        <?php echo isset($material['Venta']) ? 'Venta $' . $material['Venta'] . ' Pesos' : 'Precio no disponible'; ?>
                                    </p>
                                    <button
                                        onclick="location.href='#?Id=<?php echo $material['Id']; ?>'">Visualizar</button>
                                    <button
                                        onclick="location.href='../Vistas/Form_EditarPreciosTotal.php?Id=<?php echo $material['Id']; ?>'">Editar</button>
                                    <button onclick="confirmarBorrado(<?php echo $material['Id']; ?>)">Borrar</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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