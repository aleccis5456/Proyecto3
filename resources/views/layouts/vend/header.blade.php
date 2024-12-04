<header>
    <nav class="bg-gray-800 border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <a onclick="return confirm('Descargar Manual de usuario?')" href="{{ route('descargar.manual.repartidor') }}" class="">
                <svg class="w-10 h-10 px-1 py-2 text-white dark:text-white hover:text-gray-200 hover:bg-gray-800 hover:px-1 hover:py-2 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.529 9.988a2.502 2.502 0 1 1 5 .191A2.441 2.441 0 0 1 12 12.582V14m-.01 3.008H12M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>       
            </a>    

            <div>
                <a href="{{ route('vendedores.index') }}" class="text-white text-center">Pagina de Repartidores</a>
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