<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Seguro</title>
    <link rel="stylesheet" href="../Estilos/Pago.css">
    <link rel="stylesheet" href="../Resources/css/main2.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="payment-container">
    <div class="footer-image-container">
            <img src="../Resources/images/EcoNeza.png" alt="EcoNeza" class="footer-image">
        </div>

        <br><br><br>
        <div class="payment-header">
        </div>
        <div class="payment-body">
            <br><br>
            <div id="smart-button-container">
                <br><br><br><br>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
    
        
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"description":"ECO_NEZA","amount":{"currency_code":"USD","value":13}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        actions.redirect('LA URL DE TU PAGINA DE GRACIAS');
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6665768a981b6c56477b401d/1hvu5e3q0';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!-- Scripts -->
    <script src="../Resources/js/jquery.min.js"></script>
    <script src="../Resources/js/jquery.dropotron.min.js"></script>
    <script src="../Resources/js/jquery.scrollex.min.js"></script>
    <script src="../Resources/js/browser.min.js"></script>
    <script src="../Resources/js/breakpoints.min.js"></script>
    <script src="../Resources/js/util.js"></script>
    <script src="../Resources/js/main.js"></script>
</body>
</html>
