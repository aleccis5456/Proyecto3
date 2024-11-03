@extends('layouts.adm')

@section('contenidoAdm')
    <div class="min-h-screen bg-white flex flex-col items-center py-6">
        <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-8">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800">Agregar Producto</h2>
                <div class="px-4 mt-4">
                    <x-alertas />
                </div>
            </div>

            <form method="POST" action="{{ route('producto.agregarSave') }}" enctype="multipart/form-data">
                @csrf

                <!-- Nombre del Producto -->
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-800">Nuevo Producto</label>
                    <input type="text" id="nombre" name="nombre"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese el nombre del producto" />
                </div>

                <!-- Descripción -->
                <div class="mb-5">
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-800">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese la descripción del producto"></textarea>
                </div>

                <!-- Precio -->
                <div class="mb-5">
                    <label for="precio" class="block mb-2 text-sm font-medium text-gray-800">Precio</label>
                    <input type="number" id="precio" name="precio"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese el precio del producto" />
                </div>

                <!-- Stock -->
                <div class="mb-5">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-800">Stock</label>
                    <input type="number" id="stock" name="stock"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800"
                        placeholder="Ingrese el stock disponible" />
                </div>

                <!-- Subcategoría -->
                <div class="mb-5">
                    <label for="subcategoria" class="block mb-2 text-sm font-medium text-gray-800">Subcategoría</label>
                    <select id="subcategoria" name="subcategoria"
                        class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 select2">
                        <option value="" selected>Selecciona una Subcategoría</option>
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Imagen -->
                <div class="mb-5">
                    <label for="imagen" class="block mb-2 text-sm font-medium text-gray-800">Agregar Portada</label>
                    <input
                        class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-gray-800"
                        id="imagen" name="imagen" type="file">
                </div>

                <!-- Botones -->
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Guardar
                    </button>
                    <a href="{{ route('producto.amdIndex') }}"
                        class="w-full text-center text-gray-800 hover:underline py-2 rounded-lg border border-gray-800">
                        Ver Todos los Productos
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('.select2').select2({
                    placeholder: "Selecciona una subcategoría",
                    allowClear: true
                });
            });
        </script>
    @endpush
@endsection
