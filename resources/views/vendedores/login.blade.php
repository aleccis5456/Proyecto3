<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login de Repartidores</title>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="flex w-4/5 h-auto bg-white rounded-lg shadow-lg">
        
        <!-- Columna del formulario de inicio de sesión -->
        <div class="w-1/2 p-8">
            <form method="POST" action="{{ route('vendedores.login') }}"            
                class="p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-md backdrop-blur-sm bg-opacity-80">            
                <x-alertas/>

                @csrf
                <div class="mb-6 text-center">
                    <b class="text-2xl text-gray-900 dark:text-white">Login de Repartidores</b>
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" required />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" required />
                </div>  
                <button type="submit" class="w-full text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Ingresar</button>
                <div class="pt-12 text-center flex items-center justify-center">                   
                    <a href="{{ route('vendedores.showlogin') }}" class="{{ request()->is('vend/login') ? 'text-gray-500 font-semibold' : 'text-gray-500 text-sm hover:underline'}}">Repartidor</a>
                    <p class="px-1 text-gray-500">|</p>
                    <a href="{{ route('cajero.loginform') }}" class="{{ Route::is('cajero.loginform') ? 'text-gray-500 font-semibold' : 'text-gray-500 text-sm hover:underline'}}">Caja</a>
                </div>
            </form>
        </div>

        <!-- Columna de la información sobre vendedores -->
        {{-- <div class="w-1/2 bg-gray-600 text-white p-8 rounded-r-lg flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4">¿Qué es un Vendedor?</h2>
            <p class="text-lg mb-4">Un vendedor es el encargado de promover y vender productos o servicios a clientes potenciales. Su objetivo es identificar oportunidades, cerrar ventas y mantener relaciones a largo plazo con los clientes.</p>
            <ul class="list-disc ml-5 space-y-2">
                <li>Identificación de oportunidades de venta</li>
                <li>Presentación de productos o servicios</li>
                <li>Cierre de ventas y negociación</li>
                <li>Mantenimiento de relaciones con los clientes</li>                
            </ul>
        </div> --}}
    </div>
</body>
</html>
