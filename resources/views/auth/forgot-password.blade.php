<x-guest-layout>
    <div class="flex flex-col md:flex-row items-center justify-center min-h-screen px-6">
        <!-- Imagen izquierda -->
        <div class="md:w-1/2 flex justify-center mb-8 md:mb-0">
            <img src="{{ asset('imagenes/leoncio2025.png') }}" 
                 alt="Biblioteca" 
                 class="w-80 md:w-[400px]">
        </div>

        <!-- Formulario derecha -->
        <div class="md:w-1/3 bg-white/10 backdrop-blur-lg border border-white/20 p-8 rounded-2xl shadow-xl">
            <h2 class="text-2xl font-bold text-white mb-4 text-center">¿Olvidaste tu contraseña?</h2>
            <p class="text-gray-300 text-sm mb-6 text-center">
                Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.
            </p>

            <!-- Estado de sesión -->
            <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <!-- Botón -->
                <div class="flex justify-center mt-6">
                    <x-primary-button class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg">
                        {{ __('Enviar enlace de recuperación') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
