@extends('layouts.caja')

@section('contenido')

<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pedidos a Retirar</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Codigo</th>
                    <th class="py-3 px-6 text-left">Producto</th>
                    <th class="py-3 px-6 text-left">Cliente</th>
                    <th class="py-3 px-6 text-left">Fecha de Registro</th>
                    <th class="py-3 px-6 text-center">Estado</th>
                    <th class="py-3 px-6 text-center">Acción</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($listaPedidos as $listaPedido)
                @php
                    $datos = $datos->where('pedido_id', $listaPedido->pedido_id)->first();                                        
                @endphp                                
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-center">
                        #{{ $listaPedido->pedido->codigo }}
                    </td>
                    <td class="py-3 px-6 text-left max-w-[380px]">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-md mr-3" src="{{ asset("uploads/productos") }}/{{$listaPedido->producto->imagen}}" alt="Producto">
                            <p>{{ $listaPedido->producto->nombre }}</p>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left max-w-[200px]">
                        <div>                            
                            <p class="font-semibold text-xs">Cliente: {{$listaPedido->pedido->usuario->name}} {{$listaPedido->pedido->usuario->apellido}}</p>
                            <p class="text-gray-500 py-2">Datos de Factura: </p>Razon: {{ $datos->nombre }} {{ $datos->apellido }} <br>
                            RUC/CI: {{$datos->ruc_ci}}
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left max-w-[90px]">{{ App\Utils\Util::soloFecha($listaPedido->pedido->registro) }}</td>
                    <td class="py-3 px-6 text-center">                        
                        @if ($listaPedido->pedido != 'Finalizado')
                            <span class="font-semibold bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Pendiente</span>
                        @else
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Retirado</span>
                        @endif                        
                    </td>
                    <input type="hidden" name="" id="product_id" value="{{ $listaPedido->producto_id }}">
                    <input type="hidden" id="product_name" value="{{ $listaPedido->producto->nombre }}">
                    <input type="hidden" name="" id="client" value="{{$listaPedido->pedido->usuario->name}} {{$listaPedido->pedido->usuario->apellido}}">
                    <input type="hidden" id="factura" value="{{ $datos->nombre }} {{ $datos->apellido}}">
                    <td class="py-3 px-6 text-center min-w-[134px]">
                        <a onclick="openModalVerMas(event, product_id, product_name, product_code, client, factura)" href="#" class="bg-gray-800 hover:bg-gray-600  text-white py-2 px-4 rounded-lg text-sm">Ver más</a>
                    </td>
                </tr>    
                @endforeach                                
            </tbody>
        </table>
    </div>
</div>


<div id="modalVerMas" tabindex="-1" aria-hidden="true" 
class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
<div class="relative p-4 w-full max-w-2xl">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Información del Pedido
            </h3>
            <button onclick="closeModalVerMas()" type="button" 
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>        
        <div class="p-4 md:p-5 space-y-4">            
            <p class="text-gray-600 dark:text-gray-300">Detalles del producto y del cliente...</p>
        </div>        
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 
                font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Guardar
            </button>
            <button onclick="closeModalVerMas()" 
                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg 
                border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 
                dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Cancelar
            </button>
        </div>
    </div>
</div>
</div>

<script>
function openModalVerMas(event) {
    event.preventDefault();
    document.getElementById('modalVerMas').classList.remove('hidden');
}

function closeModalVerMas() {
    document.getElementById('modalVerMas').classList.add('hidden');
}
</script>

@endsection
