<?php
include("../Modelo/Configuracion.php");

// Verificar que se haya seleccionado una campaña
if (!isset($_GET['Id'])) {
    echo "No se ha seleccionado ninguna campaña para editar.";
    exit;
}

$campaign_id = $_GET['Id'];

// Obtener los datos de la campaña seleccionada
$sql = "SELECT * FROM precios WHERE Id = $campaign_id";
$result = $mysqli->query($sql);

if ($result->num_rows == 0) {
    echo "Los precios seleccionados no existe.";
    exit;
}

$campaign = $result->fetch_assoc();

$nombreempresa = $campaign['NombreEmpresa'];
$material = $campaign['Material'];
$imagen = $campaign['ImagenMaterial'];
$compra = $campaign['Compra'];
$venta = $campaign['Venta'];

$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Campaña</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/Campañas.css">
    <link rel="stylesheet" href="../Estilos/EditarCampañas.css">
</head>

<body>
<header id="header">
        <h1><a href="">PRECIOS</a></h1>
        <nav id="nav">
            <ul>
                
            </ul>
        </nav>
    </header>

    <main class="container mt-4">
        <section class="welcome-section">
        <br><br>
            <span style="display: block; font-weight: bold; font-size: 50px; color: #037216; text-align: center; margin: 0 auto;">Editar Campaña</span>
            <form action="../Controlador/Engine_ActualizarPrecios.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">

                <div class="form-group">
                    <label for="nombre">Nombre de la Empresa:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombreempresa; ?>" required>
                </div>

                <div class="form-group">
                    <label for="material">Tipo de Material:</label>
                    <textarea id="material" name="material" rows="3" required><?php echo $material; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="compra">Precio de compra:</label>
                    <textarea id="compra" name="compra" rows="5" required><?php echo $compra; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="venta">Precio de venta:</label>
                    <textarea id="venta" name="venta" rows="5" required><?php echo $venta; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen del Material:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>

                <div class="form-group">
                    <button type="submit">Guardar Cambios</button>
                    <button type="button" onclick="cancelarEdicion()">Cancelar</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        function cancelarEdicion() {
            window.location.href = "../Vistas/Form_EditarPrecios.php";
        }
    </script>
</body>

</html>
