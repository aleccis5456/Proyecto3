@extends('layouts.app')
@section('titulo', 'productos')
@section('contenido')
    <div class="flex items-center justify-center p-10 ">
        <div class="w-2/3 px-10">
            <div class=" text-2xl">
                @if ($producto->precio_oferta > 0)
                    <b class="text-[#fbb321]">{{ $producto->nombre }}</b>
                @else
                    <b class="text-gray-600">{{ $producto->nombre }}</b>
                @endif

            </div>
            <div class="pb-10 text-xs text-gray-400">
                <b>codigo: {{ $producto->codigo }}</b>
            </div>
            <x-alertas />
            <div id="default-carousel" class="relative w-full" data-carousel="active">
                <div class="relative h-full overflow-hidden rounded-lg md:h-96">
                    <div class="hidden duration-1700 " data-carousel-item>
                        <img src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}" width="400"
                            class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    @foreach ($fotos as $foto)
                        <div class="hidden duration-1700" data-carousel-item>
                            <img src="{{ asset('uploads/productos') }}/{{ $foto->nombre }}" width="500"
                                class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    @endforeach

                </div>
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button style="border: 1px solid #fbb321;" type="button" class="w-11 h-11 " aria-current="true"
                        aria-label="Slide 1" data-carousel-slide-to="0">
                        <img src="{{ asset('uploads/productos') }}/{{ $producto->imagen }}" alt="">
                    </button>
                    @foreach ($fotos as $foto)
                        <button style="border: 1px solid #fbb321;" type="button" class="w-11 h-11" aria-current="true"
                            aria-label="Slide 1" data-carousel-slide-to="0">
                            <img src="{{ asset('uploads/productos') }}/{{ $foto->nombre }}" alt=""></button>
                    @endforeach
                </div>

                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/30 dark:bg-gray-800/30 group-hover:bg-black/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="flex-col w-1/3">
            @if ($producto->precio_oferta > 0)
                <div class="mb-2 text-xl">
                    <!-- Precio antiguo -->
                    <div class="relative">
                        <span class="absolute left-0 top-1/2 transform -translate-y-1/2 text-gray-500 line-through text-lg">
                            {{ number_format($producto->precio, 0, ',', '.') }} Gs.
                        </span>
                    </div>
                    <!-- Precio en oferta -->
                    <b class="text-red-600 text-2xl">{{ number_format($producto->precio_oferta, 0, ',', '.') }} Gs.</b>
                </div>
            @else
                <div class="mb-2 text-xl">
                    <b class="ml-auto">{{ number_format($producto->precio, 0, ',', '.') }} Gs.</b>
                </div>
            @endif

            <div class="mb-8">
                @if ($producto->stock_actual >= 1)
                    <button type="button"
                        class="focus:outline-none text-white bg-gray-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <b>EN STOCK</b>
                    </button>
                    <p>solo queda <b>{{ $producto->stock_actual }}</b></p>
                @else
                    <button type="button"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2 mb-2 dark:focus:ring-yellow-900">
                        <b>SIN STOCK</b>
                        <p></p>
                    </button>
                @endif
            </div>

            <div class=" p-2">
                <div class="">
                    <p>{!! nl2br(e($producto->descripcion)) !!}</p>
                </div>
            </div>

            <div class="mt-5 text-center">
                <a href="{{ route('carrito.add', ['id' => $producto->id]) }}"
                    class="flex items-center justify-center w-full text-gray-600 bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <b>AGREGAR AL CARRITO</b>
                </a>
            </div>
            @if ($producto->precio_oferta > 0)
                <p class="text-gray-500 text-sm pt-2 mr-3">*Las ofertas solo esta disponibles en precio al contado</p>
            @else
            <form class="mt-5 text-center" method="POST" action="{{ route('carrito.addCuota', ['producto_id' => $producto->id]) }}">
                @csrf
                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <div class="flex items-center space-x-2">
                    <select id="cuotas" name="cuotas"
                        class="font-bold bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="3">3x {{ number_format(round($producto->precio / 3 + 30000, -2), 0, ',', '.') }} Gs.</option>
                        <option value="6">6x {{ number_format(round($producto->precio / 6 + 60000, -2), 0, ',', '.') }} Gs.</option>
                        <option selected value="12">12x {{ number_format(round($producto->precio / 12 + 120000, -2), 0, ',', '.') }} Gs.</option>
                        <option value="18">18x {{ number_format(round($producto->precio / 18 + 110000, -2), 0, ',', '.') }} Gs.</option>
                    </select>
                    <button type="submit" class="hover:text-black bg-[#fbb321] hover:bg-yellow-100 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-6 h-6 text-gray-600 hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                    </button>
                </div>
            </form>            
            @endif
        </div>
    </div>

    <!-- Productos similares -->
   @include("producto.includes.productosSimilares")
@endsection
