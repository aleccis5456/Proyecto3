<div class="flex items-center justify-center pt-10 bg-gray-100 dark:bg-gray-900">
    <div
        class="w-5/6 mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <div>
                <b>Productos que te podrian interesar</b>
            </div>
        </div>
        <hr>
        <!-- Tabla -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-black dark:black-white">
                <thead class="text-xs text-black uppercase bg-white dark:bg-white dark:text-black">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($similares as $similar)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('producto', ['id' => $similar->id, 'slug' => $similar->slug]) }}">
                                    <img src=" {{ asset('uploads/productos') }}/{{ $similar->imagen }} "
                                        width="200" alt="">
                                </a>
                            </th>                                

                            <td class="">
                                <a href="{{ route('producto', ['id' => $similar->id, 'slug' => $similar->slug]) }}" >
                                    <div class="flex-col">
                                        <div class="pb-10">
                                            <b class="mb-10 text-black"> {{ $similar->nombre }} </b>
                                        </div>
                                        <div class="mb-10">
                                            <p class="text-black">{!! nl2br(e($similar->descripcion)) !!}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td class="">
                                <div class="flex-col">
                                    <div class="flex pb-12 mb-12">
                                        @if ($similar->precio_oferta > 0)
                                            <div class="flex flex-col">
                                                <div class="pt-2">
                                                    <p class="text-gray-500 line-through">precio: <b
                                                            class="ml-auto">{{ number_format($similar->precio, 0, ',', '.') }}
                                                            Gs.</b></p>
                                                </div>
                                                <div>
                                                    <p class="text-blue-500 text-base">precio: <b
                                                            class="ml-auto">{{ number_format($similar->precio_oferta, 0, ',', '.') }}
                                                            Gs.</b></p>
                                                </div>
                                            </div>
                                        @else
                                            <p>precio: <b
                                                    class="ml-auto">{{ number_format($similar->precio, 0, ',', '.') }}
                                                    Gs.</b></p>
                                        @endif

                                    </div>

                                    <div class="mb-10">
                                        <a href="{{ route('carrito.add', [$similar->id]) }}"
                                            class="flex justify-center items-center  text-gray-600 bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-3 me-2">
                                            <b class="text-xs">AGREGAR AL CARRITO</b>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>