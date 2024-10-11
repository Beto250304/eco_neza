<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza - Citas de servicio de recolección</title>
    <link rel="stylesheet" href="../Resources/css/main.css">
    <link rel="stylesheet" href="../Estilos/CitasAdmin.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="is-preload">
<header id="header">
            <h1><a href="">Eco Neza</a></h1>
            <nav id="nav">
                <ul>
                    <li><a href="../Vistas/Form_menu_admi.php">Inicio</a></li>
                    <li><a href="../Vistas/Form_citas_admi.php">Citas de servicio de recoleccion</a></li>
                    <li><a href="../Vistas/Form_solicitudCampañas.php">Solicitud de campañas</a></li>
                    <li><a href="../Vistas/Form_solicitud_altas_admi.php">Solicitud de altas de empresas</a></li>
                    <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

    <main>
        <section class="welcome-section">
            <br><br>
            <span style="display: block; font-weight: bold; font-size: 50px; color: #037216; text-align: center; margin: 0 auto;">Citas de servicio de recolección</span>
            <section class="table-section">
                <table>
                    <tr>
                        <th>Nombre del usuario</th>
                        <th>Correo electrónico</th>
                        <th>Nombre de la empresa</th>
                        <th>Producto</th>
                        <th>Cantidad kg</th>
                        <th>Direccion</th>
                        <th>Horario</th>
                        <th>Fecha</th>
                        <th>Costo</th>
                        <th>Estatus</th>
                    </tr>
                    <?php
                    // Incluir el archivo de configuración de la base de datos
                    include("../Modelo/Configuracion.php");

                    // Consulta SQL para obtener los datos de la tabla citas_de_usuario
                    $sql = "SELECT * FROM citas";
                    // Ejecutar la consulta
                    $result = $mysqli->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Recorrer los resultados y mostrarlos en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['usuario'] . "</td>";
                            echo "<td>" . $row['correo'] . "</td>";
                            echo "<td>" . $row['NombreEmpresa'] . "</td>";
                            echo "<td>" . $row['producto'] . "</td>";
                            echo "<td>" . $row['cantidad'] . "</td>";
                            echo "<td>" . $row['direccion'] . "</td>";
                            echo "<td>" . $row['hora'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td>" . $row['costo'] . "</td>";
                            // Agregar el botón de eliminación con un formulario
                            echo "<td>";
                            echo "<form action='../Controlador/Engine_EliminarCita.php' method='POST'>";
                            echo "<input type='hidden' name='cita_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' onclick='return confirm(\"Esta cita ya esta lista?\")'>Listo</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Si no hay resultados, mostrar un mensaje
                        echo "<tr><td colspan='13'>No hay citas registradas.</td></tr>";
                    }
                    ?>
                </table>
            </section>
        </section>
    </main>
</body>

</html>
