<header>
    <nav class="bg-gray-800 border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <button>
            </button>            

            <div>
                <a href="{{ route('vendedores.index') }}" class="text-white text-center">Pagina de vendedores</a>
            </div>


            <div class="text-white flex">
                @if (session('vendedor'))
                    <button class="rounded-lg hover:bg-gray-900 px-4 py-2 flex items-center space-x-2"
                        id="dropdownDefaultButton" data-dropdown-toggle="dropdown">
                        <!-- Añadido 'flex items-center space-x-2' para alinear horizontalmente -->
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <p class="text-white dark:text-white ">Hola, {{ session('vendedor')->nombre }} </p>
                        <!-- Añadido 'text-gray-800 dark:text-white' para que el color del texto coincida con el tema -->
                    </button>
                    
                @endif
                
                <div class="pt-2.5 -4">
                    <a onclick="return confirm('Estas seguro de cerrar sesion?')" href="{{ route('vendedores.logout') }}">
                        <svg  class="w-6 h-6 text-gray-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                        </svg>
                    </a>
                </div>
                  
            </div>
      
            <!-- /confirmacion de cerrar sesion -->
        </div>
    </nav>
</header>