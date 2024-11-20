@extends('layouts.app')
@section('titulo', 'Registro')

@section('contenido')

<div class="max-w-md mx-auto pt-6">
    <h1 class="text-4xl font-semibold text-[#fbb321] pb-9">Registrarme</h1>

    <div class="mb-4">
        <x-alertas />
    </div>

    <form method="POST" action="{{ route('usuario.registroSave') }}">
        @csrf
        <div class="relative z-0 w-full mb-5 group">
            <input type="email" name="email" id="email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                placeholder=" " required />
            <label for="email"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Correo
                electrónico</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                placeholder=" " required />
            <label for="password"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                placeholder=" " required />
            <label for="password_confirmation"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar
                Contraseña</label>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nombre" id="nombre"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                    placeholder=" " required />
                <label for="nombre"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="apellido" id="apellido"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                    placeholder=" " required />
                <label for="apellido"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
            </div>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="number" name="celular" id="celular"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-[#fbb321] appearance-none focus:outline-none focus:ring-0 focus:border-black peer"
                placeholder=" " required />
            <label for="celular"
                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-black peer-focus:scale-75 peer-focus:-translate-y-6">Número
                de celular</label>
        </div>

        <button type="submit"
            class="text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition-all duration-200">Registrarme</button>
    </form>
</div>

@endsection
