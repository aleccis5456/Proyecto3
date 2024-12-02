@extends('layouts.caja')

@section('contenido')
    <div class="flex items-center justify-center py-12 dark:bg-gray-900">
        <div
            class="w-full max-w-4xl p-8 bg-white border border-gray-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-alertas />
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Detalles del pedido
                            #{{ $pedido->codigo }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pedido realizado por:
                            {{ $pedido->usuario->name }} {{ $pedido->usuario->apellido }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Fecha del Pedido:
                            {{ App\Utils\Util::formatearFecha($pedido->registro) }}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p>
                            @if ($pedido->retirado_por != null)
                                <strong>Retirado por:</strong>
                                @if ($pedido->retirado_por == 'dueno')
                                    Dueño del pedido
                                @else
                                    Un Tercero
                                @endif                                                        
                            @endif                        
                        </p>
                        <p>
                            @if ($pedido->retirado_por != null)
                                <strong>Cajero:</strong> {{ session('cajero')->nombre }} {{ session('apellido') }}
                            @endif                        
                        </p>
                    </div>
                    
                    @if ($pedido->estado == 'Finalizado' || $pedido->estado == 'Anulado')
                        @foreach (['Finalizado' => 'green', 'Anulado' => 'red'] as $estado => $color)
                            @if ($pedido->estado == $estado)
                                <span class="font-semibold bg-{{ $color }}-200 text-{{ $color }}-600 py-2 px-4 rounded-full text-sm">{{ $estado }}</span>
                            @endif
                        @endforeach
                    @else
                        <form onclick="return confirm('¿Estás seguro de anular?')" action="{{ route('caja.retiro') }}" method="POST"
                            class="ml-32 text-sm max-w-[120px] text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg px-4 py-2 transition duration-150">
                            @csrf
                            <input type="hidden" name="estado" value="Anulado">
                            <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                            <button type="submit">
                                Marcar como anulado
                            </button>

                        </form>
                        <a onclick="openModalPedido(event)" href=""
                            class="max-w-[150px] text-sm text-white bg-gray-800 hover:bg-gray-700 font-medium rounded-lg px-4 py-2 transition duration-150">
                            Marcar como Pedido Retirado
                        </a>
                    @endif
                </div>
            </div>
            <!-- Detalles del Pedido -->
            <div class="border-t border-gray-300 pt-6 mb-8">
                <p class="font-medium text-gray-700 dark:text-gray-300 mb-1">Resumen del Pedido</p>
                <p><strong class="text-gray-800 dark:text-gray-100">Forma de pago: </strong>{{ $pedido->formaPago }}
                <p><strong class="text-gray-800 dark:text-gray-100">Total: </strong>{{ number_format($pedido->coste) }} Gs.
                    {{-- {{ number_format($pedido->costoEnvio + $pedido->coste, 0, ',', '.') }} Gs.</p> --}}
                <p><strong class="text-gray-800 dark:text-gray-100">Productos: </strong> {{ count($productos) }}</p>
            </div>

            <!-- Tabla de Productos -->
            <div class="overflow-x-auto mb-8">
                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3">Código</th>
                            <th class="px-6 py-3">Producto</th>
                            <th class="px-6 py-3">Unidades</th>
                            <th class="px-6 py-3">Precio Unitario</th>
                            <th class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr class="bg-white dark:bg-gray-900">
                                <td class="px-6 py-4">
                                    #{{ $producto->producto->codigo }}
                                </td>
                                <td class="py-3 px-3 text-left max-w-[200px]">
                                    <div class="flex flex-col items-start">
                                        <div class="flex items-center space-x-2">
                                            <img class="w-7 h-7"
                                                src="{{ asset('uploads/productos') }}/{{ $producto->producto->imagen }}"
                                                alt="">
                                            <span class="mb-3">{{ $producto->producto->nombre }}</span>
                                        </div>
                                    </div>

                                </td>
                                <td class="px-6 py-4">
                                    {{ $producto->unidades }}
                                </td>
                                <td class="px-4 py-4">
                                    {{ number_format($producto->precio_unitario) }} Gs.
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($producto->precio_unitario * $producto->unidades) }} Gs.
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <!-- Información del Cliente -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <p class="font-medium text-lg text-gray-800 dark:text-gray-100 mb-4">Datos de adicionales</p>
                <p class="text-sm underline">Datos de factura:</p>
                <p><strong>Razon Social:</strong> {{ $datos->nombre }} {{ $datos->apellido }}</p>
                <p><strong>RUC o CI:</strong> {{ $datos->ruc_ci }}</p>
                <p><strong>Celular:</strong> {{ $pedido->celular }}</p>
                <p><strong>Email:</strong> {{ $pedido->email }}</p>
                @if (empty($tercero))
                @else
                    <p class="mt-4 text-sm underline">Persona que puede retirar el pedido:</p>
                    <p><strong>Nombre: </strong> {{ $tercero->nombre }}</p>
                    <p><strong>Cedula: </strong> {{ $tercero->cedula }}</p>
                    <p><strong>Telefono: </strong> {{ $tercero->telefono ?? 'No registrado' }}</p>
                @endif
            </div>
        </div>



        <div id="modalPedido" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white w-96 rounded-lg shadow-lg p-6">
                <!-- Título y botón de cerrar -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h3 class="text-xl font-semibold">Confirmar Retiro</h3>
                    <button onclick="closeModalPedido()" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                    </button>
                </div>

                <!-- Formulario del modal -->
                <form action="{{ route('caja.retiro') }}" method="POST">
                    @csrf
                    @if (empty($tercero))
                        <div class="mt-4">
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Retirado por:</label>
                            <select name="retirado_por" id="countries"
                                class="bg-gray-50 border border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="tercero">Un tercero</option>
                                <option selected value="dueno">Dueño del pedido</option>
                            </select>
                        </div>
                    @else
                        <div class="mt-4">
                            <label for="apellido" class="block text-sm font-medium text-gray-700">Retirado por:</label>
                            <select name="retirado_por" id="countries"
                                class="bg-gray-50 border border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="tercero">Un tercero</option>
                                <option value="dueno">Dueño del pedido</option>
                            </select>
                        </div>
                    @endif
                    <input type="hidden" name="estado" value="Finalizado">
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <div class="mt-4">
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Metodo de pago:</label>
                        <p class="mb-5 text-base font-semibold">{{ $pedido->formaPago }}</p>
                    </div>
                    <div class="mt-4">
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Total:</label>
                        <p class="mb-5 text-base font-semibold">{{ number_format($pedido->coste) }} Gs.</p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="mr-3 px-4 py-2 bg-gray-800 hover:bg-gray-400 text-gray-100 rounded-md">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            function openModalPedido(event) {
                event.preventDefault();
                document.getElementById('modalPedido').classList.remove('hidden');
            }

            function closeModalPedido() {
                document.getElementById('modalPedido').classList.add('hidden');
            }

            $(document).ready(function() {
                $('#cliente').select2({ // Referencia por ID
                    placeholder: "Selecciona un cliente",
                    allowClear: true
                });
            });
        </script>
    @endsection
