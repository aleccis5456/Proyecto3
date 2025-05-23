<div class="">
    <form class="max-w-md mx-auto" method="POST" action="{{ route('checkoutSave') }}">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="ruc" id="floating_first_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ $datos->ruc_ci ?? '' }}" />
                <label for="floating_first_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    RUC o Cedula</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="celular" id="floating_last_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ $pedido->celular ?? '' }}" />
                <label for="floating_last_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Celular
                </label>
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nombre" id="floating_last_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ $datos->nombre ?? '' }}" />
                <label for="floating_last_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Nombre
                </label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="apellido" id="floating_last_name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ $datos->apellido ?? '' }}" />
                <label for="floating_last_name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Apellido
                </label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="countries"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                <select id="departamentos" name="depa"
                    class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->name }}"
                            data-ciudades="{{ json_encode($departamento->ciudad) }}">{{ $departamento->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="countries"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                <select id="ciudad" name="ciudad"
                    class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Seleccione una ciudad</option>
                </select>
            </div>


            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="direccion" id="direccion"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" />
                <label for="direccion"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Direccion
                </label>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="email" id="direccion"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="" />
                <label for="direccion"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Email
                </label>
            </div>



            <div class="relative z-0 w-full mb-5 group">
                <label for="pago"
                    class=" text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Elegir Forma de pago
                </label>
                <select id="pago" name="pago"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="null">-Seleccionar-</option>
                    <option value="ef">Efectivo</option>
                    <option value="tc">Tarjeta Credito</option>
                    <option value="td">Tarjeta Debito</option>
                </select>
            </div>
        </div>

        <div class="py-2">
            <div class="py-2">
                <div class="flex items-center mb-4">
                    <input id="retiro" type="radio" value="retiro" name="metodo_envio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="retiro" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Retiro en
                        tienda (Gratis)</label>
                </div>
                <div class="flex items-center">
                    <input id="envio" type="radio" value="envio" name="metodo_envio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="envio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Envio a
                        domicilio (3 - 5 días hábiles) 30.000 Gs</label>
                </div>
                <div class="py-4">
                    <hr>
                </div>
                <button onclick="openModalTerceros(event)"
                    class="ml-[24px] text-gray-800 text-sm font-semibold px-2 py-1 bg-[#fbb321] rounded-lg mt-5 hover:text-black hover:bg-yellow-100">
                    Agregar un tercero
                </button>
                {{-- <label class="inline-flex items-center me-5 cursor-pointer">
                    <input type="checkbox" value="true" name="confirmarTercero" class="sr-only peer" onchange="toggleText(this)">
                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#fbb321]"></div>
                    <span id="toggleText" class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Confirmar?</span>
                </label>                                 --}}
            </div>

            <div class="py-4">
                <hr>
            </div>
            <b id="total">TOTAL:
                {{ number_format(round(App\Utils\Util::stats()['total_pagar'], -2), 0, '.', '.') }}
                Gs </b>
        </div>

        {{-- <button type="submit"
            class="mt-1 text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Confirmar
            Compra
        </button> --}}

        <button type="button" onclick="openModal()"
            class="mt-1 text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
            Confirmar Compra
        </button>
        <p class="text-sm text-gray-500 pt-1">*Por el momento, solo aceptamos pagos en efectivo o con tarjeta
            al
            momento de la entrega</p>
        <p class="text-sm text-gray-500 pt-1">*Puede cancelar su pedido de forma gratuita en cualquier momento
            antes de que sea procesado.</p>
        @include('pedido.includes.tercero')
        @include('pedido.includes.modalConfirmarCompra')

    </form>
</div>


<!-- Botón para abrir el modal (puedes usarlo al confirmar el pedido) -->
{{-- <button onclick="openProcessingModal()" 
    class="mt-1 text-gray-800 font-semibold bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
    Confirmar Pedido
</button> --}}

<!-- Modal -->
<div id="processingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 sm:w-1/3 p-6 text-center">
        <!-- Título -->
        <h2 class="text-lg font-bold text-gray-800 mb-4">Estamos procesando tu pedido</h2>

        <!-- Icono de carga -->
        <div class="flex justify-center items-center mb-4">
            <div class="animate-spin rounded-full h-10 w-10 border-t-4 border-[#fbb321] border-opacity-75"></div>
        </div>

        <!-- Mensaje -->
        <p class="text-gray-600 text-sm">Esto puede tardar unos segundos. Por favor, no cierres esta ventana.</p>
    </div>
</div>




<script>
    function openProcessingModal() {
        document.getElementById('processingModal').classList.remove('hidden');
    }

    function openModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeModalVenta() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }




    $(document).ready(function() {
        // Inicializa select2
        $('.select2').select2({
            placeholder: "Buscar...",
            allowClear: true
        });

        // Limpiar los selectores al cargar la página
        $('#departamentos').val('').trigger('change'); // Restablecer el departamento
        $('#ciudad').empty().append('<option value="">Seleccione una ciudad</option>').trigger(
            'change'); // Limpiar las ciudades

        // Manejar el cambio en el departamento
        $('#departamentos').on('change', function() {
            var ciudades = $(this).find(':selected').data('ciudades');
            var ciudadSelect = $('#ciudad');

            ciudadSelect.empty(); // Limpiar las ciudades anteriores
            ciudadSelect.append(
                '<option value="">Seleccione una ciudad</option>'); // Opción por defecto

            if (ciudades) {
                ciudades.forEach(function(ciudad) {
                    ciudadSelect.append('<option value="' + ciudad.name + '">' + ciudad.name +
                        '</option>');
                });
            }
        });
    });

    function openModalTerceros(event) {
        event.preventDefault();
        document.getElementById('modalTerceros').classList.remove('hidden');
    }

    function closeModalTerceros() {
        document.getElementById('modalTerceros').classList.add('hidden');
    }

    function toggleText(element) {
        const textElement = document.getElementById('toggleText');
        if (element.checked) {
            textElement.textContent = 'Confirmado';
        } else {
            textElement.textContent = 'Confirmar?';
        }
    }
</script>
