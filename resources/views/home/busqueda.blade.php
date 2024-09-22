@extends('layouts.app')
@section('titulo', 'Resultados de Búsqueda')

@section('contenido')
    <div class="text-center px-10 py-6">
        <x-alertas />
    </div>

    <div class="flex items-center justify-center ">
        <div
            class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Resultados para: <b>{{ $b }}</b> <span
                        class="text-sm text-gray-400">({{ count($productos) }})</span>
                </h2>
            </div>

            <!-- Tabla de Productos -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-black dark:text-white">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3 w-auto"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $similar)
                            <tr
                                class="bg-gray-100 dark:bg-gray-900 border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300">
                                <!-- Imagen del Producto -->
                                <td class="px-2 py-4 w-1/4">
                                    <a href="{{ route('producto', ['id' => $similar->id]) }}">
                                        <img class="w-48 h-48 object-cover rounded-lg hover:scale-105 transition-transform duration-300"
                                            src="{{ asset('uploads/productos') }}/{{ $similar->imagen }}"
                                            alt="{{ $similar->nombre }}">
                                    </a>
                                </td>

                                <!-- Detalles del Producto -->
                                <td class="px-2 py-4 ">
                                    <a href="{{ route('producto', ['id' => $similar->id]) }}"
                                        class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $similar->nombre }}
                                    </a>
                                    <p class="mt-2 text-gray-700 dark:text-gray-400">
                                        {!! nl2br(e($similar->descripcion)) !!}
                                    </p>
                                </td>

                                <!-- Precio del Producto -->
                                <td class="ml-6 py-4 w-1/6">
                                    @if ($similar->precio_oferta > 0)
                                        <div class="text-gray-500 line-through">Precio:
                                            <b>{{ number_format($similar->precio, 0, ',', '.') }} Gs.</b></div>
                                        <div class="text-blue-500">Oferta:
                                            <b>{{ number_format($similar->precio_oferta, 0, ',', '.') }} Gs.</b></div>
                                    @else
                                        <div>Precio: <b>{{ number_format($similar->precio, 0, ',', '.') }} Gs.</b></div>
                                    @endif
                                    <div class="mt-4">
                                        <form action="{{ route('carrito.add', ['id' => $similar->id]) }}" method="get">
                                            <button 
                                                class="text-sm bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
