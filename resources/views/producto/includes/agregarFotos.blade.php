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
                        class="focus:outline-none text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
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
