@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')
    <div class="flex"> <!-- Contenedor principal con Flexbox -->
        <!-- Categoria -->
        <div class="w-1/2">
            <form class="max-w-sm mx-auto" method="POST" action="{{ route('aggSave') }}">
                <br><br><br><br>
                @csrf
                <div class="">
                    <x-alertas />
                </div>
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
                    class="text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
            </form>
        </div>


        <!-- Tabla -->
        <div class="w-1/2 p-4"> <!-- 50% del ancho para la tabla -->
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NOMBRE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ACCION
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $categoria->id }}
                                </td>

                                <th class="px-6 py-4">
                                    {{ $categoria->nombre }}
                                </th>
                                <td class="px-6 py-4">
                                    <!-- Botón para mostrar el modal -->
                                    <button data-modal-target="popup-modal-cat" data-modal-toggle="popup-modal-cat"
                                        data-categoria-id="{{ $categoria->id }}"
                                        class="hover:text-red-500 hover:font-bold open-modal">
                                        Eliminar
                                    </button>
                                    <a href="{{ route('categoria.editar', ['id' => $categoria->id]) }}"
                                        class="hover:text-yellow-300 hover:font-bold">Editar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-eliminar-categoria />

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


@endsection
