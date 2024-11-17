@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex items-center justify-center py-12 bg-gray-100 dark:bg-gray-900">        
        <div
            class="w-full max-w-4xl p-8 bg-white border border-gray-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-alertas />
            
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Pedido #{{ $pedido->codigo }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pedido realizado por
                            {{ $pedido->usuario->name }}</div>                        
                        <div class="text-sm text-gray-500 dark:text-gray-400">Fecha del Pedido:
                            {{ App\Utils\Util::formatearFecha($pedido->registro) }}</div>
                    </div>
                    <a href="{{ route('pdf.factura', ['id' => $pedido->id]) }}"
                        class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg px-4 py-2 transition duration-150">
                        Generar Factura
                    </a>
                </div>
            </div>

            <div class="mb-8 flex items-center gap-4">
                <form method="POST" action="{{ route('actualizar.estado') }}" class="flex items-center">
                    @csrf
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <select id="estado" name="estado" class="bg-gray-50 border border-gray-300 rounded-lg px-2 py-1">
                        @foreach (['Recibido', 'Procesado', 'Enviado', 'Finalizado', 'Anulado'] as $estado)
                            <option value="{{ $estado }}" {{ $pedido->estado == $estado ? 'selected' : '' }}>
                                {{ ucfirst($estado) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="ml-2 bg-gray-800 hover:bg-gray-600 text-white font-medium rounded-lg px-4 py-1 transition duration-150">
                        Guardar
                    </button>
                </form>

                <!-- Estado Actual del Pedido -->
                <span
                    class="px-3 py-1 rounded-lg text-white {{ $pedido->estado == 'Recibido' ? 'bg-blue-500' : '' }} {{ $pedido->estado == 'Procesado' ? 'bg-yellow-400' : '' }} {{ $pedido->estado == 'Enviado' ? 'bg-orange-500' : '' }} {{ $pedido->estado == 'Finalizado' ? 'bg-green-500' : '' }} {{ $pedido->estado == 'Anulado' ? 'bg-red-600' : '' }}">
                    {{ ucfirst($pedido->estado) }}
                </span>
            </div>

            <!-- Detalles del Pedido -->
            <div class="border-t border-gray-300 pt-6 mb-8">
                <p class="font-medium text-gray-700 dark:text-gray-300 mb-1">Resumen del Pedido</p>
                <p><strong class="text-gray-800 dark:text-gray-100">Total:</strong>
                    {{ number_format($pedido->costoEnvio + $pedido->coste, 0, ',', '.') }} Gs.</p>
                <p><strong class="text-gray-800 dark:text-gray-100">Productos:</strong> {{ $cantidad }}</p>
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
                        @foreach ($producto as $item)
                            <tr class="bg-white dark:bg-gray-900">
                                <td class="px-6 py-4">{{ $item->producto->codigo }}</td>
                                <td class="px-6 py-4">{{ $item->producto->nombre }}</td>
                                <td class="px-6 py-4">{{ $item->unidades }}</td>
                                <td class="px-6 py-4">{{ number_format($item->precio_unitario, 0, ',', '.') }} Gs.</td>
                                <td class="px-6 py-4">
                                    {{ number_format($item->precio_unitario * $item->unidades, 0, ',', '.') }} Gs.</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <!-- Información del Cliente -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <p class="font-medium text-lg text-gray-800 dark:text-gray-100 mb-4">Información del Cliente</p>
                <p><strong>Nombre:</strong> {{ $datos->nombre }} {{ $datos->apellido }}</p>
                <p><strong>RUC o CI:</strong> {{ $datos->ruc_ci }}</p>
                <p><strong>Celular:</strong> {{ $pedido->celular }}</p>
                <p><strong>Email:</strong> {{ $pedido->usuario->email ?? 'Invitado' }}</p>
                <p><strong>Dirección de Envío:</strong> {{ $pedido->departamento }}, {{ $pedido->ciudad }},
                    {{ $pedido->calle }}</p>
                <p><strong>Total del Envío:</strong> {{ number_format($pedido->costoEnvio, 0, ',', '.') }} Gs.</p>
            </div>
            <hr>            
            @if ($pedido->estado == 'Finalizado')                
            @else
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                <p class="font-medium text-lg text-gray-800 dark:text-gray-100 mb-4">Asignar Repartidor</p>
            </div>
            <form class="max-w-sm mx-auto" method="POST" action="{{ route('vendedores.ventas') }}">
                @csrf
                <div class="flex">
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    <select id="vendedores" name="vendedor_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">--Selecciona--</option>
                        @foreach ($vendedores as $vendedor)
                            @if (ucfirst($vendedor->departamento) == ucfirst($pedido->departamento) or
                                    ucfirst($vendedor->ciudad) == ucfirst($pedido->ciudad))
                                @php
                                    $asignado = $ventasAsignadas
                                        ->where('vendedor_id', $vendedor->id)
                                        ->where('pedido_id', $pedido->id)
                                        ->first();
                                    $cantidad = $ventasAsignadas->where('vendedor_id', $vendedor->id)->count();
                                @endphp
                                @if ($asignado)
                                    <option value="{{ $vendedor->id }}" selected>
                                        Vendedor: <b>{{ $vendedor->nombre }}</b> ({{ $cantidad }} pedidos asignados)
                                    </option>
                                    <option value="cambiar" class="cancelar-cambiar">Cancelar y cambiar</option>
                                @else
                                    <option value="{{ $vendedor->id }}">
                                        <b>{{ $vendedor->nombre }}</b>
                                        ({{ $cantidad > 0 ? $cantidad . ' pedidos asignados' : 'sin pedidos asignados' }})
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <input class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-2 ml-2 px-2" type="submit"
                        value="Guardar">
                </div>
            </form>
            @endif
          
        </div>
    </div>
@endsection
