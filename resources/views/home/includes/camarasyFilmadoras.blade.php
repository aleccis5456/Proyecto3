<div class="mx-20 text-2xl font-bold text-blue-600 border-b-2 border-blue-600">
    Fotografía y Filmación
</div>
@if (is_null($banners))
@elseif (!is_null($banners))
    @foreach ($banners as $banner)
        @if ($banner->activo == 1 and $banner->position_id == 4)
            <div class="flex pt-1 px-20 mx-auto items-stretch"> <!-- Cambiar items-center a items-stretch -->
                <!-- Columna de la imagen -->
                @if ($banner->imagen == '1730414905.webp')                    
                    <div class="h-64 overflow-hidden flex-[4]"> 
                        <a href="">
                            <img class="w-full h-full object-cover" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                        </a>                        
                    </div>
                @else
                    <div class="h-64 overflow-hidden flex-[4]"> 
                        <img class="w-full h-full object-cover" src="{{ asset("uploads/banners/$banner->imagen") }}" alt="">
                    </div>
                @endif
            
                <!-- Columna del producto -->
                <div class="flex-[1] p-2 rounded-lg text-blue-600 flex flex-col"> <!-- Agregar flex flex-col -->
                    @foreach ($porCategoria['fotoyfil']->reverse() as $producto)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden flex-1"> <!-- Agregar flex-1 -->
                            <!-- Imagen del producto -->
                            <a href="{{ route('producto', ['id' => $producto->id_encriptado]) }}" class="block relative group">
                                <img class="w-full h-36 object-contain group-hover:scale-110 transition-transform duration-300"
                                    src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                                <div class="absolute inset-0 bg-blue-700 opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-0 right-0 text-center bg-blue-700 text-white py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    Ver producto
                                </div>
                            </a>
            
                            <!-- Detalles del producto -->
                            <div class="p-2.5 text-center">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ Str::limit($producto->nombre, 20) }}
                                </h3>
                                <div class="mt-4">
                                    <a href="{{ route('carrito.add', ['id' => $producto->id_encriptado]) }}"
                                        class="flex items-center justify-between text-blue-600 rounded-lg py-2.5 hover:px-1 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 hover:text-white">
                                        <span class="text-lg font-bold">{{ number_format(round($producto->precio, -2), 0, ',', '.') }} Gs.</span>
                                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
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



<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-2 p-10 mx-12">
    @php $contador = 0; @endphp
    @foreach ($porCategoria['fotoyfil'] as $producto)
        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
            <!-- Imagen del producto -->
            <a href="{{ route('producto', ['id' => $producto->id_encriptado]) }}" class="block relative group">
                <img class="w-full h-48 object-contain group-hover:scale-110 transition-transform duration-300"
                    src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <div
                    class="absolute inset-0 bg-blue-700 opacity-0 group-hover:opacity-50 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 right-0 text-center bg-blue-700 text-white py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    Ver producto
                </div>
            </a>

            <!-- Detalles del producto -->
            <div class="p-6 text-center">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                    {{ Str::limit($producto->nombre, 38) }}
                    <div class="mt-4">
                        <a href="{{ route('carrito.add', ['id' => $producto->id_encriptado]) }}"
                            class="flex items-center justify-between text-blue-600 rounded-lg py-2.5 hover:px-1 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 hover:text-white">
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
