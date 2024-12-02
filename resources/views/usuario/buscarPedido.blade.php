@extends('layouts.app')

@section('titulo', 'Buscar mi pedido')
@section('contenido')
    
<div class="mt-10 max-w-md mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 text-center">
        Rastrear Pedido
    </h2>
    <x-alertas/>
    <form action="{{ route('buscar.pedidoget') }}" method="GET" class="flex flex-col gap-4">
        @csrf
        <label for="codigo" class="text-gray-700 dark:text-gray-300">
            Introduce el código de tu pedido:
        </label>
        <input type="text" name="codigo" id="codigo" 
               class="w-full p-3 border rounded-lg text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500"
               placeholder="Ejemplo: PED12345" required>
        
        <button type="submit"
            class="w-full px-4 py-2 text-gray-800 font-semibold bg-[#fbb321] rounded-lg hover:bg-yellow-200 hover:text-black focus:outline-none">
            Buscar Pedido
        </button>
    </form>
</div>
  
@endsection