@extends('layouts.app')
@section('titulo', 'Checkout')

@section('contenido')
    <div class="flex justify-center items-center ">
        <ol class="flex items-center w-1/2 pt-3">
            <li
                class="flex w-full items-center text-blue-600 dark:text-blue-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-500 after:border-4 after:inline-block dark:after:border-blue-800">
                <span
                    class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-full lg:h-12 lg:w-12 dark:bg-blue-800 shrink-0">
                    <svg class="w-3.5 h-3.5 text-blue-100 lg:w-4 lg:h-4 dark:text-blue-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5.917 5.724 10.5 15 1.5" />
                    </svg>
                </span>
            </li>
            <li
                class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700">
                <span
                    class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                    <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5 dark:text-gray-100" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                    </svg>
                </span>
            </li>
            <li class="flex items-center">
                <span
                    class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                    <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5 dark:text-gray-100" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                    </svg>
                </span>
            </li>
        </ol>
    </div>

    <div class="flex  pt-5">
        <div class="w-2/3">
            <p class="text-2xl px-10 font-bold text-center">Finalizar el pedido</p>
            @if (!Auth::user())
                <form class="max-w-sm mx-auto pt-5" method="POST" action=" {{ route('check.login') }} ">
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
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ingresar</button>

                    <p class="text-sm text-gray-500 pt-2">Si tenes una cuenta ingresa o continua como invitado</p>
                </form>
            @endif

            <div class="pt-6 pb-6">
                <hr>
                <p class="text-sm text-blue-500 text-center">Datos para la fatura</p>
            </div>

            <div>
                <form class="max-w-md mx-auto" method="POST" action="{{ route('checkoutSave') }}">
                    @csrf
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="ruc" id="floating_first_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $datos->ruc_ci ?? ''}}" />
                            <label for="floating_first_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                RUC o Cedula</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="celular" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" "  value="{{ $pedido->celular ?? '' }}"/>
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Celular
                            </label>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="nombre" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $datos->nombre ?? ''}}" />
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Nombre
                            </label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="apellido" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $datos->nombre ?? ''}}" />
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Apellido
                            </label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="depa" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $pedido->departamento ?? '' }}" />
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Departamento
                            </label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="ciudad" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $pedido->ciudad ?? '' }}" />
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Ciudad
                            </label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="direccion" id="direccion"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " value="{{ $pedido->calle ?? '' }}" />
                            <label for="direccion"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Direccion
                            </label>
                        </div>


                        <div class="relative z-0 w-full mb-5 group">
                            <label for="pago"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">

                            </label>
                            <select id="pago" name="pago"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option value="null">Forma de pago</option>
                                <option value="ef">Efectivo</option>
                                <option value="tc">Tarjeta Credito</option>
                                <option value="td">Tarjeta Debito</option>
                            </select>
                        </div>
                    </div>

                    <div class="py-2">
                        <div class="py-2">
                            <div class="flex items-center mb-4">
                                <input id="retiro" type="radio" value="retiro" name="metodo_envio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="retiro"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Retiro en tienda (Gratis)</label>
                            </div>
                            <div class="flex items-center">
                                <input id="envio" type="radio" value="envio" name="metodo_envio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="envio"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Envio a domicilio (3 - 5 días hábiles) 30.000 Gs</label>
                            </div>
                        </div>
                    
                        <div class="py-4">
                            <hr>
                        </div>
                        <b id="total">TOTAL: {{ number_format(round(App\Utils\Util::stats()['total_pagar'], -2), 0, '.', '.') }} Gs </b>
                    </div>
                    
                    <button type="submit"
                        class="mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar
                        Compra</button>
                    <p class="text-sm text-gray-500 pt-1">*Por el momento, solo aceptamos pagos en efectivo o con tarjeta
                        al
                        momento de la entrega</p>
                    <p class="text-sm text-gray-500 pt-1">*Puede cancelar su pedido de forma gratuita en cualquier momento
                        antes de que sea procesado.</p>

                </form>
            </div>
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
                            <td>
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
                totalElement.innerHTML = `TOTAL: ${finalTotal.toLocaleString('es-PE')} Gs`;
            }
        
            // Event listeners
            retiroRadio.addEventListener('change', updateTotal);
            envioRadio.addEventListener('change', updateTotal);
        
            // Inicializa el total
            updateTotal();
        });
        </script>
        

@endsection
