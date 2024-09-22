<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <style>
        /* Quitar márgenes de la página */
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .container {
            padding: 10px;
        }

        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 14px;
        }

        .header p {
            margin: 0;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabecera -->
        <div class="header">
            <h1>Listado de Productos</h1>
            <p>Empresa ElectroMax</p>
            <p>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Stock Actual</th>
                    <th>Precio</th>
                    <th>Precio Oferta</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto['codigo'] }}</td>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['stock'] }}</td>
                    <td class="text-right">{{ number_format($producto['precio'], 0, ',', '.') }} Gs.</td>
                    <td class="text-right">{{ number_format($producto['precio_oferta'], 0, ',', '.') }} Gs.</td>
                    <td>{{ \Carbon\Carbon::parse($producto['registro'])->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
