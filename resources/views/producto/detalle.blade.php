@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-alertas />
            <div class="flex justify-between items-center mb-4">
                <div class="w-4/5 text-xl">
                    <b>{{ $item->nombre }}</b>
                </div>

                <a href=" {{ route('producto.editar', ['id' => $item->id]) }} "
                    class="focus:outline-none text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-300 dark:hover:bg-yellow-700 dark:focus:ring-yellow-500">
                    Editar
                </a>                
            </div>

            <div class="flex justify-center items-start text-center pt-10 max-w-full">
                <!-- Contenedor de la tabla -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-auto mr-4">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    código
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    categoria
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    subcategoría
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    descripción
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    precio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    fecha
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    #{{ $item->codigo }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->subcategoria->categoria->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->subcategoria->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{-- //{{ $item->descripcion }} --}}
                                    {!! nl2br(e($item->descripcion)) !!}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item->precio, 0, ',', '.') }} Gs.
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->stock_actual }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->registro }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- cambios rapidos-->
    @include('producto.includes.cambiosRapidos')

    <!-- agregar mas fotos-->
    @include('producto.includes.agregarFotos')

    <!-- muestra ultimos cambios --->
    @include('producto.includes.ultimosCambios')
    
    <!-- modal para confirmar eliminar una foto -->
    @include('producto.includes.deleteFotoModal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');
            const deleteForm = document.getElementById('delete-form');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fotoId = this.getAttribute('data-foto-id');
                    const deleteUrl = `{{ url('/adm/eliminar/foto') }}/${fotoId}`;
                    deleteForm.setAttribute('action', deleteUrl);                    
                    const modal = document.getElementById('popup-modal-foto');
                    modal.classList.remove('hidden');
                });
            });
        });
    </script>    
@endsection
