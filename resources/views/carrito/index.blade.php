@extends('layouts.app')
@section('titulo', 'Carrito')

@section('contenido')
    <br>
    <div>
        <p class="text-2xl font-bold text-center pt-2">Carrito de Compras</p>
    </div>
    <div class="flex items-center justify-center pt-10 ">
        <div class="w-5/6 ">
            <div class="flex items-center justify-center px-2 pt-2 ">
                <div class="w-full mx-auto p-3 bg-white ">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <b>Articulo/s</b>
                        </div>
                    </div>
                    <hr>
                    <!-- Tabla -->
                    <div class="relative overflow-x-auto ">
                        <table class="w-full text-sm text-left rtl:text-right text-black dark:text-white">
                            <thead class="text-xs text-black uppercase bg-white dark:bg-white dark:text-black">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-sm text-center align-middle">
                                        Producto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-center align-middle">

                                    </th>
                                    <th scope="col" class="px-8 py-3 text-sm text-center align-middle">
                                        Precio
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-center align-middle">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-center align-middle">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('carrito'))
                                    @foreach (session('carrito') as $indice => $item)
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <td
                                                class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center align-middle">
                                                <div class="flex justify-center">
                                                    <img src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}"
                                                        width="200" alt="">
                                                </div>
                                            </td>

                                            <td class="text-center align-middle">
                                                <a href="{{ route('producto', ['id' => $item['id_producto']]) }}">
                                                    <p class="text-blue-500 font-bold pb-10 px-5">
                                                        {{ $item['producto_completo']['nombre'] }}</p>
                                                </a>
                                            </td>

                                            <td class="text-center align-middle ">
                                                <div class="pb-10">
                                                    @if ($item['cuota'] != null)
                                                        <b class="font-bold">{{ number_format(round($item['precio'], -2), 0, ',', '.') }}
                                                            x{{ $item['cuota'] }} Gs.</b>
                                                    @else
                                                        @if ($item['precio_oferta'] > 0)
                                                            <b class="font-bold">{{ number_format($item['precio_oferta'], 0, ',', '.') }} Gs.</b>
                                                        @else
                                                            <b class="font-bold">{{ number_format($item['precio'], 0, ',', '.') }} Gs.</b>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="flex flex-col items-center pb-10 font-bold">
                                                    @if ($item['cuota'] != null)
                                                        <div>{{ $item['cantidad'] }}</div>
                                                    @else
                                                        <a
                                                            href="{{ route('carrito.add', ['id' => $item['id_producto']]) }}">+</a>
                                                        <div>{{ $item['cantidad'] }}</div>
                                                        <a
                                                            href=" {{ route('carrito.quitar', ['indice' => $indice]) }} ">-</a>
                                                    @endif

                                                </div>
                                            </td>

                                            <td class="text-center align-middle pb-10">
                                                    <b> {{ $item['precio_oferta'] > 0 ? number_format(round($item['precio_oferta'] * $item['cantidad'], -2), 0, ',', '.') :
                                                        number_format(round($item['precio'] * $item['cantidad'], -2), 0, ',', '.')}} Gs.</b>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>


        <div class="flex-col w-1/3 bg-gray-100 dark:bg-gray-900">
            <div>
                <p class="text-xl font-bold text-center">Resumen</p>
            </div>
            <hr>
            <div>
                <b class="text-xl"> Total:</b> <span
                    class="text-xl">{{ number_format(round(App\Utils\Util::stats()['total_pagar'], -2), 0, ',', '.') }}
                    Gs.</span>
            </div>
            <div class="pt-5">
                <a href=" {{ route('checkout') }} "
                    class=" items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Finalizar compra</a>
            </div>

        </div>
    </div>

@endsection
