<?php
// Incluir la configuración de la base de datos y otras configuraciones necesarias
include ("../Modelo/Configuracion.php");

// Obtener el ID de la campaña desde la URL (GET)
$id = intval($_GET['Id']);

// Consultar la base de datos para obtener detalles de la campaña
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

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Campaña</title>
    <link rel="stylesheet" href="../Estilos/AsistirForm.css">
</head>

<body>
    <div class="container">
        <h1>Detalle de Campaña</h1>
        <p>Más detalles sobre la campaña...</p>
        <main class="container mt-5">
            <section class="campaign-detail">
                <h1><?php echo $nombre; ?></h1>
                <img src="data:image/jpeg;base64,<?php echo $imagen; ?>" alt="Imagen de la campaña"
                    class="img-fluid mb-4">
                <p><?php echo $descripcioncorta; ?></p>
                <p><?php echo $descripcion; ?></p>
                <div id="mensaje"></div>
            </section>
        </main>
        <!-- Formulario para asistir a la campaña -->
        <form id="asistirForm" action="../Controlador/Engine_AsistirCampaña.php" method="post">
            <!-- Campo oculto para el ID de la campaña -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['Id']); ?>">
            <!-- Campo oculto para el nombre de la campaña -->
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <!-- Campo para ingresar el correo electrónico -->
             Introduce tu correo electronico
            <input type="email" name="email" placeholder="Introduce tu correo" required>
            <!-- Botón de enviar -->
            <button type="submit" class="asistir-button">Asistir</button>
        </form>

    </div>

    <!-- Incluir cualquier script JavaScript necesario -->
    <script src="../Estilos/MostrarCampañas.js"></script>
</body>

</html>