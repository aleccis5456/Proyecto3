@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex"> <!-- Contenedor principal con Flexbox -->
        <div class="w-2/3 flex items-center justify-center pt-10 dark:bg-gray-900">
            <div class="w-full mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <p class="font-bold text-xl">Ventas</p>
                    <!-- formulario de busqueda -->
                    <form class="max-w-md mx-auto px-1 pb-1" action="{{ route('adm.index') }}" method="GET"
                        name="form_buscador">
                        <label for="default-search"
                            class="mb-1 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <input type="search" id="default-search" name="filtro" value="{{ $b ?? '' }}"
                                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Busca por código o producto..." />

                            <button type="submit"
                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <b class="pr-1">Exportar en PDF:</b>
                    <button onclick="toggleModal()"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        <span>
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="flex justify-center items-start text-center pt-10 max-w-full">
                    <!-- Contenedor de la tabla -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-auto mr-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Código
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Producto
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <form action="{{ route('adm.index') }}" method="get">
                                            <input type="hidden" name="orderBy"
                                                value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                            <button type="submit">VENTAS
                                                @if ($orderBy == 'desc')
                                                    ▼
                                                @else
                                                    ▲
                                                @endif
                                            </button>
                                        </form>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stock Actual
                                    </th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            #{{ $producto->codigo }}
                                        </th>
                                        <th class="px-6 py-4 flex">
                                            <img class="w-7 h-7 pr-1" src="{{ asset("uploads/productos/$producto->imagen") }}" alt="">
                                            <a class="hover:text-blue-600"
                                                href="{{ route('producto.detalle', ['id' => $producto->id]) }}">
                                                {{ $producto->nombre }}
                                            </a>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $producto->ventas }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $producto->stock_actual }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>


        <div class="w-1/3 p-4 text-center">
            <a href="{{ route('producto.amdIndex') }}">
                <button type="button"
                    class="focus:outline-none text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Ver todos los productos
                </button>
            </a>
            @if (!is_null($notificaciones) and $notificaciones >= 1)
                <a href="{{ route('pedidos') }}">
                    <button type="button"
                        class="focus:outline-none font-semibold text-gray-600 bg-[#fbb321] hover:bg-yellow-200 hover:text-black focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        
                        Nuevos Pedidos ({{ $notificaciones }})
                    </button>                    
                </a>
            @else
                <a href="{{ route('pedidos') }}">
                    <button type="button"
                        class="focus:outline-none text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Pedidos                        
                    </button>
                </a>    
            @endif
            
        </div>
    </div>

    @include('administracion.includes.pdfDatesModal')
@endsection
