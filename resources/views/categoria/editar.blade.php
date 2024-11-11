@extends('layouts.adm')

@section('tituloAdm', 'Agregar Categoria')

@section('contenidoAdm')
    <div class="">
        <!-- Formulario -->
        <div class="p-4">
            <form class="max-w-sm mx-auto" method="POST" action="{{ route('editarSave') }}" enctype="multipart/form-data">
                <br><br><br><br>
                @csrf
                <div class="">
                    <x-alertas />
                </div>
                <input type="hidden" name="categoria_id" value="{{$categoria->id}}">
                <div class="mb-6">
                    <b class="text-2xl text-gray-900 dark:text-white">Editar Categoria: {{ $categoria->nombre }}</b>
                </div>
                <div class="mb-5">
                    <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Categoria</label>
                    <input type="text" id="categoria" name="categoria"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div class="pb-10">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Cargar Imagen</label>
                <input name="imagen" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">    
                </div>
                

                <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar Cambios</button>
            </form>
        </div>        
    </div>

    @endsection
