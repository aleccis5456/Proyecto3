<div>    
    @if (!session('carrito'))
    @else
        <div id="drawer-right-carrito"
            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-1/3 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-right-label">
            <h5 id="drawer-right-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>Carrito
            </h5>
            <button type="button" data-drawer-hide="drawer-right-carrito" aria-controls="drawer-right-carrito"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <table class="">
                <thead>
                    <tr>
                        <th class="w-1/3"></th>
                        <th class=""></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('carrito') as $indice => $item)
                        <tr class="">
                            <div>
                                <td>
                                    <img src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}"
                                    loading="lazy" width="100" alt="">
                                </td>
                            </div>
                            <td class="flex  ">
                                <div class="flex-col">
                                    <div>
                                        <br>
                                        <a href="{{ route('producto', ['id' => $item['id_producto']]) }}" class="text-sm text-blue-500">
                                            {{-- {{ strlen($item['nombre']) > 50 ? substr($item['nombre'], 0, 50) . '...' : $item['nombre'] }} --}}
                                            {{ $item['nombre'] }}
                                        </a>
                                    </div>

                                    <div>
                                        @if ($item['cuota'] != null)
                                            <b>{{ number_format(round($item['precio'], -2), 0, ',', '.') }}
                                                x{{ $item['cuota'] }}Gs.</b>
                                        @else
                                            @if ($item['precio_oferta'] > 0)
                                                <b>{{ number_format(round($item['precio_oferta'], -2), 0, ',', '.') }}
                                                    Gs.</b>
                                            @else
                                                <b>{{ number_format(round($item['precio'], -2), 0, ',', '.') }} Gs.</b>
                                            @endif
                                        @endif

                                    </div>
                                    <div>
                                        @if ($item['producto_completo']['precio'] == $item['precio'])
                                            Cantidad:
                                            <span class="bg-gray-100 px-1 border">
                                                <a href="{{ route('carrito.add', ['id' => $item['id_producto']]) }}">+</a>
                                                <span class="border px-1">{{ $item['cantidad'] }}</span>
                                                <a href="{{ route('carrito.quitar', ['indice' => $indice]) }}">-</a>
                                            </span>
                                        @else
                                            Cantidad:
                                            <span class="border px-1">{{ $item['cantidad'] }}</span>
                                        @endif                                            
                                    </div>

                                </div>
                            </td>
                            <td>
                                <a href=" {{ route('carrito.eliminar', ['indice' => $indice]) }} ">
                                    <svg class=" w-10 h-10 text-gray-800 dark:text-white hover:bg-gray-200 rounded-full hover:bg-gray-200 px-2 py-2"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>

                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pt-10">
                <hr>
                <br>
                <div>
                    @php
                        $total = 0;
                    @endphp

                    @foreach (session('carrito') as $item)                     
                        @if ($item['precio_oferta'] > 0)
                            @php $total += $item['precio_oferta'] * $item['cantidad'] @endphp
                        @else
                            @php $total += $item['precio'] * $item['cantidad'] @endphp
                        @endif
                    @endforeach

                    <b class="text-xl"> Total:</b> <span
                        class="text-xl">{{ number_format(round($total, -2), 0, ',', '.') }}
                        Gs.</span>


                </div>
            </div>

            @if (!session('carrito'))     
                <div class="grid grid-cols-2 gap-4 pt-4">
                    Carrito sin articulos
                </div>
            @elseif(session('carrito'))
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <a href="  {{ route('carrito.index') }} "
                        class=" px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Ver Carrito</a>
                    <a href=" {{ route('checkout') }} "
                        class=" items-center px-4 py-2 text-sm font-medium text-center text-gray-600 bg-[#fbb321] rounded-lg hover:bg-yellow-100 hover:text-black focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Finalizar compra</a>
                </div>
            @endif
        </div>
    @endif
</div>
