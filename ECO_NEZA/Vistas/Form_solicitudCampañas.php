<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza - Citas de servicio de recolección</title>
    <link rel="stylesheet" type="text/css" href="../estilos/Tablacitasrecolecion.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/Menu.css">
    <style>
        /* Estilos personalizados aquí */
    </style>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.left === "-200px") {
                menu.style.left = "0";
            } else {
                menu.style.left = "-200px";
            }
        }
    </script>
</head>

<body>
    <header>
        <button class="menu-button" onclick="toggleMenu()">☰ Menú</button>
    </header>
    <nav class="menu" id="menu">
        <ul>
            <li><a href="../vistas/Form_menu_admi.php" onclick="toggleMenu()">Inicio</a></li>
            <li><a href="../vistas/Form_citas_admi.php" onclick="toggleMenu()">Citas de servicio de recolección</a></li>
            <li><a href="../vistas/Form_solicitud_altas_admi.php" onclick="toggleMenu()">Solicitud de altas de empresas</a></li>
            <li><a href="../Vistas/Form_solicitudCampañas.php" onclick="toggleMenu()">Solicitud de campañas</a></li>
            <li><a href="../vistas/Form_login_admi.html" onclick="toggleMenu()">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main>
        <section class="welcome-section">
            <span style="display: block; font-weight: bold; font-size: 50px; color: #037216; text-align: center; margin: 0 auto;">Gestión de campañas</span>
            <section class="table-section">
                <table>
                    <tr>
                        <th>Nombre del usuario</th>
                        <th>Correo electrónico</th>
                        <th>Nombre de la campaña</th>
                        <th>Descripción corta</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                    <?php
                    // Incluir el archivo de configuración de la base de datos
                    include("../Modelo/Configuracion.php");

                    // Consulta SQL para obtener los datos de la tabla campañascitas
                    $sql = "SELECT * FROM campañascitas";
                    // Ejecutar la consulta
                    $result = $mysqli->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Recorrer los resultados y mostrarlos en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nombre_usuario']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['DescripcionCorta']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                            // Mostrar la imagen
                            echo "<td><img src='data:image/jpeg;base64," . htmlspecialchars($row['Imagen']) . "' alt='Imagen de la campaña' style='width: 100px; height: auto;'></td>";
                            // Agregar el botón de enviar correo con formulario
                            echo "<td>";
                            echo "<form action='../Vistas/Form_MandarCorreo.php' method='POST'>";
                            echo "<input type='hidden' name='cita_id' value='" . htmlspecialchars($row['Id']) . "'>";
                            echo "<input type='hidden' name='nombre_usuario' value='" . htmlspecialchars($row['nombre_usuario']) . "'>";
                            echo "<input type='hidden' name='correo' value='" . htmlspecialchars($row['correo']) . "'>";
                            echo "<input type='hidden' name='nombre_campaña' value='" . htmlspecialchars($row['Nombre']) . "'>";
                            echo "<input type='hidden' name='descripcion_corta' value='" . htmlspecialchars($row['DescripcionCorta']) . "'>";
                            echo "<input type='hidden' name='descripcion_completa' value='" . htmlspecialchars($row['Descripcion']) . "'>";
                            echo "<input type='hidden' name='imagen' value='" . htmlspecialchars($row['Imagen']) . "'>"; // Campo oculto para la imagen
                            echo "<button type='submit'>Mandar Correo</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Si no hay resultados, mostrar un mensaje
                        echo "<tr><td colspan='7'>No hay citas registradas.</td></tr>";
                    }
                    ?>
                </table>
            </section>
        </section>
    </main>
</body>

</html>
