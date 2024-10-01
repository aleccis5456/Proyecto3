@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')

    <div class="flex">
        <div class="w-1/2">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <a
                                    href="{{ route('sub.ver', ['sort_by' => 'id', 'sort_order' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                    ID
                                    @if ($sortBy === 'id')
                                        <span>{{ $sortOrder === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <a
                                    href="{{ route('sub.ver', ['sort_by' => 'nombre', 'sort_order' => $sortBy === 'nombre' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Nombre
                                    @if ($sortBy === 'nombre')
                                        <span>{{ $sortOrder === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <a
                                    href="{{ route('sub.ver', ['sort_by' => 'categoria_id', 'sort_order' => $sortBy === 'categoria_id' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Categoria
                                    @if ($sortBy === 'categoria_id')
                                        <span>{{ $sortOrder === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Accion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategorias as $subcategoria)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $subcategoria->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $subcategoria->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $subcategoria->categoria->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="popup-modal-subcat" data-modal-toggle="popup-modal-subcat"
                                        data-subcategoria-id="{{ $subcategoria->id }}"
                                        class="open-modal hover:text-red-500 rounded-lg hover:bg-gray-200 px-1 py-1">
                                        Eliminar
                                    </button>

                                    <a href="{{ route('sub.editar', ['id' => $subcategoria->id]) }}"
                                        class="hover:text-yellow-300 rounded-lg hover:bg-gray-200 px-1
                                         py-1">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $subcategorias->links() }}
            </div>
        </div>

        <div class="w-1/2">
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

                    <select id="categoria" name="categoria"
                        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="0">Selecciona una Categoria</option>
                        @foreach ($categoria as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="popup-modal-subcat" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal-subcat">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estás seguro de que quieres
                        eliminar esta sub categoría?</h3>
                    <!-- Botón para confirmar eliminación -->
                    <form id="delete-form" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Sí, estoy seguro
                        </button>
                    </form>
                    <button data-modal-hide="popup-modal-subcat" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancelar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');  // Cambiado para seleccionar por clase correcta
            const deleteForm = document.getElementById('delete-form');
    
            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const subcategoriaId = this.getAttribute('data-subcategoria-id');
                    const deleteUrl = `{{ url('/adm/eliminar/subcategoria') }}/${subcategoriaId}`;
                    deleteForm.setAttribute('action', deleteUrl);
                });
            });
        });
    </script>
    

@endsection
