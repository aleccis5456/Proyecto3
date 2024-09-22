<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>{{ $titulo }}</h1>
    <p>Fecha: {{ $fecha }}</p>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Precio con oferta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta['codigo'] }}</td>
                    <td>{{ $venta['producto'] }}</td>
                    <td>{{ $venta['cantidad'] }}</td>
                    <td>{{ number_format($venta['precio'], 0, ',', '.') }} Gs.</td>
                    <td>{{ number_format($venta['precio_oferta'], 0, ',', '.') }} Gs.</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
