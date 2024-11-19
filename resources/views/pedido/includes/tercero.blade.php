<div id="modalTerceros" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white w-96 rounded-lg shadow-lg p-6">
        <!-- Título y botón de cerrar -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold">Persona que recibira el pedido</h3>
            <span onclick="closeModalTerceros()" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>

            </span>
        </div>

        <!-- Formulario del modal -->

        <div class="mt-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre y Apelldio*</label>
            <input type="text" id="nombre" name="terceroNombre"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        <div class="mt-4">
            <label for="apellido" class="block text-sm font-medium text-gray-700">Numero de cedula*</label>
            <input type="text" id="apellido" name="terceroCedula" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        <div class="mt-4">
            <label for="ruc_ci" class="block text-sm font-medium text-gray-700">Telefono</label>
            <input type="text" id="ruc_ci" name="terceroTelefono"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        <p class="text-sm text-gray-500 pt-1">(*) campos obligatorios</p>
        <p class="text-sm text-gray-500 pt-1">Si agregas un tercero, igual podrias recibir tu el pedido</p>
        <div class="mt-6 flex justify-end">
            
            <span onclick="closeModalTerceros()"
                class="mt-1 text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Agregar
            </span>
        </div>

    </div>
</div>
