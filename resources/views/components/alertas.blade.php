<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->

    @if ($errors->any())
        <div id="alerta"
            class="alert flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script>
            setTimeout(function() {
                const alertaSuccess = document.getElementById('alerta');
                if (alertaSuccess) {
                    alertaSuccess.style.transition = 'opacity 0.5s';
                    alertaSuccess.style.opacity = '0';
                    setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    @endif

    <div>
        @if (session('success'))
            <div id="alerta"
                class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <strong>Éxito!</strong> {{ session('success') }}
                </div>
            </div>

            <!-- Script para ocultar la alerta después de 5 segundos -->
            <script>
                setTimeout(function() {
                    const alertaSuccess = document.getElementById('alerta');
                    if (alertaSuccess) {
                        alertaSuccess.style.transition = 'opacity 0.5s';
                        alertaSuccess.style.opacity = '0';
                        setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                    }
                }, 5000); // 5000 milisegundos = 5 segundos
            </script>
        @endif
    </div>


    <div>
        @if (session('warning'))
            <div id="alerta"
                class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <strong>Aviso</strong> {{ session('warning') }}
                </div>
            </div>
        @endif

        <script>
            setTimeout(function() {
                const alertaSuccess = document.getElementById('alerta');
                if (alertaSuccess) {
                    alertaSuccess.style.transition = 'opacity 0.5s';
                    alertaSuccess.style.opacity = '0';
                    setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    </div>


    <div>
        @if (session('info'))
            <div id="alerta"
                class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <strong>Aviso</strong> {{ session('info') }}
                </div>
            </div>
        @endif

        <script>
            setTimeout(function() {
                const alertaSuccess = document.getElementById('alerta');
                if (alertaSuccess) {
                    alertaSuccess.style.transition = 'opacity 0.5s';
                    alertaSuccess.style.opacity = '0';
                    setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    </div>




    <div>
        @if (session('pedido'))
            <div id="alerta"
                class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <strong>Aviso</strong> {{ session('info') }}
                </div>
            </div>
        @endif

        <script>
            setTimeout(function() {
                const alertaSuccess = document.getElementById('alerta');
                if (alertaSuccess) {
                    alertaSuccess.style.transition = 'opacity 0.5s';
                    alertaSuccess.style.opacity = '0';
                    setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    </div>




    <div>
        @if (session('error'))
            <div id="alerta"
                class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <strong>Aviso</strong> {{ session('error') }}
                </div>
            </div>
        @endif

        <script>
            setTimeout(function() {
                const alertaSuccess = document.getElementById('alerta');
                if (alertaSuccess) {
                    alertaSuccess.style.transition = 'opacity 0.5s';
                    alertaSuccess.style.opacity = '0';
                    setTimeout(() => alertaSuccess.remove(), 500); // Remueve el elemento después de la transición
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    </div>



    @if (session('venta'))
        <div id="alerta-modal" tabindex="-1"
            class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeAlert()">
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

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Venta completada</h3>
                        <button onclick="closeAlert()" type="button"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-green-800">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function closeAlert() {
                const modal = document.getElementById('alerta-modal');
                if (modal) {
                    modal.style.transition = 'opacity 0.5s';
                    modal.style.opacity = '0';
                    setTimeout(() => modal.remove(), 500); // Remueve el elemento después de la transición
                }
            }

            // Cierra automáticamente después de 5 segundos
            setTimeout(() => closeAlert(), 3000);
        </script>
    @endif





    @if (session('producto_agregado'))
        <div id="alerta-modal" tabindex="-1" class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-yellow-50 rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeAlert()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-[#fbb321] w-12 h-12 dark:text-green-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25">
                            <circle cx="12.5" cy="12.5" r="11" stroke="currentColor" stroke-width="2" />
                            <path d="M9.5 12.5l2.5 2.5 5-5" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¡Producto agregado al
                            carrito!</h3>
                        <form action="{{ route('carrito.index') }}" method="get">
                            <button type="submit"
                                class="text-gray-800 bg-[#fbb321] hover:bg-yellow-200 hover:text-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-green-800">
                                <div class="flex">
                                    <p class="mt-0.5 font-semibold">Ver carrito</p>                                    
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 2 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                                    </svg>
                                </div>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function closeAlert() {
                const modal = document.getElementById('alerta-modal');
                if (modal) {
                    modal.style.transition = 'opacity 0.5s';
                    modal.style.opacity = '0';
                    setTimeout(() => modal.remove(), 500); // Remueve el elemento después de la transición
                }
            }

            // Cierra automáticamente después de 3 segundos
            setTimeout(() => closeAlert(), 2000);
        </script>
    @endif

</div>
