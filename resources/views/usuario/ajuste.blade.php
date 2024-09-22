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
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu Nombre</label>
                    <input type="text" id="nombre" name="nombre" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $user->name }}" required />
                </div>
                
                <div class="mb-5">
                    <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu Apellido</label>
                    <input type="text" id="apellido" name="apellido" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $user->apellido }}" required />
                </div>
                
                <div class="mb-5">
                    <label for="celular" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu Celular</label>
                    <input type="tel" id="celular" name="celular" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $user->celular }}" required />
                </div>
                
                <div class="py-4">
                    <hr>
                </div>
                
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cambiar Contraseña</label>
                    <input type="text" id="password" name="password" placeholder="Ingrese una nueva contraseña" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                </div>
                
                <button type="submit" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar
                </button>
            </form>
        </div>

        {{-- pedidos --}}
        <div class=" text-center w-2/3 text-xl flex flex-col">
            @foreach ($pedidos as $pedido)
            <div class="flex items-center justify-center pb-10">
                <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">                    
                    <div class="flex justify-between mb-4">
                        <div>
                            <b>Pedido #{{ $pedido->codigo }}</b>
                        </div>
                        
                        <div>
                            @if ($pedido->estado == 'Recibido')
                                <button class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-1">
                                    Recibido
                                </button>
                            @elseif ($pedido->estado == 'Enviado')
                                <button class="focus:outline-none text-white bg-orange-500 hover:bg-orange-600 font-medium rounded-lg text-sm px-5 py-1">
                                    Enviado
                                </button>
                            @elseif($pedido->estado == 'Procesado')
                                <button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm px-5 py-1">
                                    Procesado
                                </button>
                            @elseif($pedido->estado == 'Finalizado')
                                <button class="focus:outline-none text-white bg-green-500 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-1">
                                    Finalizado
                                </button>
                            @elseif($pedido->estado == 'Anulado')
                                <button class="focus:outline-none text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-1">
                                    Anulado
                                </button>
                            @endif
                        </div>
                        
                        @if ($pedido->estado != 'Recibido')                            
                        @else
                        <div>
                            <form action="{{ route('actualizar.estado') }}" method="POST">
                                @csrf
                                <input type="hidden" name="estado" value="Anulado">
                                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                <button type="submit" class="focus:outline-none text-white bg-red-500 hover:bg-red-800 font-medium rounded-lg text-xs px-3 py-1">
                                   Cancelar
                                </button>
                            </form>
                        </div>    
                        @endif
                        
                    </div>
                    
                    <div class="flex justify-between mb-4">
                        <div class="text-sm">
                            <b >Direccion de envio: </b> {{$pedido->calle }}, {{$pedido->ciudad}}
                        </div>
                        
                        <div>
                            <b>Total: {{ $pedido->costoEnvio > 0 ? 
                                number_format(round(($pedido->coste + (int)$pedido->costoEnvio), -2), 0, ',', '.')  : 
                                number_format(round($pedido->coste, -2), 0, ',', '.')}} Gs.</b>
                        </div>
                    </div>
                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Código</b>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Producto</b>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Unidades</b>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Precio Unitario</b>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Total</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedido->listaPedidos as $detalle)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            #{{ $detalle->producto->codigo }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $detalle->producto->nombre }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $detalle->unidades }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $detalle->producto->precio_oferta > 0 ? number_format($detalle->producto->precio_oferta, 0, ',', '.') : number_format($detalle->producto->precio, 0, ',', '.')}} Gs.                                            
                                        </td>
                                        <td class="px-6 py-4">                                        
                                            {{ $detalle->producto->precio_oferta > 0 ? number_format($detalle->unidades * $detalle->producto->precio_oferta, 0, ',', '.') : 
                                            number_format($detalle->unidades * $detalle->producto->precio, 0, ',', '.')}} Gs.
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
