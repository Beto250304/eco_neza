<?php
session_start();
if (!isset($_SESSION['correo']) || !isset($_SESSION['nombre_usuario'])) {
    header("Location: ../Vistas/Form_Login.html");
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];

// Obtener los valores de la URL y asegurarse de que están definidos
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$material = isset($_GET['material']) ? $_GET['material'] : '';
$costo = isset($_GET['costo']) ? $_GET['costo'] : '';
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : ''; // Asegúrate de que 'NombreEmpresa' esté en $_GET

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio de Recolección</title>
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/RecogerMaterial.css">
    <!-- Incluir Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
<header id="header">
    <h1><a href="">Eco Neza</a></h1>
    <nav id="nav">
        <ul>
            <li><a href="../Vistas/Form_Menu.php">Inicio</a></li>
            <li><a href="../Vistas/Form_Campañas.php">Campañas</a></li>
            <li><a href="../Vistas/Form_CompraVenta.php">Compra y venta</a></li>
            <li><a href="../Vistas/Form_DardeAltaEmpresa.php">Dar de alta tu empresa</a></li>
            <li><a href="../Vistas/Form_Carrito.php">Carrito de compra</a></li>
            <li><a href="../Vistas/Form_Login.html">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>
<main class="container">
    <div class="form-container">
        <h1>Servicio de Recolección</h1>
        <form id="citasForm" action="../Controlador/Engine_Citas.php" method="POST">
            <input type="hidden" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <input type="hidden" id="nombre_usuario" name="usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>">
            <input type="hidden" id="correo" name="correo" value="<?php echo htmlspecialchars($_SESSION['correo']); ?>">

            <div class="form-group">
                <label for="producto">Producto:</label>
                <input type="text" class="form-control" id="producto" name="producto" value="<?php echo htmlspecialchars($material); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad kg:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="horario">Horario:</label>
                <div class="horario">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="7am" name="hora" value="7am">
                        <label class="form-check-label" for="7am">7 AM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="8am" name="hora" value="8am">
                        <label class="form-check-label" for="8am">8 AM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="9am" name="hora" value="9am">
                        <label class="form-check-label" for="9am">9 AM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="10am" name="hora" value="10am">
                        <label class="form-check-label" for="10am">10 AM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="11am" name="hora" value="11am">
                        <label class="form-check-label" for="11am">11 AM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="12pm" name="hora" value="12pm">
                        <label class="form-check-label" for="12pm">12 PM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="1pm" name="hora" value="1pm">
                        <label class="form-check-label" for="1pm">1 PM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="2pm" name="hora" value="2pm">
                        <label class="form-check-label" for="2pm">2 PM</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="3pm" name="hora" value="3pm">
                        <label class="form-check-label" for="3pm">3 PM</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="costo">Costo Total ($):</label>
                <input type="text" class="form-control" id="costo" name="costo" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Cita</button>
        </form>

        <div id="map"></div>
    </div>
</main>
<!-- Incluir Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<!-- Incluir Axios JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function validarFecha() {
        var fecha = document.getElementById('fecha').value;
        if (!fecha) {
            alert('Por favor, ingresa una fecha válida.');
            return false;
        }
        return true;
    }
    // Función para calcular el costo total basado en la cantidad y el costo por kg
    function calcularCosto() {
        var cantidad = document.getElementById('cantidad').value;
        var costoPorKg = <?php echo $costo; ?>;
        var costoTotal = cantidad * costoPorKg;
        document.getElementById('costo').value = costoTotal;
    }

    // Añadir evento para recalcular el costo cuando se cambie la cantidad
    document.getElementById('cantidad').addEventListener('input', calcularCosto);

    // Inicializar el mapa de Leaflet
    var map = L.map('map').setView([19.432608, -99.133209], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Obtener y mostrar la ubicación del usuario
    map.locate({ setView: true, maxZoom: 16 });

    function onLocationFound(e) {
        var radius = e.accuracy / 2;
        L.marker(e.latlng).addTo(map)
            .bindPopup("You are within " + radius + " meters from this point").openPopup();
        L.circle(e.latlng, radius).addTo(map);
    }

    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationerror', onLocationError);

    // Función para obtener coordenadas de la dirección ingresada
    function obtenerCoordenadas(direccion) {
        var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}`;
        axios.get(url)
            .then(function(response) {
                if (response.data && response.data.length > 0) {
                    var lat = response.data[0].lat;
                    var lon = response.data[0].lon;
                    map.setView([lat, lon], 16);
                    L.marker([lat, lon]).addTo(map);
                } else {
                    alert('No se encontraron coordenadas para la dirección ingresada.');
                }
            })
            .catch(function(error) {
                console.error('Error al obtener coordenadas:', error);
                alert('Error al obtener coordenadas de la dirección ingresada.');
            });
    }

    // Evento para buscar la dirección cuando el campo de dirección pierde el foco
    document.getElementById('direccion').addEventListener('blur', function() {
        var direccion = document.getElementById('direccion').value;
        if (direccion) {
            obtenerCoordenadas(direccion);
        }
    });
</script>
</body>
</html>
