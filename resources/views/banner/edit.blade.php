@extends('layouts.adm')

@section('tituloAdm', 'Editar Banner')

@section('contenidoAdm')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg dark:bg-gray-800">
        <x-alertas />
        <form action="{{ route('banner.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Subir Banner</h2>
            <input type="hidden" name="banner_id" value="{{ $banner->id }}">
            <div class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-4 mb-4 rounded">
                <p class="text-sm">* Sugerencia: se recomienda una imagen con relación de aspecto 9:10 para mejor
                    visualización.</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Titulo</label>
                <input value="{{ $banner->titulo == '' ? 'Sin titulo' : $banner->titulo }}" name="titulo" type="text"
                    id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Imagen del
                    Banner</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="banner_image" accept="image/*" aria-describedby="file_input_help" id="file_input" type="file">
            </div>

            <div class="w-full h-full pb-4 items-center">
                <span>Imagen actual</span>
                <img src="{{ asset("uploads/banners/$banner->imagen") }}" alt="{{ $banner->titulo }}"
                    class="w-full h-auto rounded-lg">
            </div>

            <label class=" pb-4" for="">Opciones del banner</label>
            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input {{ $banner->activo == false ? 'checked' : '' }} id="bordered-radio-1" type="radio" value="0" name="status"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-1"
                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Banner desactivado</label>
            </div>
            <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                <input {{ $banner->activo == true ? 'checked' : '' }} id="bordered-radio-2" type="radio" value="1" name="status"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-2"
                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Banner activo</label>
            </div>
            

            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="position">
                    Seleccionar Posición
                </label>
                <select name="position_id" id="position"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Seleccione una posición</option>
                    @foreach ($categories as $category => $positions)
                        <optgroup label="{{ $category }}">
                            @foreach ($positions as $position)
                                @if ($banner->position_id == $position->id)
                                    <option selected value="{{ $position->id }}">{{ $position->position }}</option>    
                                @else
                                    <option value="{{ $position->id }}">{{ $position->position }}</option>    
                                @endif
                                
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
                        @if ($producto->id == $banner->producto_id)
                            <option selected value="{{ $producto->id }}">
                                <p>#{{$producto->codigo}} | </p><br>                            
                                <p>{{ $producto->nombre }}</p>
                            </option>    
                        @else
                            <option selected value="{{ $producto->id }}">
                                <p>#{{$producto->codigo}} | </p><br>                            
                                <p>{{ $producto->nombre }}</p>
                            </option>    
                        @endif
                        
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white hover:bg-gray-700 p-2.5 rounded-lg font-semibold transition">
                Guardar cambios
            </button>
        </form>
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
