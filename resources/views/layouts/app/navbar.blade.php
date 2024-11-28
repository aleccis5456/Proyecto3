    <div class=" flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-1">
        <button href="" class="pr-20" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
            </svg>
        </button>

        <div class="flex items-center space-x-2 group">
            <a href="{{ route('home') }}"
                class="flex items-center space-x-1 transform transition duration-300 hover:scale-105">
                <span
                    class="self-center text-2xl font-bold bg-[#fbb321] text-white px-2 rounded-md group-hover:bg-[#fbb321] transition duration-300">
                    Electro
                </span>
                <span
                    class="self-center text-2xl font-bold text-[#fbb321] group-hover:text-[#fbb321] transition duration-300">
                    Max
                </span>
            </a>
        </div>


        <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
            <!-- carrito -->
            @if (session('carrito'))
                <button href="  " data-drawer-target="drawer-right-carrito" data-drawer-show="drawer-right-carrito"
                    data-drawer-placement="right" aria-controls="drawer-right-carrito">
                    <div class="flex ">
                        <div class=" bg-[#fbb321] rounded-full px-2 py-2">
                            <svg class="w-6 h-6  text-gray-600 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                            </svg>
                        </div>
                        <span class="text-gray-600 font-bold text-xs ">+
                            {{ App\Utils\Util::stats()['total_conteo'] }}</span>
                    </div>
                </button>
            @else
                <button href="  " data-drawer-target="drawer-right-carrito" data-drawer-show="drawer-right-carrito"
                    data-drawer-placement="right" aria-controls="drawer-right-carrito">
                    <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                </button>
            @endif

            @include('layouts.app.carrito')
            {{-- <x-carrito /> --}}

            <!-- /carrito -->

            @if (!Auth::user())
                <a href=" {{ route('login') }} "
                    class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Ingresar</a>
                <a href="{{ route('usuario.registro') }}"
                    class="text-gray-700 bg-[#fbb321] hover:bg-yellow-100 focus:ring-4 focus:ring-yellow-300 hover:text-black font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Registrarse</a>
            @elseif(Auth::user())
                <button class="rounded-lg hover:bg-yellow-100 px-4 py-2 flex items-center space-x-2"
                    id="dropdownDefaultButton" data-dropdown-toggle="dropdown">

                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <p class="text-gray-800 dark:text-white ">Hola, {{ ucfirst(Auth::user()->name) }}</p>
                </button>
            @endif

            <!-- menu de usuario -->
            <x-menu-user />
            <!-- /menu de usuario -->

        </div>

        <!-- Busqueda -->
        <form class="max-w-lg w-full mx-auto" action="{{ route('home.busqueda') }}" method="GET" name="form_buscador">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"></label>
            <div class="relative">
                <!-- Input de búsqueda con ancho completo -->
                <input type="search" id="b" name="b" value="{{ $b ?? '' }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Buscar productos" />

                <!-- Botón de búsqueda centrado -->
                <button type="submit"
                    class="absolute inset-y-0 right-1 flex items-center justify-center text-white bg-[#fbb321] hover:bg-yellow-100 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 my-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </button>
            </div>
        </form>
        <!-- /Busqueda -->

    </div>
