@extends('layouts.app')
@section('titulo', 'Ajuste')

@section('contenido')

    <div class="p-12 flex">
        <div class="w-1/3">
            <x-alertas />
            <!-- Formulario de información personal -->
            <form class="max-w-sm mx-auto" action="{{ route('AjusteSave') }}" method="POST">
                @csrf
                <p class="text-xl text-center">Información Personal</p>
                <p class="text-center text-xs mb-8 text-gray-500">Aquí puedes cambiar tus datos</p>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $user->email }}" required />
                </div>

                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                        Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $user->name }}" required />
                </div>

                <div class="mb-5">
                    <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                        Apellido</label>
                    <input type="text" id="apellido" name="apellido"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $user->apellido }}" required />
                </div>

                <div class="mb-5">
                    <label for="celular" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu
                        Celular</label>
                    <input type="tel" id="celular" name="celular"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $user->celular }}" required />
                </div>

                <div class="py-4">
                    <hr>
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cambiar
                        Contraseña</label>
                    <input type="text" id="password" name="password" placeholder="Ingrese una nueva contraseña"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar
                </button>
            </form>
        </div>

        {{-- pedidos --}}
        <div class="justify-between w-2/3 text-xl flex flex-col">
            @foreach ($pedidos as $pedido)
                <div class="max-w-full p-6 mb-10 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
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
                            <b>Registro:</b> {{$pedido->registro}}<br>
                            @if ($pedido->formaEntrega == "retiro")
                                <b class=" ">Retiro en tienda</b><br>
                            @elseif($pedido->formaEntrega == "venta_caja")
                                <b class="">Venta en caja</b><br>
                            @else
                                <b class="">Dirección de envío:</b> {{ $pedido->calle }}, {{ $pedido->ciudad }}<br>    
                            @endif
                            
                            @php
                                $tercero = $terceros->where('pedido_id', $pedido->id)->first();
                            @endphp
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
            @endforeach
        </div>
        
@endsection




  {{-- @if ($pedido->estado == 'Recibido')
                                    <span
                                        class="bg-blue-200 rounded-full text-blue-800 font-semibold text-sm px-5 py-1">
                                        Recibido
                                    </span>
                                @elseif ($pedido->estado == 'Enviado')
                                    <span
                                    class="bg-orange-200 rounded-full text-orange-800 font-semibold text-sm px-5 py-1">
                                        Enviado
                                    </span>
                                @elseif($pedido->estado == 'Procesado')
                                    <span
                                        class="bg-yellow-200 rounded-full text-yellow-800 font-semibold text-sm px-5 py-1">
                                        Procesado
                                    </span>
                                @elseif($pedido->estado == 'Finalizado')
                                    <span
                                    class="bg-green-200 rounded-full text-green-800 font-semibold text-sm px-5 py-1">
                                        Finalizado
                                    </span>
                                @elseif($pedido->estado == 'Anulado')
                                    <span
                                    class="bg-red-200 rounded-full text-red-800 font-semibold text-sm px-5 py-1">
                                        Anulado
                                    </span>
                                @endif --}}
