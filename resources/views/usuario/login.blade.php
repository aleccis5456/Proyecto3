@extends('layouts.app')
@section('titulo', 'Ingreso')

@section('contenido')

<div class="flex items-center justify-center  py-10  bg-gray-100 dark:bg-gray-900">
    <div class="flex bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-4xl dark:bg-gray-800">
        
        <!-- Sección del formulario de inicio de sesión -->
        <div class="w-1/2 p-8">
            <h1 class="text-4xl font-semibold text-blue-700 dark:text-blue-400 pb-6 text-center">Ingresar</h1>

            <div class="mb-4">
                <x-alertas />
            </div>
            
            <form method="POST" action="{{ route('loginSave') }}">
                @csrf
                
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-700 focus:border-blue-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-700 dark:focus:border-blue-700" />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-700 focus:border-blue-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-700 dark:focus:border-blue-700" />
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200">
                    Ingresar
                </button>

                <span class="block text-sm text-gray-500 mt-4 text-center">
                    ¿Olvidaste tu Contraseña? 
                    <a href="{{ route('forgot.pass') }}" class="text-blue-700 hover:underline hover:text-blue-800 dark:text-blue-400">Haz clic aquí</a>
                </span>
            </form>
        </div>

        <!-- Sección de imágenes / Información -->
        <div class="w-1/2 bg-blue-700 flex flex-col items-center justify-center p-8 text-white">
            <h2 class="text-2xl font-bold mb-4">Bienvenido</h2>
            <p class="mb-4">Descubre nuestras soluciones y servicios para tu negocio.</p>
            <img src="{{ asset('images/company-image.jpg') }}" alt="Imagen de la empresa" class="w-64 h-64 object-cover rounded-lg shadow-md mb-4">
            <p class="text-sm text-center">Innovando para un mejor futuro.</p>
        </div>
    </div>
</div>

@endsection
