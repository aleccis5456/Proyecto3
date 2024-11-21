<div class="mx-20 text-2xl font-bold text-gray-600 border-b-2 border-gray-600">
    Fotografía y Filmación
</div>
@if (is_null($banners))
@elseif (!is_null($banners))
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 4)
            @php
                $cantidad = $banners->where('position_id', 4)->where('activo', 1)->count();
            @endphp
            <div class="ml-2 flex pt-1 pl-20 mr-[75px] mx-auto items-stretch"> <!-- Cambiar items-center a items-stretch -->
                @if ($cantidad >= 2)
                    <div id="controls-carousel" class="relative w-full h-64 flex-[4]" data-carousel="static">
                        <!-- Carousel wrapper -->
                        <div class="relative h-full overflow-hidden">
                            @foreach ($banners as $index => $banner)
                                @if ($banner->activo == 1 and $banner->position_id == 4)
                                    <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                                        @if ($banner->producto_id != null or $banner->producto_id != 0)
                                            <a href="{{ route("producto", ['id' => $banner->producto_id]) }}">
                                                <img src="{{ asset("uploads/banners/$banner->imagen") }}"
                                                class="w-full h-full object-cover" alt="...">
                                            </a>                                            
                                        @else
                                            <img src="{{ asset("uploads/banners/$banner->imagen") }}"
                                                class="w-full h-full object-cover" alt="...">
                                        @endif

                                        
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Slider controls -->
                        <button type="button"
                            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 1 1 5l4 4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                @else
                    <div class="h-64 overflow-hidden flex-[4]">
                        @if ($banner->producto_id != null or $banner->producto_id != 0)
                            <a href="{{ route("producto", ['id' => $banner->producto_id]) }}">
                                <img src="{{ asset("uploads/banners/$banner->imagen") }}"
                                    class="w-full h-full object-cover" alt="...">
                            </a>                                            
                        @else
                            <img src="{{ asset("uploads/banners/$banner->imagen") }}" class="w-full h-full object-cover" alt="...">
                        @endif
                    </div>
                @endif

                <!-- Columna del producto -->
                <div class="flex-[1] p-2 rounded-lg text-gray-600 flex flex-col"> <!-- Agregar flex flex-col -->
                    @foreach ($porCategoria['fotoyfil']->reverse() as $producto)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden flex-1">
                            <!-- Agregar flex-1 -->
                            <!-- Imagen del producto -->
                            <a href="{{ route('producto', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="block relative group">
                                <img class="w-full h-36 object-contain group-hover:scale-110 transition-transform duration-300"
                                    src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}"
                                    alt="{{ $producto->nombre }}">
                                <div
                                    class="absolute inset-0 bg-yellow-100 opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                                </div>
                                <div
                                    class="font-bold absolute bottom-0 left-0 text-yellow-400 right-0 text-center bg-gray-300 text-white py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    Ver producto
                                </div>
                            </a>

                            <!-- Detalles del producto -->
                            <div class="p-2.5 text-center">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ Str::limit($producto->nombre, 23) }}
                                </h3>
                                <div class="mt-4">
                                    <a href="{{ route('carrito.add', ['id' => $producto->id]) }}"
                                        class="flex items-center justify-between text-gray-600 rounded-lg py-2.5 hover:px-1 hover:bg-yellow-100 hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        <span
                                            class="text-lg font-bold">{{ number_format(round($producto->precio, -2), 0, ',', '.') }}
                                            Gs.</span>
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @break
                    @endforeach
                </div>
            </div>
            @break
        @endif
    @endforeach
@endif



<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-2 px-10 pb-10 mx-12">
    @php $contador = 0; @endphp
    @foreach ($porCategoria['fotoyfil'] as $producto)
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            <!-- Imagen del producto -->
            <a href="{{ route('producto', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="block relative group">
                <img class="w-full h-48 object-contain group-hover:scale-110 transition-transform duration-300"
                    src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <div
                    class="absolute inset-0 bg-yellow-100 opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                </div>
                <div
                    class="font-bold text-yellow-400 absolute bottom-0 left-0 right-0 text-center bg-gray-300 text-white py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Ver producto
                </div>
            </a>

            <!-- Detalles del producto -->
            <div class="p-6 text-center">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ Str::limit($producto->nombre, 38) }}
                    <div class="mt-4">
                        <a href="{{ route('carrito.add', ['id' => $producto->id]) }}"
                            class="flex items-center justify-between text-gray-600 rounded-lg py-2.5 hover:px-1 hover:bg-yellow-100 hover:text-black focus:outline-none focus:ring-4 focus:ring-yellow-300">
                            <span
                                class="text-lg font-bold">{{ number_format(round($producto->precio, -2), 0, ',', '.') }}
                                Gs.</span>
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                        </a>
                    </div>
            </div>
        </div>
        @php $contador++ @endphp
        @if ($contador == 5)
            @break
        @endif
    @endforeach
</div>
