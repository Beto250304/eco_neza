<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Citas de servicio de recolección</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/EmpresasCitas.css">
</head>

<body>
<header id="header">
        <h1><a href="">CAMPAÑAS</a></h1>
        <nav id="nav">
            <ul>
                <li><a href="../Vistas/Form_MenuEmpresa.php">Inicio</a></li>
                <li><a href="../Vistas/Form_CampañasEmpresa.php">Altas y bajas de campañas</a></li>
                <li><a href="../Vistas/Form_CitasEmpresa.php">Citas Empresa</a></li>
                <li><a href="../Vistas/Form_EditarPrecios.php">Altas y bajas de precios</a></li>
                <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <br><br><br>
            <h1 style="text-align: center; color: #037216;">Citas de servicio de recolección</h1>
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre del usuario</th>
                            <th>Correo electrónico</th>
                            <th>Producto</th>
                            <th>Cantidad kg</th>
                            <th>Dirección</th>
                            <th>Horario</th>
                            <th>Fecha</th>
                            <th>Costo</th>
                            <th>Estatus</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Incluir el archivo de configuración de la base de datos
                        include("../Modelo/Configuracion.php");

                        // Verificar si el usuario está logueado
                        session_start();
                        if (!isset($_SESSION['correo'])) {
                            header("Location: ../Vistas/Form_Login.html");
                            exit();
                        }

                        // Obtener el correo del usuario logueado
                        $correo = $_SESSION['correo'];

                        // Consulta SQL para obtener las citas asociadas a la empresa del usuario
                        $sql = "SELECT * FROM citas WHERE NombreEmpresa = (SELECT NombreEmpresa FROM empresas WHERE CorreoNuevo = ?)";

                        // Preparar la consulta
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("s", $correo);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Verificar si hay resultados
                        if ($result->num_rows > 0) {
                            // Mostrar las citas en la tabla
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['usuario'] . "</td>";
                                echo "<td>" . $row['correo'] . "</td>";
                                echo "<td>" . $row['producto'] . "</td>";
                                echo "<td>" . $row['cantidad'] . "</td>";
                                echo "<td>" . $row['direccion'] . "</td>";
                                echo "<td>" . $row['hora'] . "</td>";
                                echo "<td>" . $row['fecha'] . "</td>";
                                echo "<td>" . $row['costo'] . "</td>";
                                echo "<td>" . $row['estatus'] . "</td>"; // Mostrar el campo de estatus
                                echo "<td>";
                                echo "<form action='../Controlador/Engine_EliminarCita.php' method='POST'>";
                                echo "<input type='hidden' name='cita_id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' class='btn-delete' onclick='return confirm(\"¿Esta cita ya está lista?\")'>Eliminar</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Si no hay citas registradas para la empresa, mostrar un mensaje
                            echo "<tr><td colspan='10'>No hay citas registradas para esta empresa.</td></tr>";
                        }

                        // Cerrar statement y conexión
                        $stmt->close();
                        $mysqli->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
