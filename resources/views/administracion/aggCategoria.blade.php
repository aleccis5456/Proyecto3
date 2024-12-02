@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')
    <div class="min-h-screen bg-white flex flex-col items-center py-6">    
        <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-8">
            <x-alertas />
            <!-- Formulario Agregar Categoria -->
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800">Agregar Categoria</h2>
            </div>
            <form method="POST" action="{{ route('aggSave') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-800">Nueva Categoria</label>
                    <input type="text" id="categoria" name="categoria"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese el nombre de la categoría" />
                </div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Seleccionar nueva Imagen</label>
                <input type="file" name="imagen" class="mb-5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input">

                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Guardar
                    </button>
                    <a href="{{ route('categoria.todos') }}" class="w-full text-center text-gray-800 hover:underline py-2 rounded-lg border border-gray-800">
                        Ver Categorias
                    </a>
                </div>
            </form>

            <!-- Formulario Agregar Subcategoria -->
            <div class="mt-12 mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800">Agregar Sub Categoria</h2>
            </div>
            <form method="POST" action="{{ route('sub.agregar') }}">
                @csrf                
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-800">Nueva Subcategoria</label>
                    <input type="text" id="nombre" name="nombre"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese el nombre de la subcategoría" />
                </div>
                <div class="mb-5">
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-800">Selecciona Categoria</label>
                    <select id="categoria" name="categoria"
                        class="select2 w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800">
                        <option value="0" selected>Selecciona una Categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Guardar
                    </button>
                    <a href="{{ route('sub.ver') }}" class="w-full text-center text-gray-800 hover:underline py-2 rounded-lg border border-gray-800">
                        Ver Sub Categorias
                    </a>
                </div>
            </form>
        </div>
    </div>

    <x-mostrar-sub-categorias />

    <!-- Modal Script -->
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

    <!-- Select2 Initialization -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Buscar...",
                allowClear: true
            });
        });
    </script>
@endsection
