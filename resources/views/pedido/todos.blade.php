@extends('layouts.adm')

@section('contenidoAdm')
    <div class="items-center text-center ">
        <x-alertas />
    </div>

    <div class="relative overflow-x-auto p-10">
        <!-- Formulario de búsqueda -->

        <form class="max-w-md mx-auto px-4 pb-5" action="{{ route('pedido.buscador') }}" method="GET" name="form_buscador">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="b" value="{{ $b ?? '' }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Busca por código o por usuario..." />
            </div>
        </form>


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">codigo</th>
                    <th scope="col" class="px-6 py-3">usuario</th>
                    <th scope="col" class="px-6 py-3">registro</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                    <th scope="col" class="px-6 py-3">Asignar Vendedor</th>
                    <th scope="col" class="px-6 py-3">Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            #{{ $pedido->codigo }}
                        </th>
                        <td class="px-6 py-4">{{ $pedido->usuario->name }}</td>
                        <td class="px-6 py-4">{{ $pedido->registro }}</td>
                        <td class="px-6 py-4">
                            {{-- {{ number_format(round($pedido->coste, -2), 0, ',', '.') }} Gs. --}}
                            {{ $pedido->costoEnvio > 0 ? number_format($pedido->costoEnvio + $pedido->coste, 0, '.', '.') : number_format(round($pedido->coste, -2), 0, ',', '.') }}
                            Gs.
                        </td>
                        <td class=" py-4">
                            <form method="POST" action="{{ route('actualizar.estado') }}">
                                @csrf
                                <div class="flex">
                                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                    <select id="estado" name="estado"
                                        class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @if ($pedido->estado == 'Recibido')
                                            <option class="text-blue-500 font-bold" selected value="Recibido">Recibido
                                            </option>
                                            <option class="text-yellow-500" value="Enviado">Procesado</option>
                                            <option class="text-orange-500" value="Procesado">Enviado</option>
                                            <option class="text-green-500" value="Finalizado">Finalizado</option>
                                            <option class="text-red-500" value="Anulado">Anulado</option>
                                        @elseif($pedido->estado == 'Procesado')
                                            <option class="text-blue-500" value="Recibido">Recibido</option>
                                            <option class="text-yellow-500" value="Procesado" selected>Procesado</option>
                                            <option class="text-orange-500 font-bold" value="Enviado">Enviado</option>
                                            <option class="text-green-500" value="Finalizado">Finalizado</option>
                                            <option class="text-red-500" value="Anulado">Anulado</option>
                                        @elseif($pedido->estado == 'Enviado')
                                            <option class="text-blue-500" value="Recibido">Recibido</option>
                                            <option class="text-yellow-500" value="Procesado">Procesado</option>
                                            <option class="text-orange-500" value="Enviado" selected>Enviado</option>
                                            <option class="text-green-500" value="Finalizado">Finalizado</option>
                                            <option class="text-red-500" value="Anulado">Anulado</option>
                                        @elseif($pedido->estado == 'Finalizado')
                                            <option class="text-blue-500" value="Recibido">Recibido</option>
                                            <option class="text-yellow-500" value="Procesado">Procesado</option>
                                            <option class="text-orange-500" value="Enviado">Enviado</option>
                                            <option class="text-green-500 font-bold" selected value="Finalizado">Finalizado
                                            </option>
                                            <option class="text-red-500" value="Anulado">Anulado</option>
                                        @elseif($pedido->estado == 'Anulado')
                                            <option class="text-blue-500" value="Recibido">Recibido</option>
                                            <option class="text-yellow-500" value="Procesado">Procesado</option>
                                            <option class="text-orange-500" value="Enviado">Enviado</option>
                                            <option class="text-green-500" value="Finalizado">Finalizado</option>
                                            <option class="text-red-500 font-bold" selected value="Anulado">Anulado
                                            </option>
                                        @endif
                                    </select>
                                    <input class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-2 ml-2 px-2"
                                        type="submit" value="Guardar">
                                </div>
                            </form>
                        </td>

                        <td class="px-6 py-4">
                            <form class="max-w-sm mx-auto" method="POST" action="{{ route('vendedores.ventas') }}">
                                @csrf
                                <div class="flex">
                                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                    <select id="countries" name="vendedor_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="">--Selecciona--</option>

                                        @foreach ($vendedores as $vendedor)
                                            @if (ucfirst($vendedor->departamento) == ucfirst($pedido->departamento) or
                                                    ucfirst($vendedor->ciudad) == ucfirst($pedido->ciudad))
                                                @php
                                                    $asignado = $ventasAsignadas->where('vendedor_id', $vendedor->id)->first();
                                                    $cantidad = $ventasAsignadas->where('vendedor_id', $vendedor->id)->count();
                                                @endphp

                                                @if ($asignado)
                                                    @if ($cantidad > 1)
                                                        <option value="{{ $vendedor->id }}" selected>Vendedor: {{ $vendedor->nombre }} ({{ $cantidad }})
                                                        <option class="text-red-600" value="cambiar"> Cancelar y cambiar</option>                                                                                                                 
                                                        @continue
                                                    @elseif($cantidad == 1)                                                        
                                                        @if ($asignado->pedido_id == $pedido->id)
                                                            <option value="{{ $vendedor->id }}" selected>Vendedor: {{ $vendedor->nombre }} ({{ $cantidad }})
                                                            <option class="text-red-600" value="cambiar"> Cancelar y cambiar</option>
                                                        @else
                                                            <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}({{ $cantidad }})</option>                                                                    
                                                        @endif                                                                
                                                    @endif
                                                    @continue
                                                    @if ($asignado->pedido_id == $pedido->id)
                                                        <option value="{{ $vendedor->id }}" selected>Vendedor: {{ $vendedor->nombre }} ({{ $cantidad }})
                                                        <option class="text-red-600" value="cambiar"> Cancelar y cambiar</option>
                                                        
                                                    @endif
                                                @else
                                                    <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}({{ $cantidad }})</option>
                                                @endif
                                            @endif
                                        @endforeach

                                    </select>

                                    <input class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-2 ml-2 px-2"
                                        type="submit" value="Guardar">
                                </div>
                            </form>
                        </td>

                        <td class="px-6 py-4">
                            <a class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-2 ml-2 px-2"
                                href="{{ route('pedido.detalle', ['id' => $pedido->id]) }}">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-1/2">
        {{ $pedidos->links() }}
    </div>
@endsection
