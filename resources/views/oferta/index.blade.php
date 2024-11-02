@extends('layouts.adm')

@section('contenidoAdm')
    @if (is_null($productos))
    @else
        <div class="relative overflow-x-auto px-20 pt-10">            
            <x-alertas />
            <div class="flex">
                <div class="p-5 font-bold text-gray-700 text-xl">
                    Lista de productos con ofertas
                </div>
                <div class="p-5">
                    <a onclick="return confirm('Estas quitar todas las ofertas?')"
                        href="{{ route('oferta.quitarTodos', ['estado' => 0]) }}"
                        class="text-white bg-gray-800 hover:bg-gray-600 focus:outline-none focus:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Eliminar todas la ofertas
                        </button>
                    </a>
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            precio normal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            precion oferta
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-200">
                            modificar precio oferta
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-200">
                            visualizacion de la oferta
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-200">
                            visualizacion del producto
                        </th>
                        <th class="bg-gray-200"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <form action="{{ route('oferta.editar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $producto->nombre }}
                            </th>
                            <td class="px-2 py-4">
                                {{ number_format(round($producto->precio, -2), 0, ',', '.') }} Gs.
                            </td>
                            <td class="px-2 py-4">
                                {{ number_format(round($producto->precio_oferta, -2), 0, ',', '.') }} Gs.
                            </td>
                            <td class="px-2 py-4 bg-gray-100">
                                <input name="precio_oferta" type="number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                            </td>
                            <td class="px-6 py-4 bg-gray-100">
                                <div class="flex items-center mb-4">
                                    <input {{ $producto->oferta == 1 ? 'checked' : '' }} id="estado-activado-{{ $producto->id }}"
                                        type="radio" value="1" name="estado"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="estado-activado-{{ $producto->id }}"
                                        class="ms-2 text-sm font-medium text-gray-900">Activado</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ $producto->oferta == 0 ? 'checked' : '' }} id="estado-desactivado-{{ $producto->id }}"
                                        type="radio" value="0" name="estado"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="estado-desactivado-{{ $producto->id }}"
                                        class="ms-2 text-sm font-medium text-gray-900">Desactivado</label>
                                </div>
                            </td>
                            <td class="px-2 py-4 bg-gray-100">
                                <div class="flex items-center mb-4">
                                    <input {{ $producto->visible == 'si' ? 'checked' : '' }} id="visible-{{ $producto->id }}"
                                        type="radio" value="si" name="visible"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="visible-{{ $producto->id }}"
                                        class="ms-2 text-sm font-medium text-gray-900">Visible</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ $producto->visible == 'no' ? 'checked' : '' }} id="no-visible-{{ $producto->id }}"
                                        type="radio" value="no" name="visible"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    <label for="no-visible-{{ $producto->id }}"
                                        class="ms-2 text-sm font-medium text-gray-900">No visible</label>
                                </div>
                            </td>
                            <td class="bg-gray-100">
                                <button type="submit"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                    Guardar
                                </button>
                            </td>
                        </tr>
                    </form>
                @endforeach
                
                </tbody>
            </table>
        </div>
    @endsection

@endif
