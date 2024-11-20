@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-900"> <!-- Contenedor principal centrado -->
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <x-alertas />
            <div class="max-w-full flex justify-between">
                <!-- formulario de busqueda -->
                <div>
                    <form class="max-w-md mx-auto px-1 pb-1" action="{{ route('producto.amdIndex') }}" method="GET"
                        name="form_buscador">
                        <label for="default-search"
                            class="mb-1 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="filtro" value="{{ $b ?? '' }}"
                                class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nombre, codigo o categoria..." />
                        </div>
                    </form>
                </div>

                <form action="{{ route('pdf.productos') }}" method="get">
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

                <div class="">
                    <a href=" {{ route('producto.agregar') }} "
                        class="focus:outline-none text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Agregar Producto
                    </a>
                </div>

            </div>
            <div class="mt-10 text-center text-xl">
                @if (isset($b))
                    Resultados para: <b>{{ $b }}</b> <span
                        class="text-gray-500 text-sm">({{ count($productos) }})</span>
                @else
                    <b>Lista de todos los productos </b>({{ $cantidad ?? '' }})
                @endif

            </div>

            <div class="flex justify-center items-center text-center pt-10 max-w-full">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    codigo
                                </th>
                                <th scope="col" class="px-6 py-3 max-w-[40px]">
                                    nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <form action="{{ route('producto.amdIndex') }}" method="get">                                        
                                        <input type="hidden" name="b" value="{{ $b }}">
                                        <input type="hidden" name="orderBy"
                                            value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                        <input type="hidden" name="column" value="oferta">
                                        <button class="flex" type="submit">OFERTA
                                            <span class="flex">
                                                @if ($flag == 'oferta_column')
                                                    {{ $orderBy == 'desc' ? '▼' : '▲'}} 
                                                @else
                                                    ▼▲   
                                                @endif
                                            </span>

                                        </button>
                                    </form>
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                    <form action="{{ route('producto.amdIndex') }}" method="get">
                                        <input type="hidden" name="b" value="{{ $b }}">
                                        <input type="hidden" name="orderBy"
                                            value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                        <input type="hidden" name="column" value="subCategoria_id">
                                        <button class="flex" type="submit">CATEGORIA
                                            <span class="flex">
                                                @if ($flag == 'subCategoria_id_column')                                                
                                                    {{ $orderBy == 'desc' ? '▼' : '▲'}}  
                                                @else
                                                    ▼▲                                                  
                                                @endif
                                            </span>

                                        </button>
                                    </form>                                    
                                </th> --}}
                                <th scope="col" class="px-6 py-3">
                                    <form action="{{ route('producto.amdIndex') }}" method="get">
                                        <input type="hidden" name="b" value="{{ $b }}">
                                        <input type="hidden" name="orderBy"
                                            value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                        <input type="hidden" name="column" value="precio">
                                        <button class="flex" type="submit">PRECIO
                                            <span class="flex">
                                                @if ($flag == 'precio_column')                                                    
                                                    {{ $orderBy == 'desc' ? '▼' : '▲'}}                                                                                                       
                                                @else
                                                    ▼▲                                                
                                                @endif
                                            </span>

                                        </button>
                                    </form>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <form action="{{ route('producto.amdIndex') }}" method="get">
                                        <input type="hidden" name="b" value="{{ $b }}">
                                        <input type="hidden" name="orderBy"
                                            value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                        <input type="hidden" name="column" value="stock_actual">
                                        <button class="flex" type="submit">STOCK
                                            <span class="flex">
                                                @if ($flag == 'stock_actual_column')                                                    
                                                    {{ $orderBy == 'desc' ? '▼' : '▲'}}                                                                                                       
                                                @else
                                                    ▼▲                                                
                                                @endif
                                            </span>

                                        </button>
                                    </form>                                    
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <form action="{{ route('producto.amdIndex') }}" method="get">
                                        <input type="hidden" name="b" value="{{ $b }}">
                                        <input type="hidden" name="orderBy"
                                            value="{{ $orderBy == 'asc' ? 'desc' : 'asc' }}">
                                        <input type="hidden" name="column" value="registro">
                                        <button class="flex" type="submit">REGISTRO
                                            <span class="flex">
                                                @if ($flag == 'registro_column')                                                    
                                                    {{ $orderBy == 'desc' ? '▼' : '▲'}}                                                                                                       
                                                @else
                                                    ▼▲                                                
                                                @endif
                                            </span>

                                        </button>
                                    </form>                                     
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Detalle
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $item)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        #{{ $item->codigo }}
                                    </th>
                                    <th class="px-6 py-4 flex text-grap">
                                        <a class="flex" href=" {{ route('producto.detalle', ['id' => $item->id]) }}"
                                            class="hover:text-blue-600">
                                            <img class="mr-2 w-12 h-12" src="{{ asset("uploads/productos/$item->imagen") }}" alt="" srcset="">
                                            {{ Str::limit($item->nombre, 50) }}
                                        </a>
                                    </th>
                                    <td
                                        class="px-6 py-4 {{ $item->precio_oferta > 0 ? 'text-green-500' : 'text-red-500' }}">
                                        <b>{{ $item->precio_oferta > 0 ? 'SI' : 'NO' }}</b>
                                        </d>

                                    {{-- <td class="px-6 py-4">
                                        {{ $item->subcategoria->nombre }}
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        {{ number_format(round($item->precio, -2), 0, ',', '.') }} Gs.
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->stock_actual }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->registro }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <a href=" {{ route('producto.detalle', ['id' => $item->id]) }} "
                                            class="hover:text-blue-700 rounded-lg hover:bg-gray-200 px-1
                                    py-1">
                                            Ver
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="open-modal hover:text-red-500 rounded-lg hover:bg-gray-200 px-1 py-1"
                                            data-modal-target="popup-modal-pro" data-modal-toggle="popup-modal-pro"
                                            data-producto-id="{{ $item->id }}">
                                            Eliminar
                                        </button>

                                        <a href=" {{ route('producto.editar', ['id' => $item->id]) }} "
                                            class="hover:text-yellow-300 rounded-lg hover:bg-gray-200 px-1
                                         py-1">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-1/2">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- confirmacion eliminar producto -->
    @include('producto.includes.deleteModal')
    <!-- /confirmacion eliminar producto -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('.open-modal');
            const deleteForm = document.getElementById('delete-form');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productoId = this.getAttribute('data-producto-id');
                    const deleteUrl = `{{ url('/adm/eliminar/producto') }}/${productoId}`;
                    deleteForm.setAttribute('action', deleteUrl);
                    // Mostrar modal (si estás usando un script específico para modales, ajusta aquí)
                    const modal = document.getElementById('popup-modal-pro');
                    modal.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection
