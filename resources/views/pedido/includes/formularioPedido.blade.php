<div>
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
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>           
                <select id="departamentos" name="depa"
                    class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                    
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->name }}" data-ciudades="{{ json_encode($departamento->ciudad) }}">{{ $departamento->name }}</option>    
                    @endforeach                                        
                </select>
            </div>
                        
            <div class="relative z-0 w-full mb-5 group">                
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
                <select id="ciudad" name="ciudad"
                    class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                    
                    <option value="">Seleccione una ciudad</option>
                </select>
            </div>
            

            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="direccion" id="direccion"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " value="{{ $pedido->calle ?? '' }}" />
                <label for="direccion"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Direccion
                </label>
            </div>


            <div class="relative z-0 w-full mb-5 group">
                <label for="pago"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">

                </label>
                <select id="pago" name="pago"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <option value="null">Forma de pago</option>
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
            </div>

            <div class="py-4">
                <hr>
            </div>
            <b id="total">TOTAL: {{ number_format(round(App\Utils\Util::stats()['total_pagar'], -2), 0, '.', '.') }}
                Gs </b>
        </div>

        <button type="submit"
            class="mt-1 text-gray-600 bg-[#fbb321] hover:bg-yellow-100 hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirmar
            Compra</button>
        <p class="text-sm text-gray-500 pt-1">*Por el momento, solo aceptamos pagos en efectivo o con tarjeta
            al
            momento de la entrega</p>
        <p class="text-sm text-gray-500 pt-1">*Puede cancelar su pedido de forma gratuita en cualquier momento
            antes de que sea procesado.</p>

    </form>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Buscar...",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Inicializa select2
        $('.select2').select2({
            placeholder: "Buscar...",
            allowClear: true
        });

        // Limpiar los selectores al cargar la página
        $('#departamentos').val('').trigger('change'); // Restablecer el departamento
        $('#ciudad').empty().append('<option value="">Seleccione una ciudad</option>').trigger('change'); // Limpiar las ciudades

        // Manejar el cambio en el departamento
        $('#departamentos').on('change', function() {
            var ciudades = $(this).find(':selected').data('ciudades');
            var ciudadSelect = $('#ciudad');

            ciudadSelect.empty(); // Limpiar las ciudades anteriores
            ciudadSelect.append('<option value="">Seleccione una ciudad</option>'); // Opción por defecto

            if (ciudades) {
                ciudades.forEach(function(ciudad) {
                    ciudadSelect.append('<option value="' + ciudad.name + '">' + ciudad.name + '</option>');
                });
            }
        });
    });
</script>


