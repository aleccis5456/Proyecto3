@extends('layouts.caja')

@section('contenido')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Pedidos a Retirar</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Pedido</th>
                        <th class="py-3 px-6 text-left">Productos</th>
                        <th class="py-3 px-6 text-left">Cliente</th>
                        <th class="py-3 px-6 text-left text-center">Fecha de Registro</th>
                        <th class="py-3 px-6 text-center">Estado</th>                        
                        <th class="py-3 px-6 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($retirar as $pedido)
                        @php
                            $datos = $datos->where('pedido_id', $pedido->id)->first();

                        @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-3 text-center">
                                #{{ $pedido->codigo }}
                            </td>
                            <td class="py-3 px-3 text-left max-w-[380px]">
                                <div class="flex flex-col items-start">
                                    @php
                                        $response = $listaPedidos->where('pedido_id', $pedido->id);
                                    @endphp
                                    @foreach ($response as $producto)
                                        <div class="flex items-center space-x-2">
                                            <img class="w-7 h-7"
                                                src="{{ asset('uploads/productos') }}/{{ $producto->producto->imagen }}"
                                                alt="">
                                            <span class="mb-3">{{ $producto->producto->nombre }}</span>
                                        </div>
                                    @endforeach
                                </div>

                            </td>
                            <td class="py-3 px-3 text-left max-w-[200px]">
                                <div>
                                    <p class="font-semibold text-xs">Cliente: {{ $pedido->usuario->name }}
                                        {{ $pedido->usuario->apellido }}</p>
                                    <p class="text-gray-500 py-2">Datos de Factura: </p>Razon: {{ $datos->nombre }}
                                    {{ $datos->apellido }} <br>
                                    RUC/CI: {{ $datos->ruc_ci }}
                                </div>
                            </td>
                            <td class="py-3 px-3 text-center max-w-[90px]">
                                {{ App\Utils\Util::soloFecha($pedido->registro) }}</td>
                            <td class="py-3 px-3 text-center">
                                @if ($pedido->pedido != 'Finalizado')
                                    <span
                                        class="font-semibold bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Pendiente</span>
                                @else
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Retirado</span>
                                @endif
                            </td>                          
                            <td class="py-3 px-3 text-center min-w-[134px]">
                                <a  href="{{ route('caja.cambiarestado', ['id' => $pedido->id]) }}"
                                    class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-lg text-sm">
                                    Ver mas
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalVerMas" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
        <div class="relative p-4 w-full max-w-2xl">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-md dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <p><strong>Informacion del producto con codigo: #</strong> <span id="modalPedidoCodigo"></span></p>
                    </h3>
                    <button onclick="closeModalVerMas()" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <p><strong>Producto:</strong> <span id="modalPedidoId"></span></p>
                    <p><strong>Forma de pago:</strong> <span id="modalPedidoFormaPago"></span></p>
                    <p><strong>Total a pagar:</strong> <span id="modalPedidoCoste"></span></p>                    
                </div>

                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button class="text-white bg-gray-700 hover:bg-gray-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Guardar
                    </button>
                    <button onclick="closeModalVerMas()"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
