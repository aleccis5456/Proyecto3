@extends('layouts.caja')

@section('contenido')
    <div class="max-w-sm mx-auto flex items-center justify-center">
        <x-alertas />
    </div>

    <div class="flex flex col">
        <div class="w-1/2">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 sr-only">
                                imagen
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                producto
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                precio
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                cantidad
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('ventaCaja') as $indice => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <img class="min-w-[45px] min-h-[45px] max-w-[50px] max-w-[50px]"
                                        src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}"
                                        alt="" srcset="">
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::limit($item['nombre'], 20) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item['precio_oferta'] != 0 ? $item['precio_oferta'] : $item['precio'], 0, ',', '.') }}
                                    Gs.
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        @if ($item['producto_completo']['precio'] == $item['precio'])
                                            Cantidad:
                                            <div class="pl-2">
                                                <span class="font-bold">
                                                    <a href="{{ route('caja.add', ['id' => $item['id_producto']]) }}">+</a>
                                                    <span class="border px-1">{{ $item['cantidad'] }}</span>
                                                    <a href="{{ route('caja.quitar', ['indice' => $indice]) }}">-</a>
                                                </span>
                                            </div>
                                        @else
                                            Cantidad:
                                            <span class="border px-1">{{ $item['cantidad'] }}</span>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-1/2 border p-4">
            <p class="text-center text-lg font-semibold mb-4">Datos para la factura</p>
            <form action="" method="POST"> <!-- Puedes especificar la acción y el método de envío -->

                <!-- Selección de cliente -->
                <div class="flex items-center space-x-2 mb-10">
                    <label for="cliente" class="font-semibold text-sm font-medium">Cliente:</label>
                    <select class="select2 border rounded-md" name="cliente" id="cliente">
                        <option value="">-Selecciona un cliente-</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nombre }} {{ $user->apellido }} | Nº:
                                {{ $user->ruc_ci }}</option>
                        @endforeach
                    </select>

                    <!-- Botón para agregar cliente -->
                    <button onclick="openModalUser(event)" class="flex items-center justify-center p-2" type="button">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Método de pago -->
                <div class="mb-10">
                    <label for="metodo_pago"
                        class="font-semibold block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Método de pago:
                    </label>
                    <select id="metodo_pago" name="metodo_pago"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Selecciona un método de pago</option>
                        <option value="tarjeta">Tarjeta de crédito</option>
                        <option value="tarjeta">Tarjeta de debito</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                </div>
                <div>

                <div class="flex mb-5">
                    <label for="number-input" class="font-semibold mx-auto block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Aplicar descuento
                    </label>
                    <input type="number" id="number-input" aria-describedby="helper-text-explanation"
                        class="mx-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

                    <button class="text-white font-semibold text-sm ml-4 bg-gray-800 border border-gray-600 px-2 py-1 rounded-md hover:bg-gray-600 focus:bg-black" type="button">Aplicar</button>
                </div>                


                </div>
                <div>
                    <span class="font-semibold">Total:</span>
                    {{ number_format(App\Utils\Util::statsVentaCaja()['total_pagar'], 0, ',', '.') }}Gs.
                </div>
                <!-- Botones de acción -->
                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Confirmar
                    </button>
                    <button type="button" onclick="cancelarOperacion()"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('caja.includes.aggClienteModal')
@endsection
