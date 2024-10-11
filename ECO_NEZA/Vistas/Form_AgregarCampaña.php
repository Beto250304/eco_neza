<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Campaña</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" href="../Estilos/AgregarCampaña.css">
</head>

<body>
    <header id="header">
    <h1><a href="">AGREGAR NUEVA CAMPAÑA</a></h1>
    </header>
    <main class="container mt-5">
        <form action="../Controlador/Engine_AgregarCampaña.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Nombre de la Campaña:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descripcion_corta">Descripción Corta:</label>
                <textarea id="descripcion_corta" name="descripcion_corta" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen de la Campaña:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit">Agregar Campaña</button>
                <button type="button" onclick="cancelar()">Cancelar</button>
            </div>
        </form>

    </main>
    <script>
        function cancelar() {
            window.location.href = "../Vistas/Form_CampañasEmpresa.php";
        }
    </script>
</body>

</html>