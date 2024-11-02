<div>
    @if ($ofertas->isNotEmpty())
        @if (is_null($banner))            
                <div style="background-image: url('{{ asset("src/imgs/bannerA2.webp") }}'); background-position: center top; background-size: cover;"
                    class="bg-cover bg-center p-12 shadow-lg">
                    <div class="relative bg-white/30 backdrop-blur-md rounded-xl shadow-lg p-6 mx-auto  text-center">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2">
                            Ofertas de la Semana
                        </h2>
                        <p class="text-gray-700 dark:text-gray-300">
                            ¡No te pierdas nuestras mejores ofertas disponibles solo por esta semana!
                        </p>                        
                    </div>
                    
                    <br><br><br>                                        
            @elseif (!is_null($banner) and $banner->position_id == 1)
                <div style="background-image: url('{{ asset("uploads/banners/$banner->imagen") }}'); background-position: center top; background-size: cover;"
                    class="bg-cover bg-center p-12  shadow-lg">
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        @endif
        <div class="px-12">
            <div id="default-carousel" class="relative w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                data-carousel="slide">
                @php
                    $contador = '';
                @endphp
                @foreach ($ofertas as $oferta)
                    <div
                        class="relative bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                        <a href="{{ route('producto', ['id' => $oferta->id]) }}" class="block group">
                            <!-- Imagen del producto -->
                            <div class="relative  w-full bg-gray-200 overflow-hidden">
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
                            <div class="p-6">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-800 mb-2">
                                    {{ Str::limit($oferta->nombre, 64) }}
                                </h2>                                
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
                    @php
                        $contador++;
                        if ($contador == 3) {
                            break;
                        }
                    @endphp
                @endforeach
            </div>
            <!-- Botón para ver todas las ofertas -->
            <div class="pt-10 text-center">
                @if (count($ofertas) > 3)
                    <a href="{{ route('oferta.todos') }}"
                        class="inline-block px-16 py-3 text-black font-semibold rounded-full shadow-lg bg-white bg-opacity-20 backdrop-blur-md hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-opacity-30 hover:from-white hover:to-white"
                        style="background: rgba(255, 255, 255, 0.2);">
                        Ver todas las ofertas
                    </a>
                @endif
            </div>
            

        </div>
        
    @endif
</div>
</div>
