@extends('layouts.app')
@section('titulo', 'Home')

@section('contenido')


<div class="flex flex-col items-center justify-center text-center">
    @if ($ofertas->isNotEmpty())
        @if (is_null($banner))            
            <div style="background-image: url('{{ asset("src/imgs/bannerA2.webp") }}'); background-position: center top; background-size: cover;"
                class="bg-cover bg-center p-12">
                <div class="relative bg-white/30 backdrop-blur-md rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2">
                        Ofertas de la Semana
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        ¡No te pierdas nuestras mejores ofertas disponibles solo por 48HS!
                    </p>                        
                </div>
                <br><br><br>                                        
        @elseif (!is_null($banner) and $banner->position_id == 1)                              
            <div style="background-image: url('{{ asset("uploads/banners/$banner->imagen") }}'); background-position: center top; background-size: cover;"
                class="bg-cover bg-center p-12 shadow-lg">                    
        @endif

        <div class="flex items-center justify-center">
            <div class="relative max-w-[1380px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($ofertas as $oferta)
                    <div
                        class="relative bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                        <a href="{{ route('producto', ['id' => $oferta->id, 'slug' => $oferta->slug]) }}" class="block group">
                            <!-- Imagen del producto -->
                            <div class="relative w-full bg-gray-200 overflow-hidden">
                                <img src="{{ asset('uploads/productos') }}/{{ $oferta->imagen }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $oferta->nombre }}">
                                <!-- Badge de oferta -->
                                <div
                                    class="absolute top-0 left-0 bg-red-600 text-white px-4 py-1 text-sm font-semibold">
                                    {{ number_format((($oferta->precio - $oferta->precio_oferta) / $oferta->precio) * 100, 0) }}%
                                    OFF
                                </div>
                            </div>

                            <!-- Información del producto -->
                            <div class="pb-6 text-center">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-800 mb-2">
                                    {{ Str::limit($oferta->nombre, 40) }}
                                </h2>                                
                                <div class="mt-4">
                                    <p class="text-sm text-black font-semibold line-through">
                                        Antes: {{ number_format($oferta->precio, 0, ',', '.') }} Gs.
                                    </p>
                                    <div class="mt-2">
                                        <a href="{{ route('carrito.add', ['id' => $oferta->id]) }}"
                                            class="text-xl font-semibold items-center bg-[#fbb321] text-black rounded-lg py-2 px-2">
                                            <span class="">Ahora:
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
        </div>        
    @endif
</div>




    {{-- <div class="p-12 bg-yellow-50" >        
        <div id="ofertas-carousel" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-6">
            @foreach ($ofertas as $oferta)
                <div
                    class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    <a href="{{ route('producto', ['id' => $oferta->id]) }}" class="block group">
                        <!-- Imagen del producto -->
                        <div class="relative md:h-64 bg-gray-200 overflow-hidden">
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
                                    <a href="{{ route('carrito.add', ['id' => $oferta->id]) }}"
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
    </div> --}}




@endsection
