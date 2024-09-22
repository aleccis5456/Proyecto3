@extends('layouts.app')
@section('titulo', 'Pedido Confirmado')

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
    <dvi class="flex items-center justify-center pt-3">
        <div class="bg-white p-10 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-2xl font-semibold text-center text-green-600">¡Compra Confirmada!</h1>
            <div class="mt-6 text-center">
                <p class="text-gray-700 text-lg">Gracias por tu compra. Hemos recibido tu pedido y estamos procesándolo.</p>
                <div class="mt-4">
                    <h2 class="text-xl font-semibold">Detalles del Pedido</h2>
                    <ul class="list-disc list-inside mt-2 text-left">
                        <li><strong>Codigo de Pedido: </strong>#{{ $pedido->codigo }}</li>
                        <li><strong>Forma de entrega: </strong> {{ $pedido->formaEntrega  == 'retiro' ? 'Retiro en local' : 'Envio a domicilio' }}</li>
                        <li><strong>Fecha: </strong>{{ $pedido->registro }}</li>
                        <li><strong>Método de Pago: </strong>{{ $pedido->formaPago }} </li>
                        <li><strong>Costo del pedido: </strong> {{  number_format(round($pedido->coste, -2), 0, ',', '.') }} Gs.</li>
                        @if ($pedido->costoEnvio > 0)
                            <li><strong>Costo de envio: </strong>{{ number_format(round($pedido->costoEnvio, -2), 0, ',', '.') }} Gs.</li>
                            
                        @else
                            
                        @endif                        
                        {{-- <li><strong>Total:</strong> {{ number_format(round($pedido->coste, -2), 0, ',', '.')}} Gs.</li> --}}
                        <li><b>Total: </b>{{ $pedido->costoEnvio > 0 ? 
                                        number_format(round(($pedido->coste + (int)$pedido->costoEnvio), -2), 0, ',', '.')  : 
                                        number_format(round($pedido->coste, -2), 0, ',', '.')}} Gs.</li>
                    </ul>
                </div>
                <div class="mt-6">
                    <a href="/home" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Volver al
                        Inicio</a>
                </div>
            </div>
        </div>
        </div>
    @endsection
