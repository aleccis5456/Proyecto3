@extends('layouts.adm')

@section('contenidoAdm')
    <div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900"> <!-- Contenedor principal centrado -->
        <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <x-alertas />
            <div class="max-w-full flex">
                <div class="w-full">
                    <b>Pedido #{{ $pedido->codigo }} de {{ $pedido->usuario->name }}</b>                    
                    <a href="{{ route('pdf.factura', ['id' => $pedido->id]) }}"
                        class="ml-10 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Generar Factura
                    </a>

                  
                </div>
                <span class="flex mr-10 w-full">
                    <form method="POST" action="{{ route('actualizar.estado') }}">
                        @csrf
                        <div class="flex">
                            <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                            <select id="estado" name="estado"
                                class="w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if ($pedido->estado == 'Recibido')
                                    <option class="text-blue-500 font-bold" selected value="Recibido">Recibido</option>
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
                                    <option class="text-green-500 font-bold" selected value="Finalizado">Finalizado</option>
                                    <option class="text-red-500" value="Anulado">Anulado</option>
                                @elseif($pedido->estado == 'Anulado')
                                    <option class="text-blue-500" value="Recibido">Recibido</option>
                                    <option class="text-yellow-500" value="Procesado">Procesado</option>
                                    <option class="text-orange-500" value="Enviado">Enviado</option>
                                    <option class="text-green-500" value="Finalizado">Finalizado</option>
                                    <option class="text-red-500 font-bold" selected value="Anulado">Anulado</option>
                                @endif
                            </select>
                            <input class="hover:text-blue-700 rounded-lg hover:bg-gray-200 py-1.5 ml-2 px-2 text-sm"
                                type="submit" value="Guardar">
                        </div>
                    </form>
                </span>
                
                <div class="">
                    @if ($pedido->estado == 'Recibido')
                        <button
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 ">
                            Recibido
                        </button>
                    @elseif ($pedido->estado == 'Enviado')
                        <button
                            class="focus:outline-none text-white bg-orange-500 hover:bg-orange-600  font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 ">
                            Enviado
                        </button>
                    @elseif($pedido->estado == 'Procesado')
                        <button
                            class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500  font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 ">
                            Procesado
                        </button>
                    @elseif($pedido->estado == 'Finalizado')
                        <button
                            class="focus:outline-none text-white bg-green-500 hover:bg-green-800  font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 ">
                            Finalizado
                        </button>
                    @elseif($pedido->estado == 'Anulado')
                        <button
                            class="focus:outline-none text-white bg-red-600 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-1 me-2 mb-2 ">
                            Anulado
                        </button>
                    @endif
                </div>
                <div class="">
                    <form action="{{ route('pedidos') }}" method="GET">
                        <button type="submit"
                            class="focus:outline-none text-white bg-blue-500 hover:bg-blue-800  font-medium rounded-lg text-xs px-3 py-1 me-2 mb-2 ">
                            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m15 19-7-7 7-7" />
                            </svg>
                        </button>
                    </form>
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

            <div class="flex justify-center items-center text-center pt-10 max-w-full">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
        <div
            class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
                                        <span class="font-bold">cantidad de pedidos:</span> 's'
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
