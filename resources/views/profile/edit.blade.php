@extends('layouts.old_app') {{-- tu layout con menú lateral --}}
@section('titulo-navbar', '✏️ Editar Perfil') 
@section('subtitulo-navbar', 'Actualiza tu información personal y contraseña')
@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Mensaje de éxito --}}
    @if(session('status') == 'profile-updated')
        <div class="bg-green-500 text-black p-3 rounded-lg shadow-md mb-4 text-center font-semibold">
            Perfil actualizado correctamente.
        </div>
    @endif

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded-lg shadow-md mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <div class="bg-gray-900 p-8 rounded-3xl border-2 border-white/70 shadow-[0_0_15px_#ffffff60] text-white">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            @method('PATCH')

            {{-- Columna izquierda: Avatar --}}
            <div class="flex flex-col items-center justify-center space-y-4">
                <img id="avatarPreview"
                       src="{{ $user->avatar ? Storage::url('avatars/' . $user->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=160&d=retro' }}"

                alt="Avatar"
                     class="w-40 h-40 rounded-full border-2 border-yellow-400 shadow-md object-cover">

                <input type="file" name="avatar" id="avatar" accept="image/*"
                       class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-yellow-400 file:text-gray-900
                              hover:file:bg-yellow-500 cursor-pointer">

                @error('avatar')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Columna derecha: Datos --}}
            <div class="space-y-6">
                {{-- Nombre --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-blue-200 mb-3">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-600"> 
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-blue-200 mb-3 ">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-600"> 
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña nueva --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-blue-200 mb-3">Nueva Contraseña</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" 
                               class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-600 pr-12"> 
                        <button type="button" id="togglePassword" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                 class="w-5 h-5" id="iconPasswordOpen">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                 class="w-5 h-5 hidden" id="iconPasswordClosed">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a10.05 10.05 0 012.293-3.644M6.34 6.34a9.969 9.969 0 015.66-1.66c4.478 0 8.269 2.943 9.543 7a9.964 9.964 0 01-1.661 3.666M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-blue-200 mb-3">Confirmar Contraseña</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-600 pr-12"> 
                        <button type="button" id="togglePasswordConfirmation" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                 class="w-5 h-5" id="iconPasswordConfirmationOpen">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                 class="w-5 h-5 hidden" id="iconPasswordConfirmationClosed">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a10.05 10.05 0 012.293-3.644M6.34 6.34a9.969 9.969 0 015.66-1.66c4.478 0 8.269 2.943 9.543 7a9.964 9.964 0 01-1.661 3.666M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Botón --}}
                <div class="flex justify-center pt-6">
                    <button type="submit"
                        class="inline-flex items-center gap-3 bg-yellow-400 border-2 border-yellow-500 text-gray-900 font-bold px-8 py-3 rounded-lg shadow-md hover:bg-yellow-500 hover:border-yellow-600 hover:shadow-xl transform hover:scale-105 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        Actualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script Avatar Preview --}}
<script>
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');

    avatarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>

{{-- Script toggle contraseñas --}}
<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const iconOpen = document.getElementById('iconPasswordOpen');
    const iconClosed = document.getElementById('iconPasswordClosed');

    togglePassword.addEventListener('click', () => {
        const isPassword = password.type === 'password';
        password.type = isPassword ? 'text' : 'password';
        iconOpen.classList.toggle('hidden');
        iconClosed.classList.toggle('hidden');
    });

    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const iconConfOpen = document.getElementById('iconPasswordConfirmationOpen');
    const iconConfClosed = document.getElementById('iconPasswordConfirmationClosed');

    togglePasswordConfirmation.addEventListener('click', () => {
        const isPassword = passwordConfirmation.type === 'password';
        passwordConfirmation.type = isPassword ? 'text' : 'password';
        iconConfOpen.classList.toggle('hidden');
        iconConfClosed.classList.toggle('hidden');
    });



    
</script>
@endsection
