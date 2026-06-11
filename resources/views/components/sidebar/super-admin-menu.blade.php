<!-- Menu Items for SuperAdmin -->
<nav class="p-3 sm:p-4 space-y-1 sm:space-y-2 flex-1">
    <a href="{{ route('dashboard') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="{{ route('stable.index') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('stable.*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h9m-9 3h6"/>
        </svg>
        Stable
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
        </svg>
        Atlet
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
        </svg>
        Kuda
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
        </svg>
        Pelatih
    </a>

    <a href="{{ route('kabupaten.index') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('kabupaten.*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"/>
        </svg>
        Kabupaten / Kota
    </a>

    <a href="{{ route('pengguna.index') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('pengguna.*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2zm-7 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm8-2a1 1 0 11-2 0 1 1 0 012 0zM9 5a1 1 0 11-2 0 1 1 0 012 0z"/>
        </svg>
        Pengguna
    </a>

    <hr class="border-gray-700 my-3 sm:my-4">

    <a href="{{ route('home') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('home') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
        </svg>
        Beranda
    </a>
</nav>
