@extends('layouts.app')
@section('titulo', 'Ingreso')

@section('contenido')

<div class="flex items-center justify-center py-10 bg-yellow-50 dark:bg-gray-900">
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden w-full max-w-lg border border-gray-200 dark:bg-gray-800">
        
        <!-- Sección del formulario de inicio de sesión -->
        <div class="w-full p-8">
            <h1 class="text-3xl font-bold text-[#fbb321] dark:text-[#fbb321] pb-4 text-center">Ingresar</h1>

            <div class="mb-4">
                <x-alertas />
            </div>
            
            <form method="POST" action="{{ route('loginSave') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-yellow-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-[#fbb321] focus:border-[#fbb321] block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#fbb321] dark:focus:border-[#fbb321]" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="bg-yellow-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-[#fbb321] focus:border-[#fbb321] block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#fbb321] dark:focus:border-[#fbb321]" />
                </div>

                <button type="submit"
                    class="w-full text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-md text-sm px-5 py-2.5 text-center transition-all duration-200">
                    Ingresar
                </button>

                <span class="block text-sm text-gray-500 mt-4 text-center">
                    ¿Olvidaste tu Contraseña? 
                    <a href="{{ route('forgot.pass') }}" class="text-[#fbb321] hover:underline hover:text-[#d19b1f]">Haz clic aquí</a>
                </span>
            </form>
        </div>
    </div>
</div>

@endsection
