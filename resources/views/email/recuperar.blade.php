@extends('layouts.app')
@section('titulo', 'Ingreso')

@section('contenido')
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto pt-8 w-1/3">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Olvide mi contraseña
                    </h1>

                    <x-alertas />

                    <form class="space-y-4 md:space-y-6" action=" {{ route('recuperar.pass') }} " method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Por favor, ingresa el correo electrónico con el que te registraste para que podamos restablecer tu contraseña.
                            </label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                        </div>

                        <button type="submit"
                            class="w-full text-blue-700 text-sm text-center">
                            Enviar correo de Recuperación</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                            Ya te acuerdas de tu contraseña? 
                                <a href=" {{ route('login') }} "
                                class="font-medium text-primary-600 hover:underline hover:text-blue-600 dark:text-primary-500">Vuelve al
                                login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
