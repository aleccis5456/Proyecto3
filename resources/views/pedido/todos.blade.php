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
                    <th scope="col" class="px-6 py-3">Repartidor</th>
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
                                        @foreach (['Recibido', 'Procesado', 'Enviado', 'Finalizado', 'Anulado'] as $estado)
                                            <option value="{{ $estado }}" {{ $pedido->estado == $estado ? 'selected' : '' }}>
                                                {{ ucfirst($estado) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-2 ml-2 px-2"
                                        type="submit" value="Guardar">
                                </div>
                            </form>
                        </td>

                        <td class="px-6 py-4">
                            @foreach ($vendedores as $vendedor)
                                @if (ucfirst($vendedor->departamento) == ucfirst($pedido->departamento) or
                                        ucfirst($vendedor->ciudad) == ucfirst($pedido->ciudad))
                                    @php
                                        $asignado = $ventasAsignadas->where('vendedor_id', $vendedor->id)
                                                    ->where('pedido_id', $pedido->id)->first();                                                                   
                                    @endphp
                                    @if ($asignado and $asignado->pedido_id == $pedido->id)
                                        <p>{{ $vendedor->nombre }}</p>                                    
                                    @else
                                        
                                    @endif
                                @endif
                            @endforeach                           
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
