<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza - Agregar Información</title>
    <link rel="stylesheet" type="text/css" href="../estilos/Estilos.css">
    <style>
        /* Estilos personalizados aquí */
    </style>
</head>

<body>
    <header>
        <h1>Agregar Información</h1>
    </header>
    <main>
        <section class="form-section">
            <h2>Detalles de la Cita</h2>
            <?php
            // Incluir el archivo de configuración de la base de datos
            include("../Modelo/Configuracion.php");

            // Verificar si se han enviado los datos del formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener el ID de la cita desde el formulario
                $cita_id = intval($_POST['cita_id']);

                // Consultar la base de datos para obtener los detalles de la cita
                $sql = "SELECT * FROM campañascitas WHERE Id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("i", $cita_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nombre_usuario = $row['nombre_usuario'];
                    $correo = $row['correo'];
                    $nombre_campaña = $row['Nombre'];
                    $descripcion = $row['DescripcionCorta'];
                    $descripcion_completa = $row['Descripcion'];
                    $imagen = $row['Imagen']; // Suponiendo que la imagen está almacenada como base64
            ?>
                    <form action="../Controlador/Engine_MandarCorreo.php" method="post">
                        <div class="form-group">
                            <label for="nombre_usuario">Nombre del Usuario:</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombre_campaña">Nombre de la Campaña:</label>
                            <input type="text" id="nombre_campaña" name="nombre_campaña" value="<?php echo htmlspecialchars($nombre_campaña); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de la campaña" id="Imagen" style="width: 100px; height: auto;">
                        </div>
                        <div class="form-group">
                            <label for="descripcion_corta">Descripción Corta:</label>
                            <input type="text" id="descripcion_corta" name="descripcion_corta" value="<?php echo htmlspecialchars($descripcion); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="descripcion_completa">Descripción Completa:</label>
                            <textarea id="descripcion_completa" name="descripcion_completa"><?php echo htmlspecialchars($descripcion_completa); ?></textarea>
                        </div>
                        <input type="hidden" name="cita_id" value="<?php echo htmlspecialchars($cita_id); ?>">
                        <button type="submit">Mandar Correo</button>
                    </form>
            <?php
                } else {
                    echo "<p>No se encontró la cita.</p>";
                }

                $stmt->close();
            } else {
                echo "<p>No se han enviado datos del formulario.</p>";
            }
            ?>
        </section>
    </main>
</body>

</html>
