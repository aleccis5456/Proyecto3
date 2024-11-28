<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        /* Configuración general del ticket */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 58mm;
            /* Ancho del ticket */
            padding: 10px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }

        /* Encabezado del ticket */
        .ticket .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .ticket .header h1 {
            font-size: 16px;
            margin: 0;
        }

        .ticket .header p {
            margin: 2px 0;
        }

        /* Detalle de productos */
        .ticket .details {
            margin-bottom: 10px;
        }

        .ticket .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .ticket .details table th,
        .ticket .details table td {
            text-align: left;
            padding: 4px;
        }

        .ticket .details table th {
            border-bottom: 1px solid #000;
        }

        /* Total */
        .ticket .total {
            text-align: right;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <!-- Encabezado -->
        <div class="header">
            <h1>Electro Max</h1>
            <p>Dirección del negocio</p>
            <p>Teléfono: 123-456-789</p>
            <p>Fecha de compra: 2024-11-27</p>
            <br>
            <p>Cliente: </p>
        </div>

        <!-- Detalle de productos -->
        <div class="details">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                @php
                    $total = 0;
                @endphp

                <tbody>
                    @foreach ($lista as $item)
                        <tr>
                            <td>{{ $item->producto->nombre }}</td>
                            <td>{{ $item->unidades }}</td>
                            <td>{{ $item->precio_unitario }}</td>
                        </tr>
                        @php
                            $total += $item->precio_unitario;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="total">
            <p><strong>Total: {{ $total }}</strong></p>
        </div>


        <p>Gracias por su compra!</p>
    </div>
</body>

</html>
