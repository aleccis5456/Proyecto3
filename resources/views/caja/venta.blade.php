@extends('layouts.caja')

@section('contenido')
    <div class="max-w-sm mx-auto flex items-center justify-center">
        <x-alertas />
    </div>    
    {{-- @dd(session('statsVentaCaja'))     --}}
    <div class="flex flexcol">
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
                                    <img class="min-w-[45px] min-h-[45px] max-w-[50px]"
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

        <div class="w-1/2 border p-6 rounded-lg shadow-lg bg-white dark:bg-gray-800">
            <p class="text-center text-lg font-semibold mb-4 text-gray-900 dark:text-white"></p>
            <form action="{{ route('caja.crearpedido') }}" method="POST">
                @csrf

                <!-- Selección de cliente -->
                <div class="mb-8">
                    <label for=""
                        class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Seleccionar cliente registrado:</label>
                    <div class="flex items-center">
                        <select class="select1 border rounded-md flex-1 p-2" name="usuario" id="usuario">
                            <option value="">-Selecciona un cliente-</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} {{ $usuario->apellido }} | Nº:
                                    {{ $usuario->celular }}</option>
                            @endforeach
                        </select>                                              
                    </div>
                </div>

                <div class="mb-8">
                    <label for="cliente"
                        class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Datos para la factura:</label>
                    <div class="flex items-center">
                        <select class="select2 border border-gray-800 rounded-md flex-1 p-2" name="cliente" id="cliente">
                            <option value="">-Selecciona un cliente-</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nombre }} {{ $user->apellido }} | Nº:
                                    {{ $user->ruc_ci }}</option>
                            @endforeach
                        </select>
                        <!-- Botón para agregar cliente -->
                        <button onclick="openModalUser(event)" class="p-2.5 ml-2 bg-gray-800 rounded-lg text-white"
                            type="button">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                
                <!-- Método de pago -->
                <div class="mb-8">
                    <label for="metodo_pago" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                        Método de pago:
                    </label>
                    <select id="metodo_pago" name="metodo_pago"
                        class="w-full p-2 bg-gray-50 border rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600">
                        <option selected>-Selecciona un método de pago-</option>
                        <option value="tc">Tarjeta de crédito</option>
                        <option value="td">Tarjeta de débito</option>
                        <option value="ef">Efectivo</option>                        
                    </select>
                </div>             

                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Total:</span>
                    <span id="total"
                        class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format(App\Utils\Util::statsVentaCaja()['total_pagar'], 0, ',', '.') }}
                        Gs.</span>
                </div>
                           
                <input type="hidden" name="total" value="{{ App\Utils\Util::statsVentaCaja()['total_pagar'] }}">
                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4">
                    <button onclick="openVentaModal(event)" type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Confirmar
                    </button>
                </div>
                @include('caja.includes.modalConfirmarVenta')
            </form>
        </div>

    </div>

    @include('caja.includes.aggClienteModal')   






    {{-- @if (!session('venta')) --}}
      
    {{-- @endif --}}

    
@endsection
