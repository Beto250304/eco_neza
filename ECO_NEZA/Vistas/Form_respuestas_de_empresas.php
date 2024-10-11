<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco_Neza - Respuestas de empresas</title>
    <link rel="stylesheet" type="text/css" href="../estilos/Tablacitasrecolecion.css">
    <link rel="stylesheet" type="text/css" href="../estilos/Menu.css">
    <link rel="stylesheet" type="text/css" href="../estilos/respuestas.css">
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.left === "-200px") {
                menu.style.left = "0";
            } else {
                menu.style.left = "-200px";
            }
        }

        function confirmarUsuario(nombreUsuario) {
            if (confirm(`¿Seguro que quieres dar de alta a ${nombreUsuario}?`)) {
                document.getElementById('formConfirmar').submit();
            }
        }

        function rechazarUsuario(nombreUsuario) {
            if (confirm(`¿Seguro que quieres rechazar a ${nombreUsuario}?`)) {
                document.getElementById('formRechazar').submit();
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
            <li><a href="../Vistas/Form_solicitud_altas_admi.php" onclick="toggleMenu()">Solicitud de altas de
                    empresas</a></li>
            <li><a href="../Vistas/Form_Login.html" onclick="toggleMenu()">Cerrar Sesion</a></li>
        </ul>
    </nav>
    <main>
        <section class="welcome-section">
            <div class="header-container">
                <span class="header-title">Respuestas de empresas</span>
                <br><br>
                <div class="container">
                    <?php
                    include ("../Modelo/Configuracion.php");


                    // Obtener el nombre de usuario desde el formulario enviado
                    if (isset($_POST['nombre_usuario'])) {
                        $nombreUsuario = $_POST['nombre_usuario'];

                        // Consulta SQL para obtener los detalles del usuario específico
                        $sql = "SELECT * FROM alta WHERE nombre_usuario = '$nombreUsuario'";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nombreUsuario = $row['nombre_usuario'];
                            $correo = $row['correo'];
                            $nombreEmpresa = $row['nombre_empresa'];
                            $certificaciones = $row['certificaciones'];
                            $recoleccion = $row['recoleccion'];
                            $volumenReciclado = $row['volumen_reciclado'];
                            $materialesReciclados = $row['materiales_reciclados'];
                            $educacionConcientizacion = $row['educacion_concientizacion'];
                            $certificacionesReconocimientos = $row['certificaciones_reconocimientos'];
                            $responsabilidadSocial = $row['responsabilidad_social'];
                            ?>

                            <label for="nombre_usuario">Nombre de usuario: <?php echo $nombreUsuario; ?></label>
                            <br><br>
                            <label for="correo">Correo: <?php echo $correo; ?></label>
                            <br><br>
                            <label for="nombre_empresa">Nombre de la empresa: <?php echo $nombreEmpresa; ?></label>
                            <br><br>
                            <label for="certificaciones">Certificaciones: <?php echo $certificaciones; ?></label>
                            <br><br>
                            <label for="recoleccion">Recolección: <?php echo $recoleccion; ?></label>
                            <br><br>
                            <label for="volumen_reciclado">Volumen reciclado: <?php echo $volumenReciclado; ?></label>
                            <br><br>
                            <label for="materiales_reciclados">Materiales reciclados:
                                <?php echo $materialesReciclados; ?></label>
                            <br><br>
                            <label for="educacion_concientizacion">Educación y concientización:
                                <?php echo $educacionConcientizacion; ?></label>
                            <br><br>
                            <label for="certificaciones_reconocimientos">Certificaciones y reconocimientos:
                                <?php echo $certificacionesReconocimientos; ?></label>
                            <br><br>
                            <label for="responsabilidad_social">Responsabilidad social:
                                <?php echo $responsabilidadSocial; ?></label>
                            <br><br>


                            <!-- Formulario para confirmar -->
                            <form id="formConfirmar" action="../Controlador/confirmar.php" method="post">
                                <input type="hidden" name="nombre_usuario" value="<?php echo $nombreUsuario; ?>">
                                <input type="hidden" name="correo" value="<?php echo $correo; ?>">
                                <input type="hidden" name="nombre_empresa" value="<?php echo $nombreEmpresa; ?>">
                                <button type="button" class="confirmar"
                                    onclick="confirmarUsuario('<?php echo $nombreUsuario; ?>')">Confirmar</button>
                            </form>

                            <!-- Formulario para rechazar -->
                            <form id="formRechazar" action="../controlador/rechazar.php" method="post">
                                <input type="hidden" name="nombre_usuario" value="<?php echo $nombreUsuario; ?>">
                                <button type="button" class="rechazar"
                                    onclick="rechazarUsuario('<?php echo $nombreUsuario; ?>')">Rechazar</button>
                            </form>
                            <?php
                        } else {
                            echo "<p>No se encontraron detalles para este usuario.</p>";
                        }
                    } else {
                        echo "<p>No se proporcionó un nombre de usuario válido.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>