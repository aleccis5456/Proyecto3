<div class="h-full border px-3 py-4 overflow-y-auto bg-gray-200 dark:bg-gray-800">
    <ul class="space-y-2 font-medium">

        <li>
            <a href="{{ route('cajero.index') }}"
                class="flex items-center p-2 {{ Route::is('cajero.index') ? 'bg-gray-800 rounded-md text-white font-semibold' : 'bg-gray-200 hover:bg-gray-100 rounded-lg' }} group">
                <svg class="w-5 h-5  {{ Route::is('cajero.index') ? 'text-white' : 'text-gray-500' }}  transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
                <span class="ms-3">Inicio</span>
            </a>
        </li>

        <li>
            @if (!session('ventaCaja'))
            @else
                <a href="{{ route('caja.venta') }}"
                    class="flex items-center p-2 {{ Route::is('caja.venta') ? 'bg-gray-800 rounded-md text-white font-semibold' : 'bg-gray-200 hover:bg-gray-100 rounded-lg' }} group">
                    <svg class="w-5 h-5  {{ Route::is('caja.venta') ? 'text-white' : 'text-gray-500' }}  transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Productos</span>
                    @if (!session('ventaCaja'))
                    @else
                        <span
                            class="font-semibold inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ App\Utils\Util::statsVentaCaja()['total_conteo'] }}</span>
                    @endif
                </a>
            @endif
        </li>

        <li>
            <a href="{{ route('caja.retirar') }}"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Productos a retirar</span>                
            </a>
        </li>

        <li>
            <a onclick="openModal(event)" href="#"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Salir</span>
            </a>
        </li>
        
    </ul>
</div>
