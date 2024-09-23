@if ($ofertas->isNotEmpty())
    <div class="p-12 ">
        <div class="relative flex justify-center items-center pb-6">
            <!-- Cinta horizontal -->
            <div class="absolute inset-0 bg-blue-600 h-12 rounded-lg"></div>

            <!-- Texto de la oferta -->
            <h1 class="relative text-white text-2xl md:text-4xl font-bold px-6 md:px-12 pb-2 text-center">
                ¡Ofertas Únicas que No Verás Dos Veces!
            </h1>
        </div>

        <div id="default-carousel" class="relative w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
            data-carousel="slide">
            @php
                $contador = '';
            @endphp
            @foreach ($ofertas as $oferta)
                <div
                    class="relative bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 overflow-hidden">
                    <a href="{{ route('producto', ['id' => $oferta->id_encriptado]) }}" class="block group">
                        <!-- Imagen del producto -->
                        <div class="relative h-64 w-full bg-gray-200 overflow-hidden">
                            <img src="{{ asset('uploads/productos') }}/{{ $oferta->imagen }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                alt="{{ $oferta->nombre }}">
                            <!-- Badge de oferta -->
                            <div class="absolute top-0 left-0 bg-red-600 text-white px-4 py-1 text-sm font-semibold">
                                {{ number_format((($oferta->precio - $oferta->precio_oferta) / $oferta->precio) * 100, 0) }}%
                                OFF
                            </div>
                        </div>

                        <!-- Información del producto -->
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-800 mb-2">{{ $oferta->nombre }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-500">
                                {{ Str::limit($oferta->descripcion, 100) }}
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
                    class="inline-block px-8 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:from-red-600 hover:to-pink-600">
                    Ver todas las ofertas
                </a>
            @endif
        </div>

    </div>

    <div class="relative py-10">
        <!-- Cinta horizontal -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-blue-600 h-12 transform -skew-y-2 w-full"></div>
        </div>

        <!-- Texto con cinta -->
        <p class="relative text-white text-3xl font-bold text-center px-4">
            Algunos de nuestros productos
        </p>
    </div>
@endif
