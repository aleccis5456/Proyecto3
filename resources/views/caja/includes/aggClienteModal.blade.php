<div id="modalUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white w-96 rounded-lg shadow-lg p-6">
        <!-- Título y botón de cerrar -->
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-xl font-semibold">Agregar Cliente</h3>
            <button onclick="cleseModalUser()" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                  </svg>
                  
            </button>
        </div>
        
        <!-- Formulario del modal -->
        <form action="{{ route('caja.addcliente') }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <div class="mt-4">
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" id="apellido" name="apellido" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <div class="mt-4">
                <label for="ruc_ci" class="block text-sm font-medium text-gray-700">RUC o Cédula</label>
                <input type="text" id="ruc_ci" name="ruc_ci" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>            
                        
            <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="mr-3 px-4 py-2 bg-gray-800 hover:bg-gray-400 text-gray-100 rounded-md">Agregar</button>                
            </div>
        </form>
    </div>
</div>


    <script>        
    function openModalUser(event) {
        event.preventDefault();
        document.getElementById('modalUser').classList.remove('hidden');
        }

        function cleseModalUser() {
            document.getElementById('modalUser').classList.add('hidden');
        }   

        $(document).ready(function() {
            $('#cliente').select2({ // Referencia por ID
                placeholder: "Selecciona un cliente",
                allowClear: true
            });
        });
    </script>
    