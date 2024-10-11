<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Material</title>
    <link rel="stylesheet" type="text/css" href="../Estilos/AgregarCampaña.css">
</head>
<body>
    <header>
        <h1>Agregar Nuevo Material</h1>
    </header>
    <main>
        <form action="../Controlador/Engine_AgregarPrecios.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre de la Empresa:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="material">Tipo de material:</label>
                <textarea id="material" name="material" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="compra">Precio de Compra:</label>
                <textarea id="compra" name="compra" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="venta">Precio de Venta:</label>
                <textarea id="venta" name="venta" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen del material:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>

            <div class="form-group">
                <button type="submit">Agregar Material</button>
                <button type="button" onclick="cancelar()">Cancelar</button>
            </div>
        </form>
    </main>
    <script>
        function cancelar() {
            // Redirigir al usuario a la página principal de campañas sin agregar una nueva campaña
            window.location.href = "../Vistas/Form_EditarPrecios.php";
        }
    </script>
</body>
</html>
