@extends('layouts.caja')

@section('contenido')
<div class="flex items-center justify-center py-12 dark:bg-gray-900">        
    <div
        class="w-full max-w-4xl p-8 bg-white border border-gray-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <x-alertas />
        
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-2xl font-semibold text-gray-800 dark:text-gray-300">Detalles del pedido # {{$pedido->codigo}}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Pedido realizado por: {{$pedido->usuario->name}} {{$pedido->usuario->apellido}}
                        </div>                        
                    <div class="text-sm text-gray-500 dark:text-gray-400">Fecha del Pedido: {{App\Utils\Util::formatearFecha($pedido->registro) }}
                        </div>
                </div>
                <a href=""
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg px-4 py-2 transition duration-150">
                    Marcar como Pedido Retirado
                </a>
            </div>
        </div>     
        <!-- Detalles del Pedido -->
        <div class="border-t border-gray-300 pt-6 mb-8">
            <p class="font-medium text-gray-700 dark:text-gray-300 mb-1">Resumen del Pedido</p>
            <p><strong class="text-gray-800 dark:text-gray-100">Total: {{number_format($pedido->coste)}} Gs.</strong>
                {{-- {{ number_format($pedido->costoEnvio + $pedido->coste, 0, ',', '.') }} Gs.</p> --}}
            <p><strong class="text-gray-800 dark:text-gray-100">Productos: {{count($productos)}}</strong> </p>
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
                                #{{$producto->producto->codigo}}
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
                                {{$producto->unidades}}
                            </td>
                            <td class="px-4 py-4">
                                {{ number_format($producto->precio_unitario) }} Gs.
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(($producto->precio_unitario) * $producto->unidades) }} Gs.
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
            <p><strong>Razon Social:</strong> {{$datos->nombre}} {{$datos->apellido}}</p>
            <p><strong>RUC o CI:</strong> {{$datos->ruc_ci}}</p>
            <p><strong>Celular:</strong> {{$pedido->celular}}</p>
            <p><strong>Email:</strong> {{$pedido->email}}</p>                        
    </div>
</div>
@endsection