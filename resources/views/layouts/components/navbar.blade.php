<nav class="bg-white shadow-md sticky top-0 z-20 border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left: Menu Toggle & Logo -->
            <div class="flex items-center gap-3 min-w-0">
                <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 flex-shrink-0 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm0 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"/>
                    </svg>
                </button>
                
                <div class="hidden lg:flex items-center gap-2 flex-shrink-0">
                    <img src="{{ asset('favicon.png') }}" alt="Logo Pordasi" class="h-10 w-auto">
                    <div>
                        <h1 class="font-bold text-lg text-gray-900">PORDASI</h1>
                        <p class="text-xs text-gray-600">Berkuda Memanah Jambi</p>
                    </div>
                </div>
            </div>
            
            <!-- Right: User Info -->
            <div class="flex items-center gap-2 sm:gap-4 ml-auto flex-shrink-0">
                <span class="text-sm text-gray-700 hidden sm:inline">{{ Auth::user()->name }}</span>
                <span class="px-2 sm:px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full hidden sm:inline whitespace-nowrap">{{ Auth::user()->role }}</span>
            </div>
        </div>
    </div>
</nav>
