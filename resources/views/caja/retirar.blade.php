@extends('layouts.caja')

@section('contenido')
    <div class="container mx-auto px-4 py-6">        
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Pedidos a Retirar</h2>
        <div class="mb-5">
            <form action="" method="get">
                <div class="flex items-center">
                    <input id="search-input" type="text" placeholder="Buscar..."
                        class="bg-gray-100 h-[35px] border border-gray-100 rounded-lg shadow-md focus:ring-gray-100 focus:border-gray-800">
                    <button class="ml-1 px-2 py-1 bg-gray-800 rounded-lg shadow-md focus:ring-gray-100 focus:border-none">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <x-alertas/>
        <div class="overflow-x-auto">
            <table id="pedido-table" class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
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
                                    <p class="text-gray-500 py-2">Datos de Factura:</p>
                                    Razon: {{ $datos->nombre }} {{ $datos->apellido }} <br>
                                    RUC/CI: {{ $datos->ruc_ci }}
                                </div>
                            </td>
                            <td class="py-3 px-3 text-center max-w-[90px]">
                                {{ App\Utils\Util::soloFecha($pedido->registro) }}
                            </td>
                            <td class="py-3 px-3 text-center">
                                @if ($pedido->estado != 'Finalizado' and $pedido->estado != 'Anulado')
                                    <span class="font-semibold bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Pendiente</span>
                                @elseif($pedido->estado == 'Finalizado')
                                    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Retirado</span>
                                @elseif($pedido->estado == 'Anulado')
                                    <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Anulado</span>
                                @endif
                            </td>                          
                            <td class="py-3 px-3 text-center min-w-[134px]">
                                <a href="{{ route('caja.cambiarestado', ['id' => $pedido->id]) }}"
                                    class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-lg text-sm">
                                    Ver más
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>


    <script>
        document.getElementById('search-input').addEventListener('input', function () {
            const query = normalizeText(this.value);
            const rows = document.querySelectorAll('#pedido-table tbody tr');
    
            rows.forEach(row => {
                const pedidoCode = normalizeText(row.querySelector('td:nth-child(1)').textContent); // Código del pedido
                const clienteName = normalizeText(row.querySelector('td:nth-child(3)').textContent); // Nombre del cliente
    
                // Mostrar u ocultar la fila dependiendo del match
                if (pedidoCode.includes(query) || clienteName.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    
        function normalizeText(text) {
            return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/ñ/g, "n").replace(/Ñ/g, "N").toLowerCase();
        }
    </script>
@endsection
