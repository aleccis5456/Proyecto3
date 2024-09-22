@extends('layouts.app')
@section('titulo', 'Ingreso')

@section('contenido')
    
    <form class="max-w-sm mx-auto pt-10" method="POST" action=" {{ route('loginSave') }} " >
        
        <h1 class=" text-4xl font-semibold text-gray-900 dark:text-white pb-9">Ingresar</h1>

        <div class="">
            <x-alertas />
        </div>
        @csrf
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
            <input type="password" id="password" name="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>        
        <button type="submit"
            class="mr-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ingresar</button>
            <span class="text-sm text-gray-500">
                Olvidate tu Contraseña?<span class="hover:underline hover:text-blue-600"> <a href="{{ route('forgot.pass') }}">Haz clic aqui</a></span>
            </span>
    </form>

@endsection
