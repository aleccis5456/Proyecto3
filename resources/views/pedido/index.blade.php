@extends('layouts.app')
@section('titulo', 'Checkout')

@section('contenido')
    <!-- linea de progreso -->
    @include('pedido.includes.lineaProgreso')
    <!-- /linea de progreso -->    
    <div class="flex  pt-5">
        <div class="w-2/3">
            <p class="text-2xl px-10 font-bold text-center">Finalizar el pedido</p>
            @if (!Auth::user())
                <form class="max-w-sm mx-auto pt-5" method="POST" action=" {{ route('check.login') }} ">
                    <p class="text-sm text-gray-500 py-2">¿Tienes cuenta? Inicia sesión o continúa como invitado.</p>
                    @csrf
                    <x-alertas />
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Contraseña</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <input type="hidden" name="bandera" value="1">

                    <button type="submit"
                        class="text-gray-600 bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ingresar</button>
                </form>
            @endif

            <div class="pt-6 pb-6">
                <hr>
                <p class="text-sm text-gray-600 text-center">Datos para la fatura</p>
            </div>

            <!-- formulario para el pedido -->
            @include('pedido.includes.formularioPedido')
            <!-- formulario para el pedido -->
        </div>

        <div class="px-10 pt-12">
            <table class="">
                <thead>
                    <tr>
                        <th></th>
                        <th class="w-50"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('carrito') as $indice => $item)
                        <tr class="">
                            <td>
                                <img src="{{ asset('uploads/productos') }}/{{ $item['producto_completo']['imagen'] }}"
                                    width="150" alt="">
                            </td>
                            <td class="flex mx-6">
                                <div class="flex-col">
                                    <div>
                                        <br>
                                        <a class="text-sm text-gray-500">
                                            {{-- {{ strlen($item['nombre']) > 50 ? substr($item['nombre'], 0, 50) . '...' : $item['nombre'] }} --}}
                                            {{ $item['nombre'] }}
                                        </a>
                                    </div>

                                    <div>
                                        Cantidad:
                                        <span class="">
                                            <span class="">{{ $item['cantidad'] }}</span>
                                        </span>
                                    </div>

                                    <div>
                                        @if ($item['cuota'] != null)
                                            <b>{{ number_format(round($item['precio'] * $item['cantidad'], -2), 0, '.', '.') }}
                                                x{{ $item['cuota'] }} Gs.</b>
                                        @else
                                            @if ($item['precio_oferta'] > 0)
                                                <b>{{ number_format(round($item['precio_oferta'] * $item['cantidad'], -2), 0, '.', '.') }}
                                                    Gs.</b>
                                            @else
                                                <b>{{ number_format(round($item['precio'] * $item['cantidad'], -2), 0, '.', '.') }}
                                                    Gs.</b>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Obtén el total base del producto
            const baseTotal = {{ number_format(round(App\Utils\Util::stats()['total_pagar'], -2), 0, '.', '') }};

            // Elementos
            const retiroRadio = document.getElementById('retiro');
            const envioRadio = document.getElementById('envio');
            const totalElement = document.getElementById('total');
            const envioCost = 30000; // Coste del envío

            function updateTotal() {
                let finalTotal = baseTotal;
                if (envioRadio.checked) {
                    finalTotal += envioCost;
                }
                totalElement.innerHTML = `TOTAL: ${finalTotal.toLocaleString('es-PY')} Gs`;
            }

            // Event listeners
            retiroRadio.addEventListener('change', updateTotal);
            envioRadio.addEventListener('change', updateTotal);

            // Inicializa el total
            updateTotal();
        });
    </script>


@endsection
