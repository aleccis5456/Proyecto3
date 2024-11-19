@extends('layouts.caja')

@section('contenido')
    
<x-alertas/>
<div class="relative overflow-x-auto border border-gray-200 shadow-lg rounded-md">
    <div class="p-4">
        <form action="" method="get">
            <div class="flex items-center">
                <input placeholder="Buscar..." id="search-input" type="text" class="bg-gray-100 h-[35px] border border-gray-100 rounded-lg shadow-md focus:ring-gray-100 focus:border-gray-800">
                <button  class="ml-1 px-2 py-1 bg-gray-800 rounded-lg shadow-md focus:ring-gray-100 focus:border-none">
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 sr-only">
                    imagen
                </th>
                <th scope="col" class="px-6 py-3">
                    codigo
                </th>
                <th scope="col" class="px-6 py-3">
                    Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    stock
                </th>
                <th scope="col" class="px-6 py-3">
                    precio
                </th>
                <th scope="col" class="px-6 py-3 ">
                    Agregar
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $indice => $producto)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 h-[90px] w-[90px]">
                    <img src="{{ asset("uploads/productos/$producto->imagen") }}" alt="" srcset="">
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900  dark:text-white">
                    #{{ $producto->codigo }}
                </th>
                <td class="px-6 py-4">
                    {{ Str::limit($producto->nombre, 30, '...') }}
                </td>
                <td class="px-6 py-4">
                    {{ $producto->stock_actual }}
                </td>
                <td class="px-6 py-4">
                    @if ($producto->precio_oferta != 0)
                        <p class="text-green-500">{{ number_format(round($producto->precio_oferta, -2), 0, ',', '.') }} Gs    </p>
                        {{ number_format(round($producto->precio, -2), 0, ',', '.') }} Gs    
                    @else
                        {{ number_format(round($producto->precio, -2), 0, ',', '.') }} Gs    
                    @endif
                    
                </td>
                <td class="px-6 py-4">                      
                    @php
                    $ventaCaja = collect(session('ventaCaja'));
                @endphp
                
                @if ($ventaCaja->contains('id_producto', $producto->id))
                    <!-- Ícono de producto agregado -->
                    <svg class="w-6 h-6 text-green-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6"/>
                    </svg>
                @else
                    <!-- Enlace para agregar producto -->
                    <a href="{{ route('caja.add', ['id' => $producto->id]) }}">                                                
                        <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>  
                    </a>
                @endif
                          
                </td>
            </tr>             
            @endforeach            
        </tbody>
    </table>
</div>





<script>
    document.getElementById('search-input').addEventListener('input', function() {
        const query = normalizeText(this.value);
        const rows = document.querySelectorAll('#product-table tbody tr');

        rows.forEach(row => {
            const productName = normalizeText(row.querySelector('td:nth-child(3)').textContent);
            const productCode = normalizeText(row.querySelector('th').textContent);
            
            // Mostrar u ocultar la fila dependiendo del match
            if (productName.includes(query) || productCode.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function normalizeText(text) {
        return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/ñ/g, "n").replace(/Ñ/g, "N").toLowerCase();
    }
</script>

@endsection