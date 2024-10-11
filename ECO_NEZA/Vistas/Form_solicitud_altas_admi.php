<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza</title>
    <link rel="stylesheet" type="text/css" href="../estilos/Tablacitasrecolecion.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/Menu.css">
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
            <li><a href="../Vistas/Form_menu_admi.php" onclick="toggleMenu()">Inicio</a></li>
            <li><a href="../Vistas/Form_citas_admi.php" onclick="toggleMenu()">Citas de servicio de recoleccion</a></li>
            <li><a href="../Vistas/Form_solicitud_altas_admi.php" onclick="toggleMenu()">Solicitud de altas de empresas</a></li>
            <li><a href="../Vistas/Form_Login.html" onclick="toggleMenu()">Cerrar Sesion</a></li>
        </ul>
    </nav>
    <main>
        <section class="welcome-section">
            <span style="display: block; font-weight: bold; font-size: 50px; color: #037216; text-align: center; margin: 0 auto;">Solicitud de altas de empresas</span>
            <section class="table-section">
                <table>
                    <tr>
                        <th>Nombre del usuario</th>
                        <th>Ver</th>
                        <th>Dar de alta</th>
                        <th>Dar de baja</th>
                    </tr>
                    <?php
                    
                    // Incluir el archivo de configuración de la base de datos
                    include("../Modelo/Configuracion.php");
                    // Consulta SQL para obtener los datos de la tabla solicitud_de_altas
                    $sql = "SELECT * FROM alta";
                    // Ejecutar la consulta
                    $result = $mysqli->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Recorrer los resultados y mostrarlos en la tabla
                        while ($row = $result->fetch_assoc()) {
                            $nombreUsuario = $row['nombre_usuario'];
                            echo "<tr>";
                            echo "<td>" . $nombreUsuario . "</td>";

                            // Formulario para enviar el nombre de usuario a from_respuestas_de_empresas.php
                            echo '<td>';
                            echo '<form method="post" action="../Vistas/Form_respuestas_de_empresas.php">';
                            echo '<input type="hidden" name="nombre_usuario" value="' . $nombreUsuario . '">';
                            echo '<button type="submit"><img src="../resources/boton_ojo.avif" width="50" height="50" alt="Ver"></button>';
                            echo '</form>';
                            echo '</td>';

                            // Botón de confirmar
                            echo '<td>';
                            echo '<form method="post" action="../controlador/confirmar.php">';
                            echo '<input type="hidden" name="nombre_usuario" value="' . $nombreUsuario . '">';
                            echo '<button type="submit"><img src="../resources/paloma.webp" width="50" height="50" alt="Confirmar"></button>';
                            echo '</form>';
                            echo '</td>';

                            // Botón de rechazar
                            echo '<td>';
                            echo '<form method="post" action="../controlador/rechazar.php">';
                            echo '<input type="hidden" name="nombre_usuario" value="' . $nombreUsuario . '">';
                            echo '<button type="submit"><img src="../resources/tache.webp" width="50" height="50" alt="Rechazar"></button>';
                            echo '</form>';
                            echo '</td>';

                            echo "</tr>";
                        }
                    } else {
                        // Si no hay resultados, mostrar un mensaje
                        echo "<tr><td colspan='4'>No hay resultados</td></tr>";
                    }
                    ?>
                </table>
            </section>
        </section>
    </main>
</body>

</html>
