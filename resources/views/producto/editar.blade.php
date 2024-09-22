@extends('layouts.adm')

@section('contenidoAdm')
    <div class="mb-6 text-center pt-3">
        <b class="text-2xl text-gray-900 dark:text-white">Editar Producto: {{$producto->nombre}}</b>
        <div class="px-10 max-w-md mx-auto pt-6">
            <x-alertas />
        </div>
    </div>


    <div class="flex ml-12">
        <div class="w-1/2 pt-1 ">
            <form class="max-w-sm mx-auto" method="POST" action="{{ route('producto.editarSave') }}"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 
                    dark:text-white">
                        <b>Nombre Actual</b></label>
                    <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Descripcion Actual</b></label>
                <textarea id="descripcion" rows="4" name="descripcion"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >{{ $producto->descripcion }}
                </textarea>


                <div class="mb-5">
                    <label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <b>Precio Actual</b></label>
                    <input type="number" id="precio" name="precio" value="{{ $producto->precio }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

        </div>

        <div class="w-1/4 ml-10">
            <div class="mb-5">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    <b>Stock Actual</b></label>
                <input type="number" id="stock" name="stock" value="{{ $producto->stock_actual }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <label for="subcategoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                <b>Categoria Actual</b></label>
            <select id="subcategoria" name="subcategoria"
                class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                
                @foreach ($subcategorias as $subcategoria)
                    @if ($subcategoria->id == $producto->subCategoria_id)
                        <option selected value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>                            
                    @else
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>    
                    @endif                
                @endforeach
            </select>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    $('#subcategoria').select2({
                        placeholder: 'Selecciona una categoría',
                        allowClear: true
                    });
                });
            </script>


            <label for="imagen" class="pt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="file_input"><b>Selecciona una foto</b> o puedes dejar vacio este campo</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="imagen" name="imagen" type="file" value="  ">

            <button type="submit"
                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Guardar Cambios
            </button>
            <a href=" {{ route('producto.amdIndex') }} " class="text-red-500">
                Cancelar
            </a>
        </div>


        </form>
    </div>
    </li>


    @push('js')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Buscar...",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
