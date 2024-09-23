@extends('layouts.app')
@section('titulo', 'Home')

@section('contenido')

    <div class="p-12">
        <div class="relative flex justify-center items-center pb-6">
            <!-- Cinta horizontal -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 h-12 rounded-lg"></div>

            <!-- Texto de la oferta -->
            <h1 class="relative text-white text-2xl md:text-4xl font-bold px-6 md:px-12 pb-2 text-center">
                ¡Ofertas Únicas que No Verás Dos Veces!
            </h1>
        </div>

        <div id="ofertas-carousel" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-6">
            @foreach ($ofertas as $oferta)
                <div
                    class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <a href="{{ route('producto', ['id' => $oferta->id_encriptado]) }}" class="block group">
                        <!-- Imagen del producto -->
                        <div class="relative h-48 md:h-64 bg-gray-200 overflow-hidden">
                            <img src="{{ asset('uploads/productos') }}/{{ $oferta->imagen }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                alt="{{ $oferta->nombre }}">
                            <!-- Badge de oferta -->
                            <div
                                class="absolute top-0 left-0 bg-red-600 text-white px-3 py-1 text-xs font-semibold rounded-br-lg">
                                {{ number_format((($oferta->precio - $oferta->precio_oferta) / $oferta->precio) * 100, 0) }}%
                                OFF
                            </div>
                        </div>

                        <!-- Información del producto -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $oferta->nombre }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                {{ Str::limit($oferta->descripcion, 80) }}
                            </p>
                            <div class="mt-4">
                                <p class="text-sm text-gray-400 line-through">
                                    Antes: {{ number_format($oferta->precio, 0, ',', '.') }} Gs.
                                </p>
                                <div class="mt-2">
                                    <a href="{{ route('carrito.add', ['id' => $oferta->id_encriptado]) }}"
                                        class="items-center text-red-600 rounded-lg py-2.5 hover:px-4 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 hover:text-white">
                                        <span class="text-xl font-bold">Ahora:
                                            {{ number_format(round($oferta->precio_oferta, -2), 0, ',', '.') }}
                                            Gs.</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Botón para ver todas las ofertas -->
    </div>




@endsection
