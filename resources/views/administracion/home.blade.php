@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex"> <!-- Contenedor principal con Flexbox -->      
        <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
            <div
                class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">                
                <div class="flex justify-between items-center">
                    <p class="font-bold text-xl">Ventas</p>
                    <form action="{{ route('reporte.pdf') }}" method="get">
                        <span class="font-bold">Exportar en PDF</span>:
                        <button type="submit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">

                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
                            </svg>

                        </button>
                    </form>
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
                                Ventas
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
                                    <th class="px-6 py-4">
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
                        {{$productos->links()}}
                    </div>
                </div>
            </div>
        </div>

    {{-- </div>
    </div> --}}

    <div class="w-1/3 p-4 text-center">
        <a href="{{ route('producto.amdIndex') }}">
            <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Ver todos los productos
            </button>
        </a>
        <a href="{{ route('pedidos') }}">
            <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Pedidos
            </button>
        </a>
    </div>


    </div>
@endsection
