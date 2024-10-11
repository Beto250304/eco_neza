<?php
include ("../Modelo/Configuracion.php");

// Verificar que se haya seleccionado una campaña
if (!isset($_GET['Id'])) {
    echo "No se ha seleccionado ninguna campaña para editar.";
    exit;
}

$campaign_id = $_GET['Id'];

// Obtener los datos de la campaña seleccionada
$sql = "SELECT * FROM campañas WHERE Id = $campaign_id";
$result = $mysqli->query($sql);

if ($result->num_rows == 0) {
    echo "La campaña seleccionada no existe.";
    exit;
}

$campaign = $result->fetch_assoc();

$titulo = $campaign['Nombre'];
$descripcion_corta = $campaign['DescripcionCorta'];
$descripcion = $campaign['Descripcion'];
$imagen = $campaign['Imagen'];

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
    <link rel="stylesheet" href="../Estilos/EditarCampañas.css">
</head>

<body>
    <header id="header">
        <h1><a href="">EDITAR CAMPAÑA</a></h1>
    </header>

    <main class="container mt-5">
        <section class="welcome-section">
            <br><br>
            <form action="../Controlador/Engine_ActualizarCampaña.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>">

                <div class="form-group">
                    <label for="titulo">Nombre de la Campaña:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion_corta">Descripción Corta:</label>
                    <textarea id="descripcion_corta" name="descripcion_corta" rows="3"
                        required><?php echo $descripcion_corta; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="5"
                        required><?php echo $descripcion; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen de la Campaña:</label>
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
            window.location.href = "../Vistas/Form_CampañasEmpresa.php";
        }
    </script>
</body>

</html>