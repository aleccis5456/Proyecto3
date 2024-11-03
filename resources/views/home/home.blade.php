@extends('layouts.app')
@section('titulo', 'Home')

@section('contenido')
    <div class="text-center items-center justify-center">
        <x-mostrar-ofertas/>
    </div>

    {{-- banner mid --}}
    @include('home.includes.bannerMid')
    
    <div class="mx-10">
        <div class="text-center items-center justify-center px-10 py-5">
            <x-alertas />
        </div>
        
        <div class="mx-20 text-2xl font-bold text-gray-600 border-b-2 border-gray-600">
            Algunos de nuestros productos
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 p-10 mx-12">                    
            @foreach ($productos as $producto)
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
                            {{Str::limit($producto->nombre, 54)}}
                        <div class="mt-4">
                            <a href="{{ route('carrito.add', ['id' => $producto->id]) }}"
                                class="flex items-center justify-between text-gray-600 rounded-lg py-2.5 hover:px-1 hover:bg-yellow-100 focus:outline-none focus:ring-4 focus:ring-yellow-300 hover:text-black">
                                <span
                                    class="text-xl font-bold hover:text-black">{{ number_format(round($producto->precio, -2), 0, ',', '.') }}
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
            @endforeach                        
        </div>  
        {{-- banner bottom--}}
        @include('home.includes.bannerBottom')        
        {{-- productos por categorias --}}
        @include('home.includes.camarasyFilmadoras')                
        @include('home.includes.electronica')
        @include('home.includes.informatica')
        {{-- imagen antes del footer --}}
        <div class="px-20">
            <img class="rounded-lg" src="{{asset('uploads/images/banner-bancos.webp')}}" alt="">
        </div>  
    </div>
@endsection
