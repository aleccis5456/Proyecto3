@extends('layouts.vend')

@section('contenidoVend')
    <div class=" flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900"> <!-- Contenedor principal centrado -->
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-alertas />
            <div class="max-w-full flex">
                <div class="mr-10">
                    <p class="text-xl font-semibold">Pedido #{{ $pedido->codigo }}</p>
                    @if ($pedido->estado == 'Finalizado')
                    @else
                        <div class="my-2 flex items-center gap-4">
                            <form method="POST" action="{{ route('vendedores.cambiarestado') }}" class="flex items-center">
                                @csrf
                                <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                                <input type="hidden" name="vendedor_id"
                                    value="{{ Auth::guard('vendedores')->user()->id }}">
                                <select id="estado" name="estado"
                                    class="py-1 px-4 rounded-lg border border-none font-semibold {{ $pedido->estado == 'Recibido' ? 'bg-blue-200 text-blue-600 focus:ring-blue-600' : '' }} {{ $pedido->estado == 'Procesado' ? 'bg-yellow-200 text-yellow-600 focus:ring-yellow-600' : '' }} {{ $pedido->estado == 'Enviado' ? 'bg-orange-200 text-orange-600 focus:ring-orange-600' : '' }} {{ $pedido->estado == 'Finalizado' ? 'bg-green-200 text-green-600 focus:ring-green-600' : '' }} {{ $pedido->estado == 'Anulado' ? 'bg-red-200 text-red-600 focus:ring-red-600' : '' }}">
                                    @foreach (['Recibido', 'Procesado', 'Enviado', 'Finalizado', 'Anulado'] as $estado)
                                        <option value="{{ $estado }}"
                                            {{ $pedido->estado == $estado ? 'selected' : '' }}>
                                            <p>{{ ucfirst($estado) }}</p>
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                    class="ml-2 bg-gray-800 hover:bg-gray-600 text-white font-medium rounded-lg px-4 py-1 transition duration-150">
                                    Guardar
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="max-w-full flex">
                <div class="w-4/5">
                    <b>{{ $cantidad }} de Producto/os en este pedido</b>
                </div>

                <div>
                    <b>Total:
                        {{ $pedido->costoEnvio > 0
                            ? number_format(round($pedido->coste + (int) $pedido->costoEnvio, -2), 0, ',', '.')
                            : number_format(round($pedido->coste, -2), 0, ',', '.') }}
                        Gs.</b>
                </div>
            </div>

            <div class="px-10 w-full flex justify-center items-center text-center pt-10 ">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                    <table class="w-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <b>Codigo</b>
                                </th>
                                <th scope="col" class="px-10 py-3">
                                    <b>producto</b>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <b>Unidades</b>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <b>precio unitario</b>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <b>total</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class=" odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td scope="row" class="px-12 py-4">
                                    @foreach ($producto as $item)
                                        {{ $item->producto->codigo }}<br />
                                    @endforeach
                                </td>
                                <th scope="row" class="px-12 py-4">
                                    @foreach ($producto as $item)
                                        {{ $item->producto->nombre }}<br />
                                    @endforeach
                                </th>
                                <td class="px-12 py-4">
                                    @foreach ($unidades as $unidad)
                                        {{ $unidad }}<br />
                                    @endforeach
                                </td>
                                <td class="px-10 py-4">
                                    @foreach ($producto as $item)
                                        {{ number_format(round($item->precio_unitario, -2), 0, ',', '.') }} Gs.<br />
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format(round($pedido->coste, -2), 0, ',', '.') }} Gs.<br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
        <!-- Contenedor principal centrado -->
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="max-w-full flex justify-between">
                <div class="flex justify-center items-center text-center pt-10 max-w-full">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Datos del cliente</b>
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <b>Datos del pedido</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4">
                                        <span class="font-bold">Nombre y apellido:</span> {{ $datos->nombre }}
                                        {{ $datos->apellido }}
                                        <br><br>
                                        <span class="font-bold">RUC o CI:</span> {{ $datos->ruc_ci }}
                                        <br><br>
                                        <span class="font-bold">celular:</span> {{ $pedido->celular }}
                                        <br><br>
                                        <span class="font-bold">email:</span> {{ $pedido->usuario->email ?? 'invitado' }}
                                        <br><br>
                                        <span class="font-bold">cantidad de pedidos:</span> {{ $pedido->usuario->compras }}

                                        @if (!empty($tercero))
                                            <p class="mb-2 mt-5 text-gray-800 font-bold">Asignado a tercero:</p>
                                            <p><strong>Nombre:</strong> {{ $tercero->nombre }} </p>
                                            <p><strong>RUC o CI:</strong> {{ $tercero->cedula }}</p>
                                            <p><strong>Celular:</strong>
                                                {{ $tercero->telefono ?? 'No se agrego un numero' }}</p>
                                        @endif

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td scope="row" class="px-6 py-4">
                                        <span class="font-bold">Registrado el:</span>
                                        {{ App\Utils\Util::formatearFecha($pedido->registro) }}
                                        <br><br>
                                        <span class="font-bold">Direccion de envio:</span> <br> - Departamento:
                                        {{ $pedido->departamento }}<br />
                                        - Ciudad: {{ $pedido->ciudad }} <br>
                                        - Calle: {{ $pedido->calle }}

                                        <br><br>
                                        <span class="font-bold">Forma de pago:</span> {{ $pedido->formaPago }}
                                        <br><br>
                                        <span class="font-bold">Forma de envio:</span>
                                        {{ $pedido->formaEntrega == 'retiro' ? 'Retiro en local' : 'Envio a domicilio' }}
                                        <br><br>
                                        <span class="font-bold">Total del envio:</span>
                                        {{ number_format(round($pedido->costoEnvio ?? 0, -2), 0, ',', '.') }} Gs.
                                        <br><br>
                                        <span class="font-bold">Total del pedido:</span>
                                        {{ number_format(round($pedido->coste, -2), 0, ',', '.') }} Gs.
                                        <br><br>
                                        <span class="font-bold">Total:</span>
                                        {{ $pedido->costoEnvio > 0
                                            ? number_format(round($pedido->coste + (int) $pedido->costoEnvio, -2), 0, ',', '.')
                                            : number_format(round($pedido->coste, -2), 0, ',', '.') }}
                                        </b>Gs.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
