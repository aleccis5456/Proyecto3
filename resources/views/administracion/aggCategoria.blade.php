@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')
    <div class="flex">
        <div class="flex flex-col w-1/2">
            <!-- Categoria -->
            <div class="mb-8">
                <form class="max-w-sm mx-auto" method="POST" action="{{ route('aggSave') }}">
                    <br><br><br><br>
                    @csrf
                    <div class="mb-6">
                        <b class="text-2xl text-gray-900 dark:text-white">Agregar Categoria</b>
                    </div>
                    <div class="mb-5">
                        <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva
                            Categoria</label>
                        <input type="text" id="categoria" name="categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar
                    </button>
                    <spam class="text-sm text-blue-700">
                        <a href=" {{ route('categoria.todos') }} ">Ver Categorias</a>
                    </spam>
                </form>
            </div>
        </div>
        <!-- /tabla -->


        <div class="w-1/2"> <!-- Contenedor principal con Flexbox en columna -->
            <!-- Categoria -->
            <!-- subcategoria -->
            <div class="pr-10">
                <form class="max-w-sm mx-auto" method="POST" action="{{ route('sub.agregar') }}">
                    <br><br><br><br>
                    @csrf
                    <x-alertas />
                    <div class="mb-6">
                        <b class="text-2xl text-gray-900 dark:text-white">Agregar Sub Categoria</b>
                    </div>
                    <div class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva
                            Categoria</label>
                        <input type="text" id="nombre" name="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-5">
                        <select id="categoria" name="categoria"
                            class="select2 mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="0">Selecciona una Categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar
                    </button>

                    <span>
                        <a href="{{ route('sub.ver') }}" class="text-blue-700 text-sm">
                            ver Sub Categorias
                        </a>                        
                    </span>
                </form>
            </div>          
        </div>
    </div>




    
    <x-mostrar-sub-categorias />


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');
            const deleteForm = document.getElementById('delete-form');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoriaId = this.getAttribute('data-categoria-id');
                    const deleteUrl = `{{ url('/adm/eliminar/') }}/${categoriaId}`;
                    deleteForm.setAttribute('action', deleteUrl);
                });
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Buscar...",
            allowClear: true
        });
    });
</script>
@endsection
