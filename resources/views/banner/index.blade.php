@extends('layouts.adm')

@section('tituloAdm', 'Agregar Banner')

@section('contenidoAdm')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg dark:bg-gray-800">
        <x-alertas />
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Subir Banner</h2>

            <div class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-4 mb-4 rounded">
                <p class="text-sm">* Sugerencia: se recomienda una imagen con relación de aspecto 9:10 para mejor
                    visualización.</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Titulo</label>
                <input name="titulo" type="text" id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Imagen del
                    Banner</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="banner_image" accept="image/*" aria-describedby="file_input_help" id="file_input" type="file">

            </div>

            <div class="flex items-center justify-between mb-6">
                <span class="text-gray-800 dark:text-white font-medium">Activar Banner</span>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="1" class="sr-only peer" name="activo">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>

            </div>

            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="position">
                    Seleccionar Posición
                </label>
                <select name="position_id" id="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Seleccione una posición</option>
                    @foreach ($categories as $category => $positions)
                        <optgroup label="{{ $category }}">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->position }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                
            </div>            

            <div class="pb-5">
                <label for="subcategoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relacionar con un prodcuto</label>
                <select id="subcategoria" name="producto_id"
                    class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Selecciona un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">
                            <p>#{{$producto->codigo}} | </p><br>                            
                            <p>{{ $producto->nombre }}</p>
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="urls">Asociar a una url (busqueda)</label>
                <input name="url" type="text" id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            
            <button type="submit"
                class="w-full bg-gray-800 text-white hover:bg-gray-700 p-2.5 rounded-lg font-semibold transition">
                Subir Banner
            </button>
        </form>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg dark:bg-gray-800">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Lista de Banners</h2>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700">Titulo</th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700">Imagen</th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700">Activo</th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700">Posicion</th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @foreach ($banners as $banner)
                    <tr>
                        <td class="px-6 py-4">{{ $banner->titulo }}</td>
                        <td class="px-6 py-4">
                            <img src="{{ asset("uploads/banners/$banner->imagen") }}" alt="{{ $banner->titulo }}"
                                class="w-32 h-auto rounded-lg">
                        </td>
                        <td class="px-6 py-4 {{ $banner->activo == true ? 'text-green-500 font-bold' : 'text-red-500 font-bold' }}">
                            @if ($banner->activo)
                                Sí
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            {{ $banner->position->category }} - {{ $banner->position->position }}
                        </td>
                        <td>
                            <a class="hover:font-bold hover:text-gray-600" href="{{ route('banner.showFormEdit', ['id' => $banner->id]) }}">
                                Editar
                            </a>
                            <a onclick="return confirm('Estas seguto de eliminar este banner?')" class="hover:font-bold hover:text-gray-600" href="{{ route('banner.delete', ['id' => $banner->id]) }}">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#subcategoria').select2({
                placeholder: 'Selecciona una categoría',
                allowClear: true
            });
        });
    </script>

@endsection
