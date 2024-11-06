<div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
    <div class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
                                    value="{{ $item->precio_oferta ?? '' }}">
                            </td>
                            <!-- Guardar Cambios -->
                            <td class="px-6 py-4">
                                <input type="submit" value="Guardar"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-600">
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>

    </div>
</div>
