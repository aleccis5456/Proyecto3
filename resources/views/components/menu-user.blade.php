@if (Auth::user())
<div>
    <!-- Be present above all else. - Naval Ravikant -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <ul class="text-center py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">

            <li>
                <a href="{{ route('user.ajustes', ['id' => Auth::user()->id]) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ajustes</a>
            </li>            
            <li>
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                    class="block px-4 py-2 flex justify-center hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <!-- Añadido flex y justify-center aquí -->
                    <p class="pl-9">Cerrar sesión</p>
                </button>
            </li>
        </ul>
    </div>
</div>
    
@endif
