<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #fbb321;
        }

        .details,
        .footer {
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #555;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="text-[#fbb321]">¡Gracias por tu compra!</h1>
            <p>Hemos recibido tu pedido y será en procesado.</p>
        </div>

        <div class="details">
            <h2>Detalles del Pedido</h2>
            <p><strong>Código del Pedido:</strong> {{ $pedido->codigo }}</p>
            <p><strong>Fecha:</strong> {{ App\Utils\Util::formatearFecha($pedido->registro) }}</p>

            <h2>Datos de Facturación</h2>
            <p><strong>Nombre:</strong> {{ Str::ucfirst($datos->nombre) }} {{ Str::ucfirst($datos->apellido) }}</p>
            <p><strong>RUC o CI:</strong> {{ $datos->ruc_ci }}</p 
            <p><strong>Dirección:</strong> {{ $pedido->departamento }}, {{ $pedido->ciudad }}, {{ $pedido->calle }} </p>
            <p><strong>Teléfono:</strong> 0987654321</p>
            <p><strong>Correo Electrónico:</strong> {{ $pedido->email }}</p>

            <h2>Resumen de Productos</h2>
            <table class="table">
                <thead>                    
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listaPedido as $producto)
                    <tr>
                        <td style="padding: 8px; text-align: left; max-width: 200px;">
                            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <img 
                                        src="{{ asset('uploads/productos') }}/{{ $producto->producto->imagen }}" 
                                        alt="" 
                                        style="width: 35px; height: 35px; object-fit: cover;">
                                    <span style="margin-bottom: 8px;">{{ $producto->producto->nombre }}</span>
                                </div>
                            </div>
                        </td>                        
                        <td>{{ $producto->unidades }}</td>
                        <td>{{ number_format($producto->precio_unitario) }} Gs.</td>
                        <td>{{number_format(($producto->unidades)*($producto->precio_unitario))}} Gs.</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                        <td><strong></strong>{{ number_format($pedido->coste) }} Gs.</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footer">
            <p>Si tienes alguna duda, no dudes en contactarnos en <a
                    href="mailto:soporte@tuempresa.com">soporte@tuempresa.com</a>.</p>
            <p><strong>IMPORTANTE:</strong></p>
            <p>Si seleccionó la opción de <strong>retiro en local</strong>, será obligatorio presentar este correo como
                comprobante para verificar tu identidad.</p>
            <p>En caso de que hayas designado a un tercero para retirar el pedido, dicha persona deberá presentar su
                <strong>cédula de identidad y el codigo del pedido</strong> para completar el retiro.</p>

            <p>Gracias por confiar en nosotros.</p>
        </div>
    </div>
</body>

</html>
