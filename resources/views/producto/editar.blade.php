@extends('layouts.adm')

@section('contenidoAdm')
    <div class="mb-6 text-center pt-3">
        <b class="text-2xl text-gray-900 dark:text-white">Editar Producto: {{$producto->nombre}}</b>
        <div class="px-10 max-w-md mx-auto pt-6">
            <x-alertas />
        </div>
    </div>

    <div class="flex flex-col bg-white dark:bg-gray-800 px-6 py-6 rounded-lg shadow-md max-w-xl mx-auto">
        <form class="space-y-6" method="POST" action="{{ route('producto.editarSave') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">

            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Nombre Actual</b>
                </label>
                <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Descripcion Actual</b>
                </label>
                <textarea id="descripcion" rows="4" name="descripcion"
                    class="h-40 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    {{ $producto->descripcion }}
                </textarea>
            </div>

            <div class="mb-5">
                <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Precio Actual</b>
                </label>
                <input type="number" id="precio" name="precio" value="{{ $producto->precio }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Stock Actual</b>
                </label>
                <input type="number" id="stock" name="stock" value="{{ $producto->stock_actual }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <div class="mb-5">
                <label for="subcategoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Categoria Actual</b>
                </label>
                <select id="subcategoria" name="subcategoria"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}" {{ $subcategoria->id == $producto->subCategoria_id ? 'selected' : '' }}>
                            {{ $subcategoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Selecciona una foto</b> o puedes dejar vacío este campo
                </label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="imagen" name="imagen" type="file">
            </div>

            <div class="flex justify-between">
                <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar Cambios
                </button>
                <a href="{{ url()->previous() }}" class="text-gray-800 border border-gray-800 py-2 px-1 rounded-lg text-sm self-center hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
