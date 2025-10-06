@if(auth()->check())
    <form action="{{ route('favoritos.toggle', $libro->id) }}" method="POST">
        @csrf
        <button type="submit"
                class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white w-full text-left transition-colors duration-150 flex items-center gap-2">
            {{ auth()->user()->favoritos->contains($libro) ? '💛 Favorito' : '🤍 Añadir a favoritos' }}
        </button>
    </form>
@else
    <a href="{{ route('login') }}"
       class="px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white w-full text-left rounded transition-colors duration-150 flex items-center gap-2">
       🔒 Inicia sesión para favoritos
    </a>
@endif