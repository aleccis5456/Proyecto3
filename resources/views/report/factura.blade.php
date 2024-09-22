<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info div {
            width: 45%;
        }

        .info h3 {
            margin: 0 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Solo líneas horizontales */
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
            border-top: 1px solid #ddd; /* Borde superior */
            border-bottom: 2px solid #ddd; /* Borde inferior más grueso para separar el encabezado */
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
            font-size: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Cabecera -->
        <div class="header">
            <h1>Factura</h1>
            <p><strong>Empresa ElectroMax</strong></p>
            <p>1234 Calle Principal, Ciudad</p>
            <p>Email: contacto@electromax.com | Tel: +123 456 789</p>
        </div>

        <!-- Información de la factura -->
        <div class="info">
            <div>
                <h3>Datos del Cliente</h3>
                <p><strong>Nombre:</strong> {{ $datos->nombre }} {{$datos->apellido}}</p>
                <p><strong>Ruc o CI:</strong> {{ $datos->ruc_ci }}</p>
                <p><strong>Dirección:</strong> {{ $pedido->calle }}</p>
                <p><strong>Teléfono:</strong> {{ $pedido->celular }}</p>
            </div>
            <div>
                <h3>Detalles de la Factura</h3>
                <p><strong>Nro. Factura:</strong> #12345</p>
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td>{{ $producto['codigo'] }}</td>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ number_format($producto['precio_unitario'], 0, ',', '.') }} Gs.</td>
                    <td>{{ number_format($producto['cantidad'] * $producto['precio_unitario'], 0, ',', '.') }} Gs.</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="total">
            Total a Pagar: {{ number_format($pedido->coste, 0, ',', '.') }} Gs.
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Gracias por su compra. ¡Vuelva pronto!</p>
    </div>

</body>

</html>
