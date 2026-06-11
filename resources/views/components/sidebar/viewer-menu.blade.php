<!-- Menu Items for Viewer -->
<nav class="p-3 sm:p-4 space-y-1 sm:space-y-2 flex-1">
    <a href="{{ route('dashboard') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
        </svg>
        Dashboard
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
        </svg>
        Lihat Data Atlet
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
        </svg>
        Lihat Data Kuda
    </a>

    <a href="#" class="block px-3 sm:px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition text-sm sm:text-base">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
        </svg>
        Lihat Data Pelatih
    </a>

    <hr class="border-gray-700 my-3 sm:my-4">

    <a href="{{ route('home') }}" class="block px-3 sm:px-4 py-2 rounded-lg transition text-sm sm:text-base {{ request()->routeIs('home') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
        <svg class="w-4 h-4 sm:w-5 sm:h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
        </svg>
        Beranda
    </a>
</nav>
