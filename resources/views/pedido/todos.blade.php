@extends('layouts.adm')

@section('contenidoAdm')
    <div class="items-center text-center ">
        <x-alertas />
    </div>

    <div class="relative overflow-x-auto p-10">
        <!-- Formulario de búsqueda -->

        <form class="max-w-md mx-auto px-4 pb-5" action="{{ route('pedidos') }}" method="GET" name="form_buscador">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="filtro" value="{{ $b ?? '' }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Busca por código o por usuario..." />
            </div>
        </form>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class=" text-xs text-black uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">codigo</th>
                    <th scope="col" class="px-6 py-3">usuario</th>
                    <th scope="col" class="px-6 py-3">
                        <form action="" method="get">
                            <input type="hidden" name="b" value="{{ $b }}">
                            <input type="hidden" name="column" value="registro">
                            <input type="hidden" name="orderBy" value=" {{ $orderBy == 'asc' ? 'desc' : 'asc' }} ">
                            <button class="flex" type="submit">REGISTRO
                                <span class="flex">
                                    @if ($flag == 'registro_column')
                                        {{ $orderBy == 'desc' ? '▼' : '▲' }}
                                    @else
                                        ▼▲
                                    @endif
                                </span>
                            </button>
                        </form>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <form action="" method="get">
                            <input type="hidden" name="b" value="{{ $b }}">
                            <input type="hidden" name="column" value="coste">
                            <input type="hidden" name="orderBy" value=" {{ $orderBy == 'asc' ? 'desc' : 'asc' }} ">
                            <button class="flex" type="submit">TOTAL
                                <span class="flex">
                                    @if ($flag == 'total_column')
                                        {{ $orderBy == 'desc' ? '▼' : '▲' }}
                                    @else
                                        ▼▲
                                    @endif
                                </span>
                            </button>
                        </form>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        <form action="" method="get">
                            <input type="hidden" name="b" value="{{ $b }}">
                            <input type="hidden" name="column" value="estado">
                            <input type="hidden" name="orderBy" value=" {{ $orderBy == 'asc' ? 'desc' : 'asc' }} ">
                            <button class="flex" type="submit">ESTADO
                                <span class="flex">
                                    @if ($flag == 'estado_column')
                                        {{ $orderBy == 'desc' ? '▼' : '▲' }}
                                    @else
                                        ▼▲
                                    @endif
                                </span>
                            </button>
                        </form>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">Repartidor</th>
                    <th scope="col" class="px-6 py-3">Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    @php
                        $colores = [
                            'Recibido' => 'blue',
                            'Procesado' => 'yellow',
                            'Enviado' => 'orange',
                            'Finalizado' => 'green',
                            'Anulado' => 'red',
                        ];
                        $color = $colores[$pedido->estado] ?? 'white';
                    @endphp
                    @if (is_null($notificacion))
                        <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
                        @else
                        <tr class="{{ $pedido->id == $notificacion->pedido_id ? 'border-b-4 border-[#fbb321]' : 'bg-white' }} border-b dark:bg-gray-800 dark:border-gray-700">
                    @endif

                    <!-- Contenido de la fila -->
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        #{{ $pedido->codigo }}
                    </th>
                    <td class="px-6 py-4">{{ $pedido->usuario->name }}</td>
                    <td class="px-6 py-4">{{ $pedido->registro }}</td>
                    <td class="px-6 py-4">
                        {{ $pedido->costoEnvio > 0 ? number_format($pedido->costoEnvio + $pedido->coste, 0, '.', '.') : number_format(round($pedido->coste, -2), 0, ',', '.') }}
                        Gs.
                    </td>
                    <td class="py-4 text-center">
                        {{-- <p class="text-black font-semibold bg-{{$color}}-200 text-{{$color}}-800 py-2 px-1 rounded-full">{{$pedido->estado}}</p> --}}
                        <span
                            class="bg-{{ $color }}-200 text-{{ $color }}-600 py-2 px-4 rounded-full text-xs font-semibold">{{ $pedido->estado }}</span>
                    </td>

                    <td class="px-2 py-1 font-semibold text-center">
                        @if ($pedido->costoEnvio == 0 and $pedido->formaEntrega == 'retiro')
                            <p class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full">Retiro en tienda</p>
                        @elseif($pedido->costoEnvio == 0 and $pedido->formaEntrega == 'venta_caja')
                            <p class="bg-black text-white px-2 py-1 rounded-full">Venta en caja</p>
                        @else
                            @foreach ($vendedores as $vendedor)
                                @if (ucfirst($vendedor->departamento) == ucfirst($pedido->departamento) ||
                                        ucfirst($vendedor->ciudad) == ucfirst($pedido->ciudad))
                                    @php
                                        $asignado = $ventasAsignadas
                                            ->where('vendedor_id', $vendedor->id)
                                            ->where('pedido_id', $pedido->id)                                            
                                            ->first();
                                    @endphp
                                    @if ($asignado && $asignado->pedido_id == $pedido->id)
                                        <p class="bg-gray-700 text-gray-200 px-2 py-1 rounded-full">Envio | {{ $vendedor->nombre }}</p>
                                    @endif
                                @endif
                            @endforeach
                        @endif

                    </td>

                    <td class="px-6 py-4">
                        <a class="border border-gray-800 text-gray-800 rounded-lg hover:underline py-2 ml-2 px-2"
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
