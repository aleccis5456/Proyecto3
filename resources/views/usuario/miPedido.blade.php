@extends('layouts.app')

@section('titulo', 'Buscar mi pedido')
@section('contenido')
    
    <br>
    <br>
    <br>
    <br>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 text-center">
        Rastrear Pedido
    </h2>
    <div class="flex justify-center items-center w-2/3 text-xl flex-col mx-auto">
        <div class="max-w-full p-6 mb-10 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 text-center">
                <!-- Encabezado -->
                <div class="flex items-center justify-between mb-6">
                    <div class="text-lg font-bold text-gray-700 dark:text-gray-200">
                        Pedido #{{ $pedido->codigo }}
                    </div>
                    <div>
                        @foreach (['Recibido' => 'blue', 'Procesado' => 'yellow', 'Enviado' => 'orange', 'Finalizado' => 'green', 'Anulado' => 'red'] as $estado => $color)
                            @if ($pedido->estado == $estado)
                                <span class="bg-{{$color}}-200 rounded-full text-{{$color}}-800 font-semibold text-sm px-4 py-1">
                                    {{$estado}}
                                </span>
                            @endif
                        @endforeach
                    </div>
                    @if ($pedido->estado == 'Recibido')
                        <form action="{{ route('cancelar.pedido') }}" method="POST">
                            @csrf
                            <input type="hidden" name="estado" value="Anulado">
                            <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                            <button type="submit" class="flex items-center text-white bg-red-600 hover:bg-red-800 rounded-lg text-sm font-semibold px-3 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.707 5.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 101.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586 6.707 5.293z" clip-rule="evenodd" />
                                </svg>
                                Cancelar
                            </button>
                        </form>
                    @endif
                </div>
    
                <!-- Detalles del pedido -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        @if ($pedido->formaEntrega == "retiro")
                            <b class=" ">Retiro en tienda</b><br>
                        @elseif($pedido->formaEntrega == "venta_caja")
                            <b class="">Venta en caja</b><br>
                        @else
                            <b class="">Dirección de envío:</b> {{ $pedido->calle }}, {{ $pedido->ciudad }}<br>    
                        @endif
                                                
                        <div class="pt-2">
                            @if ($tercero)
                                <b>Datos del tercero:</b>                                
                                <p>Nombre: {{ $tercero->nombre }} {{ $tercero->apellido }}</p>
                                <p>Cédula: {{ $tercero->cedula }}</p>
                            @else
                                <b>Datos del tercero:</b> No disponible
                            @endif
                        </div>
                        
                    </div>
                    <div class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        <b>Total:</b>
                        {{ $pedido->costoEnvio > 0
                            ? number_format(round($pedido->coste + (int) $pedido->costoEnvio, -2), 0, ',', '.')
                            : number_format(round($pedido->coste, -2), 0, ',', '.') }}
                        Gs.
                    </div>
                </div>
    
                <!-- Tabla de productos -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3"><b>Código</b></th>
                                <th scope="col" class="px-6 py-3"><b>Producto</b></th>
                                <th scope="col" class="px-6 py-3"><b>Unidades</b></th>
                                <th scope="col" class="px-6 py-3"><b>Precio Unitario</b></th>
                                <th scope="col" class="px-6 py-3"><b>Total</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->listaPedidos as $detalle)
                                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4">#{{ $detalle->producto->codigo }}</td>
                                    <td class="px-6 py-4">{{ $detalle->producto->nombre }}</td>
                                    <td class="px-6 py-4">{{ $detalle->unidades }}</td>
                                    <td class="px-6 py-4">
                                        {{ $detalle->producto->precio_oferta > 0 ? number_format($detalle->producto->precio_oferta, 0, ',', '.') : number_format($detalle->producto->precio, 0, ',', '.') }}
                                        Gs.
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $detalle->producto->precio_oferta > 0
                                            ? number_format($detalle->unidades * $detalle->producto->precio_oferta, 0, ',', '.')
                                            : number_format($detalle->unidades * $detalle->producto->precio, 0, ',', '.') }}
                                        Gs.
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>        
    </div>    
@endsection