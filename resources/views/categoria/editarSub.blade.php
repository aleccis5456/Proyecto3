@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')
    <div class=""> <!-- Contenedor principal con Flexbox -->
        <!-- Formulario -->
        <div class="p-4"> <!-- 50% del ancho para el formulario -->
            <form class="max-w-sm mx-auto" method="POST" action="{{ route('editarSubSave') }}">
                <br><br><br><br>
                @csrf
                <div class="">
                    <x-alertas />
                </div>
                <input type="hidden" name="sub_id"  value="{{ $sub->id }}">
                <div class="mb-6">
                    <b class="text-2xl text-gray-900 dark:text-white">Editar Sub Categoria: {{ $sub->nombre }}</b>
                </div>
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Categoria</label>
                    <input value="{{ $sub->nombre }}" type="text" id="nombre" name="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Cambiar Categoria</label>
                <select id="categoria" name="categoria"
                    class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categorias as $categoria)
                        @if ($sub->categoria_id == $categoria->id)
                            {{-- <option selected value="0">Selecciona una Categoria</option>     --}}
                            <option selected value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @else
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endif
                    @endforeach
                </select>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar
                    Cambios</button>
            </form>
        </div>
    </div>

@endsection
