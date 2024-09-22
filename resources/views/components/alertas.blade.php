<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->

    @if ($errors->any())
        <div id="alerta" class="alert flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
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
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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
            <div id="alerta" class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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
            <div id="alerta" class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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
            <div id="alerta" class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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
            <div id="alerta" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
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


    

</div>
