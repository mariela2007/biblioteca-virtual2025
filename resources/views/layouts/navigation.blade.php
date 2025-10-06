<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="h-9 w-auto" />
        </a>

        <!-- Links -->
        <div class="hidden sm:flex space-x-4">
            <a href="{{ route('dashboard') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Dashboard</a>
            <a href="{{ route('libros.index') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Libros</a>
        </div>

        <!-- User Dropdown -->
        <div class="hidden sm:flex items-center space-x-4">
            @auth
                <span class="text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-800 dark:text-gray-200 hover:underline">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-gray-800 dark:text-gray-200 hover:underline">Register</a>
            @endauth
        </div>
    </div>
</nav>
