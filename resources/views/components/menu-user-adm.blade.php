<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div id="dropdown"
    class="z-10 hidden bg-gray-800 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="text-center py-2 text-sm text-white dark:text-gray-200"
        aria-labelledby="dropdownDefaultButton">        
        <li>
            <a href="{{ route('adm.edit.form') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-800">
                Ajustes
            </a>
        </li>      
        <li>
            <a data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="block px-4 py-2 flex justify-center hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-800">
                <!-- Añadido flex y justify-center aquí -->
                <p class="pl-9">Cerrar sesión</p>
        </a>
        </li>
    </ul>
</div>
</div>