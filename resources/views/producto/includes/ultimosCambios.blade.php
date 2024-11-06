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
