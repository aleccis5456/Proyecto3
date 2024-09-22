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
                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-300 dark:hover:bg-yellow-700 dark:focus:ring-yellow-500">
                    Editar
                </a>
                <a href=" {{ url()->previous() }} "
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Volver Atras
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


    <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <b>Cambios Rapidos</b>
                </div>
            </div>

            <!-- Tabla -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Precio</th>
                            <th scope="col" class="px-6 py-3">Visibilidad</th>
                            <th scope="col" class="px-6 py-3">Stock</th>
                            <th scope="col" class="px-6 py-3">Poner en Oferta</th>
                            <th scope="col" class="px-6 py-3">Precio en Oferta</th>
                            <th scope="col" class="px-6 py-3">Guardar Cambios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('producto.editarSave') }}" method="POST">
                            @csrf
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <input type="hidden" name="producto_id" value="{{ $item->id }}">

                                <!-- Precio -->
                                <td class="px-6 py-4">
                                    <input type="number" name="precio" value="{{ $item->precio }}" id=""
                                        class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </td>
                                <!-- Visibilidad -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="visible" value="si"
                                                class="text-blue-600 focus:ring-blue-500"
                                                {{ $item->visible == 'si' ? 'checked' : '' }}>
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="visible" value="no"
                                                class="text-red-600 focus:ring-red-500"
                                                {{ $item->visible == 'no' ? 'checked' : '' }}>
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>

                                </td>
                                <!-- Stock -->
                                <td class="px-6 py-4">
                                    <input
                                        class="w-2/3 p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        type="number" name="stock" id="" value="{{ $item->stock_actual }}">
                                </td>
                                <!-- Oferta -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="oferta" value="1"
                                                class="text-green-600 focus:ring-green-500"
                                                {{ $item->oferta == 1 ? 'checked' : '' }}>
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="oferta" value="0"
                                                class="text-red-600 focus:ring-red-500"
                                                {{ $item->oferta == 0 ? 'checked' : '' }}>
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </td>
                                <!-- Precio en Oferta -->
                                <td class="px-6 py-4">
                                    <input type="number" name="precio_oferta" id=""
                                        class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        value="{{ $item->precio_oferta ?? '' }}" >
                                </td>
                                <!-- Guardar Cambios -->
                                <td class="px-6 py-4">
                                    <input type="submit" value="Guardar"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <b>Todas las Fotos.</b> | Puedes agregar mas fotos
                </div>

                <div class="w-1/3 flex items-center space-x-4">
                    <form action=" {{ route('producto.aggFotos') }} " method="POST" enctype="multipart/form-data"
                        class="flex items-center space-x-4">
                        @csrf
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="fotos" name="fotos[]" type="file" multiple>

                        <input type="hidden" name="producto_id" value="{{ $item->id }}">

                        <input type="submit" value="Guardar"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    </form>
                </div>
            </div>

            <!-- Tabla -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                fotos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                foto principal del producto
                                <img src="{{ asset('uploads/productos') }}/{{ $item->imagen }}" width="200"
                                    alt="foto principal del producto">
                            </th>
                            <td class="px-6 py-4">
                                Sin acciones
                            </td>
                        </tr>
                        @foreach ($fotos as $item)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img src="{{ asset('uploads/productos') }}/{{ $item->nombre }}" width="200"
                                        alt="">
                                </th>
                                <td class="px-6 py-4">
                                    <button class="open-modal hover:text-red-500 rounded-lg hover:bg-gray-200 px-1 py-1"
                                        data-modal-target="popup-modal-foto" data-modal-toggle="popup-modal-foto"
                                        data-foto-id="{{ $item->id }}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div id="popup-modal-foto" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal-foto">
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
                        eliminar este producto?</h3>
                    <!-- Contenedor para botones -->
                    <div class="flex justify-center space-x-3">
                        <!-- Botón para confirmar eliminación -->
                        <form id="delete-form" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Sí, estoy seguro
                            </button>
                        </form>
                        <!-- Botón para cancelar -->
                        <button data-modal-hide="popup-modal-foto" type="button"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            No, cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($item->mod_fecha == null and $item->modificado_por_adm_id == null)
        <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
            <div
                class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <b>Ultimo Cambio</b> | aun sin cambios
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
                    <div
                        class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <b>Ultimo Cambio</b>
                            </div>
                        </div>

                        <!-- Tabla -->
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            usuario
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->mod_fecha }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->admin->nombre }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    @endif



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');
            const deleteForm = document.getElementById('delete-form');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fotoId = this.getAttribute('data-foto-id');
                    const deleteUrl = `{{ url('/adm/eliminar/foto') }}/${fotoId}`;
                    deleteForm.setAttribute('action', deleteUrl);
                    // Mostrar modal (si estás usando un script específico para modales, ajusta aquí)
                    const modal = document.getElementById('popup-modal-foto');
                    modal.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection
