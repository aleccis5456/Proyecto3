@extends('layouts.app')
@section('titulo', 'Ingreso')

@section('contenido')
    <div class="p-10">
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('cambiarSave') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <h1 class=" text-4xl font-semibold text-gray-900 dark:text-white pb-9">Cambio de contraseña</h1>
            <x-alertas/>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña Nueva</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                    <button type="button" onclick="togglePasswordVisibility('password')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 3C5.5 3 2 7 2 10s3.5 7 8 7 8-4 8-7-3.5-7-8-7zM10 5c2.8 0 5.5 2.2 6.7 5-1.2 2.8-3.9 5-6.7 5-2.8 0-5.5-2.2-6.7-5C4.5 7.2 7.2 5 10 5zM10 7a3 3 0 0 0 0 6c1.7 0 3-1.3 3-3s-1.3-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Confirmar Contraseña</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                    <button type="button" onclick="togglePasswordVisibility('password_confirm')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 3C5.5 3 2 7 2 10s3.5 7 8 7 8-4 8-7-3.5-7-8-7zM10 5c2.8 0 5.5 2.2 6.7 5-1.2 2.8-3.9 5-6.7 5-2.8 0-5.5-2.2-6.7-5C4.5 7.2 7.2 5 10 5zM10 7a3 3 0 0 0 0 6c1.7 0 3-1.3 3-3s-1.3-3-3-3z"/>
                        </svg>
                    </button>
                </div>
            </div>           
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cambiar</button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            var input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>

@endsection
