<div>

    <div id="drawer-navigation"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-1/4 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-xl font-semibold text-gray-900 uppercase dark:text-gray-400">Todas
            las categorias</h5>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">

                <!--  categorias --->
                <li>
                    @foreach ($categorias as $categoria)
                        <button type="button"
                            class="text-lg flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
                            aria-controls="dropdown-{{ $categoria->id }}" data-collapse-toggle="dropdown-{{ $categoria->id }}">                            
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                                {{ $categoria->nombre }}
                            </span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                
                        <!-- Lista de subcategorías -->
                        <ul id="dropdown-{{ $categoria->id }}" class="hidden py-2 space-y-2">
                            @foreach ($subCategorias as $subCategoria)
                                @if ($subCategoria->categoria_id == $categoria->id)
                                    <li class="text-base">
                                        <form action="{{ route('filtro.subcategoria') }}" method="get">
                                            <input type="hidden" name="filtro" value="{{ $subCategoria->id }}">
                                            <button class="w-full" type="submit">
                                                <p class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                                    {{ $subCategoria->nombre }}
                                                </p>
                                            </button>
                                        </form>                                                                                
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endforeach
                </li>
                
                <!--  /categorias --->
            </ul>
        </div>
    </div>

</div>
