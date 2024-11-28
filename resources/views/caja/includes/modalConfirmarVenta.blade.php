<div id="ventaModal" tabindex="-1"
class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="relative p-4 w-full max-w-lg">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                onclick="closeVentaModal()">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Cerrar</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6" />
                </svg>

                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Confirmar Venta</h3>
                <div style="display: flex; gap: 10px; justify-content: center; align-items: center; margin-top: 20px;">
                    <!-- Botón de cerrar -->
                    <button onclick="closeVentaModal()" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 flex items-center justify-center gap-2 dark:focus:ring-green-800">
                        Cancelar
                        <div class="px-1 py-2 bg-red-400 rounded-full">
                            <svg class="w-6 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                              </svg>
                        </div>
                        
                          
                    </button>                    
                    <!-- Botón de imprimir -->
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 flex items-center justify-center gap-2 dark:focus:ring-green-800">
                        Confirmar Venta
                        <div class="px-1 py-2 bg-blue-400 rounded-full">
                            <svg class="w-6 h-4 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.5 12A2.5 2.5 0 0 1 21 9.5V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2.5a2.5 2.5 0 0 1 0 5V17a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2.5a2.5 2.5 0 0 1-2.5-2.5Z" />
                        </svg>                        
                        </div>
                        
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
     function openVentaModal(event) {
event.preventDefault();
document.getElementById('ventaModal').classList.remove('hidden');
}

function closeVentaModal() {
    document.getElementById('ventaModal').classList.add('hidden');
}   

    function closeAlert() {
        const modal = document.getElementById('alerta-modal');
        if (modal) {                    
            modal.style.opacity = '0';        
        }
    }
</script>