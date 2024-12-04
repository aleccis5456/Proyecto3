<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/2 p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Confirmar Compra</h2>

        <p class="text-gray-600 mb-4 text-sm text-center">Estos son los productos que estás a punto de comprar:</p>

        <!-- Productos -->
        <div class="max-h-64 overflow-y-auto">
            <ul>
                <div class="px-4 py-4">
                    <table class="w-full bg-gray-50 rounded-md shadow-sm text-sm">
                        <thead>
                            <tr>
                                <th class="text-left p-2"></th>
                                <th class="text-left p-2">Producto</th>
                                <th class="text-left p-2">Cantidad</th>
                                <th class="text-left p-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('carrito') as $indice => $item)
                                <tr class="border-b border-gray-200">
                                    <!-- Imagen -->
                                    <td class="p-2">
                                        <img class="h-16 w-16 rounded-md object-cover" 
                                             src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}" 
                                             alt="">
                                    </td>
                                    
                                    <!-- Detalles del producto -->
                                    <td class="p-2">
                                        <p class="text-gray-800 font-semibold truncate w-36">
                                            {{ $item['nombre'] }}
                                        </p>
                                    </td>
                
                                    <!-- Cantidad -->
                                    <td class="p-2 text-gray-600">
                                        {{ $item['cantidad'] }}
                                    </td>
                
                                    <!-- Precio Total -->
                                    <td class="p-2 text-gray-800 font-semibold">
                                        @if ($item['cuota'] != null)
                                            {{ number_format(round($item['precio'] * $item['cantidad'], -2), 0, '.', '.') }}
                                            x{{ $item['cuota'] }} Gs.
                                        @else
                                            @if ($item['precio_oferta'] > 0)
                                                {{ number_format(round($item['precio_oferta'] * $item['cantidad'], -2), 0, '.', '.') }} Gs.
                                            @else
                                                {{ number_format(round($item['precio'] * $item['cantidad'], -2), 0, '.', '.') }} Gs.
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </ul>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4 mt-6">
            <span onclick="closeModalVenta()"
                class="cursor-pointer bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium rounded-lg text-sm px-4 py-2">
                Cancelar
            </span>
            
                <button type="submit" onclick="openProcessingModal()"
                    class="bg-[#fbb321] hover:bg-yellow-400 text-white font-medium rounded-lg text-sm px-4 py-2 shadow-md">
                    Confirmar
                </button>            
        </div>
    </div>
</div>