<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <style>
        /* Asegurarse de que Gmail acepte estilos en línea */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
        }

        .header p {
            color: #4a5568;
            font-size: 16px;
        }

        .content {
            color: #2d3748;
            font-size: 16px;
            margin-bottom: 24px;
        }

        .button-container {
            text-align: center;
            margin-bottom: 24px;
        }

        .button {
            display: inline-block;
            background-color: #4299e1;
            color: #ffffff;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #3182ce;
        }

        .footer {
            text-align: center;
            color: #718096;
            font-size: 14px;
        }

        .footer hr {
            margin: 24px 0;
            border: none;
            border-top: 1px solid #e2e8f0;
        }

        .footer a {
            color: #4299e1;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Recuperar Contraseña</h1>
            <p>Hola {{ ucfirst($user->name) }}, parece que has solicitado recuperar tu contraseña.</p>
        </div>

        <div class="content">
            <p>Si no fuiste tú, puedes ignorar este mensaje. De lo contrario, haz clic en el siguiente botón para
                restablecer tu contraseña:</p>
        </div>

        <div class="button-container">
            <a href="{{ route('cambiar.pass', ['id' => $user->id]) }}" class="button">Restablecer Contraseña</a>
        </div>

        <p class="content">Este enlace es válido solo por 60 minutos.</p>

        <div class="footer">
            <hr>
            <p>Si tienes algún problema, no dudes en contactarnos en <a href="mailto:soporte@tuapp.com">soporte@tuapp.com</a>.</p>
        </div>
    </div>
</body>

</html>
