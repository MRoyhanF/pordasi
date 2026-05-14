<!-- Menu Items for Pelatih -->
<nav class="p-3 sm:p-4 space-y-1 sm:space-y-2 flex-1">
    <a href="{{ route('dashboard') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
        </svg>
        Atlet Saya
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
        </svg>
        Kuda Saya
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h8a1 1 0 000-2 2 2 0 012 2v10a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm3 4a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
        </svg>
        Jadwal Latihan
    </a>

    <hr class="border-gray-700 my-3 sm:my-4">

    <a href="{{ route('home') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
        </svg>
        Beranda
    </a>
</nav>
