@extends('layouts.caja')

@section('contenido')
    <div class="max-w-sm mx-auto flex items-center justify-center">
        <x-alertas />
    </div>

    <div class="flex flex col">
        <div class="w-1/2">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 sr-only">
                                imagen
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                producto
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                precio
                            </th>
                            <th scope="col" class="px-6 py-3 sr-only">
                                cantidad
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('ventaCaja') as $indice => $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <img class="min-w-[45px] min-h-[45px] max-w-[50px] max-w-[50px]"
                                        src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}"
                                        alt="" srcset="">
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::limit($item['nombre'], 20) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($item['precio_oferta'] != 0 ? $item['precio_oferta'] : $item['precio'], 0, ',', '.') }}
                                    Gs.
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        @if ($item['producto_completo']['precio'] == $item['precio'])
                                            Cantidad:
                                            <div class="pl-2">
                                                <span class="font-bold">
                                                    <a href="{{ route('caja.add', ['id' => $item['id_producto']]) }}">+</a>
                                                    <span class="border px-1">{{ $item['cantidad'] }}</span>
                                                    <a href="{{ route('caja.quitar', ['indice' => $indice]) }}">-</a>
                                                </span>
                                            </div>
                                        @else
                                            Cantidad:
                                            <span class="border px-1">{{ $item['cantidad'] }}</span>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="w-1/2 border p-6 rounded-lg shadow-lg bg-white dark:bg-gray-800">
            <p class="text-center text-lg font-semibold mb-4 text-gray-900 dark:text-white">Datos para la factura</p>
            <form action="" method="POST">
        
                <!-- Selección de cliente -->
                <div class="mb-8">
                    <label for="cliente" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">Cliente:</label>
                    <div class="flex items-center space-x-3">
                        <select class="select2 border rounded-md flex-1 p-2" name="cliente" id="cliente">
                            <option value="">-Selecciona un cliente-</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nombre }} {{ $user->apellido }} | Nº:
                                    {{ $user->ruc_ci }}</option>
                            @endforeach
                        </select>
                        <!-- Botón para agregar cliente -->
                        <button onclick="openModalUser(event)" class="p-2.5 bg-gray-800 rounded-lg text-white" type="button">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
        
                <!-- Método de pago -->
                <div class="mb-8">
                    <label for="metodo_pago" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                        Método de pago:
                    </label>
                    <select id="metodo_pago" name="metodo_pago" class="w-full p-2 bg-gray-50 border rounded-lg text-sm dark:bg-gray-700 dark:border-gray-600">
                        <option value="">Selecciona un método de pago</option>
                        <option value="tarjeta">Tarjeta de crédito</option>
                        <option value="tarjeta">Tarjeta de débito</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                </div>
        
                <!-- Aplicar descuento -->
                <div class="mb-8">
                    <label for="number-input" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Aplicar descuento (%)</label>
                    <div class="flex items-center space-x-3">
                        <input type="number" id="number-input" min="0" max="100" class="w-24 p-2 bg-gray-50 border rounded-lg dark:bg-gray-700 dark:border-gray-600" placeholder="0 - 100">
                        <button id="apply-discount" class="bg-gray-800 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-gray-600" type="button">Aplicar</button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Introduce un valor entre 0 y 100 para aplicar un descuento porcentual.</p>
                </div>
                
                <!-- Subtotal -->
                <div class="flex items-center justify-between mb-4">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Subtotal:</span>
                    <span id="subtotal" class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format(App\Utils\Util::statsVentaCaja()['total_pagar'], 0, ',', '.') }} Gs.</span>
                </div>
                
                <!-- Total con descuento -->
                <div class="flex items-center justify-between mb-8">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Total:</span>
                    <span id="total" class="text-lg font-semibold text-gray-900 dark:text-white">{{ number_format(App\Utils\Util::statsVentaCaja()['total_pagar'], 0, ',', '.') }} Gs.</span>
                </div>
                
        
                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="cancelarOperacion()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
        
    </div>
<script>
    document.getElementById('apply-discount').addEventListener('click', function () {
    const discountInput = document.getElementById('number-input').value;
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');

    // Obtén el subtotal original
    let subtotal = parseFloat(subtotalElement.textContent.replace(/\./g, '').replace(' Gs', ''));
    if (isNaN(subtotal)) subtotal = 0;

    // Calcula el descuento
    const discountPercentage = parseFloat(discountInput);
    if (discountPercentage >= 0 && discountPercentage <= 100) {
        const discountAmount = subtotal * (discountPercentage / 100);
        const totalWithDiscount = subtotal - discountAmount;

        // Actualiza el total con el descuento aplicado
        totalElement.textContent = `${numberFormat(totalWithDiscount)} Gs`;
    } else {
        alert('Introduce un valor de descuento entre 0 y 100.');
    }
});

// Formatear número con separadores de miles y decimales
function numberFormat(number) {
    return new Intl.NumberFormat('es-PY', {
        minimumFractionDigits: 0
    }).format(number);
}

</script>
   
    
    @include('caja.includes.aggClienteModal')
@endsection
