<x-guest-layout> 
<!-- Cuadro de login -->
    <div class="w-full max-w-md p-10 bg-gray-900/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-blue-500 transform transition-all duration-500 hover:scale-105 hover:shadow-blue-500/70"> 
        <h2 class="text-3xl font-extrabold text-center text-blue-400 mb-8 tracking-wide drop-shadow-lg">Iniciar Sesión</h2>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Correo')" class="text-gray-200"/>
                <x-text-input id="email" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                              type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="ejemplo@correo.com"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>
            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-200"/>
                <x-text-input id="password" class="block mt-2 w-full bg-gray-800 text-white border border-blue-500 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 placeholder-gray-400 transition-all duration-300"
                              type="password" name="password" required autocomplete="current-password" placeholder="Escribe tu contraseña"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>
            <!-- Remember Me -->
            <div class="block mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Recordarme') }}</span>
                </label>
            </div>
            <!-- Buttons -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-blue-400 transition-colors duration-300" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
                <x-primary-button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-blue-500/70 transform hover:scale-105">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
