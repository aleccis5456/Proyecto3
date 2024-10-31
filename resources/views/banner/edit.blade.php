@extends('layouts.adm')

@section('tituloAdm', 'Editar Banner')

@section('contenidoAdm')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg dark:bg-gray-800">
        <x-alertas />
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Subir Banner</h2>

            <div class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 p-4 mb-4 rounded">
                <p class="text-sm">* Sugerencia: se recomienda una imagen con relación de aspecto 9:10 para mejor
                    visualización.</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Titulo</label>
                <input value="{{ $banner->titulo == '' ? 'Sin titulo' : '' }}" name="titulo" type="text"
                    id="default-input"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-800 dark:text-white font-medium mb-2" for="banner_image">Imagen del
                    Banner</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    name="banner_image" accept="image/*" aria-describedby="file_input_help" id="file_input" type="file">

            </div>

            <div class="px-6 pb-4 items-center">
                <span>Imagen actual</span>
                <img src="{{ asset("uploads/banners/$banner->imagen") }}" alt="{{ $banner->titulo }}"
                    class="w-32 h-auto rounded-lg">
            </div>


            <div class="flex items-center justify-between mb-6">
                <span class="text-gray-800 dark:text-white font-medium">Activar Banner</span>

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value=" {{ $banner->activo == true ? '0' : '1' }} " class="sr-only peer"
                        name="activo">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>

            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white hover:bg-gray-700 p-2.5 rounded-lg font-semibold transition">
                Subir Banner
            </button>
        </form>
    </div>
@endsection
