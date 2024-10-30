<div id="dateModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-800 bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Selecciona el rango de fechas</h2>

            <!-- Formulario de selección de fechas -->
            <form action="{{ route('reporte.pdf') }}" method="get">
                <div class="mb-4">
                    <label for="fecha_desde" class="block text-sm font-medium text-gray-700">Desde</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="fecha_hasta" class="block text-sm font-medium text-gray-700">Hasta</label>
                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="w-full p-2 border rounded">
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end">
                    <button type="button" onclick="toggleModal()"
                        class="text-gray-500 hover:text-gray-700 px-4 py-2">Cancelar</button>
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-600 text-white px-4 py-2 rounded">Exportar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function toggleModal() {
        const modal = document.getElementById('dateModal');
        modal.classList.toggle('hidden');
    }
</script>
