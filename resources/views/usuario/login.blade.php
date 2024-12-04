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
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="bg-yellow-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-[#fbb321] focus:border-[#fbb321] block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#fbb321] dark:focus:border-[#fbb321]" />
                        <button type="button" id="togglePassword" 
                            class="absolute inset-y-0 right-2 flex items-center text-gray-500 dark:text-gray-300">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                              </svg>
                              
                        </button>
                    </div>
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


<script>
    const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

// SVG para los íconos
const eyeOpenIcon = `
<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
  <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
</svg>`;
const eyeClosedIcon = `
<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
</svg>`;

togglePassword.innerHTML = eyeClosedIcon; // Ícono inicial

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Cambiar el ícono del botón
    this.innerHTML = type === 'password' ? eyeClosedIcon : eyeOpenIcon;
});

</script>

@endsection
