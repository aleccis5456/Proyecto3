<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Registro Administración</title>
</head>

<body>
    <header>

        <br>
        <br>
        <br>        

    </header>

    <body>
        {{-- <form action=" {{ route('adm.login') }} " method="GET">
            <div class="max-w-sm mx-auto ">                
                <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    <svg class="w-6 h-6 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                      </svg>
                      
                </button>
            </div>
        </form> --}}        
        <form method="POST" action=" {{ route('adm.registroSave') }} "
            class="max-w-sm mx-auto p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-md backdrop-blur-sm bg-opacity-80">
            @csrf
            <div class="">
                <x-alertas />
            </div>
            <div class="mb-6">
                <b class="text-xl text-gray-900 dark:text-white">Registro de Administradores</b>
                
            </div>
            <div class="mb-5">
                <label for="nombre"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nombre</label>
                <input type="text" name="nombre" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" />
            </div>
            <div class="mb-5">
                <label for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" />
            </div>
            <div class="mb-5">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" />
            </div>
            <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Registrar
            </button>                
            
            <a href="{{ route('vendedores.showRegister') }}" class="pl-12 text-sm text-gray-600  hover:text-gray-600 hover:underline  hover:font-bold">Registrar un repartidor</a>
            <a href="{{ route('cajero.registerform') }}" class="pl-[152px] text-sm text-gray-600  hover:text-gray-600 hover:underline  hover:font-bold ">Registrar un cajero</a>
            
        </form>

    </body>
</body>

</html>
