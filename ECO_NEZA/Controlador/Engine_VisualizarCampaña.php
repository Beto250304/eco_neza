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
session_start(); // Inicia la sesión

if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    // Resto de tu código que utiliza $nombre_usuario
} else {
    // Manejo del caso donde $_SESSION['nombre_usuario'] no está definido
    header("Location: ../Vistas/Form_Login.html"); // Redirige a la página de inicio de sesión
    exit(); // Asegura que el script se detenga después de la redirección
}
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
        <h1><a href="">VER CAMPAÑA</a></h1>
    </header>
    <main class="container mt-5">
        <section class="campaign-detail">
            <br><br>
            <h1><?php echo $nombre; ?></h1>
            <img src="data:image/jpeg;base64,<?php echo $imagen; ?>" alt="Imagen de la campaña" class="img-fluid mb-4">
            <p><?php echo $descripcioncorta; ?></p>
            <p><?php echo $descripcion; ?></p>
            <!-- Formulario para asistir a la campaña -->
            <form id="asistirForm" action="../Vistas/Form_CampañasEmpresa.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['Id']); ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                <input type="hidden" name="descripcioncorta" value="<?php echo htmlspecialchars($descripcioncorta); ?>">
                <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($descripcion); ?>">
                <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($imagen); ?>">
                <input type="hidden" name="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>">
                <button type="submit" class="asistir-button">Regresar</button>
            </form>



            <div id="mensaje"></div>
        </section>
    </main>
    
</body>

</html>