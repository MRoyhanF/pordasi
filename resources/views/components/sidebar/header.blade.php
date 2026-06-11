<div class="p-4 sm:p-6 border-b border-gray-700">
    <div class="flex items-center gap-3">
        <img src="{{ asset('favicon.png') }}" alt="Logo Pordasi" class="h-8 sm:h-10 w-auto flex-shrink-0">
        <div class="min-w-0">
            <h1 class="font-bold text-base sm:text-lg">PORDASI</h1>
            <p class="text-xs text-gray-400">Berkuda Memanah</p>
        </div>
    </div>
</div>

<!-- User Profile in Sidebar -->
<div class="p-3 sm:p-4 border-b border-gray-700">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0 text-sm">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
        <div class="min-w-0">
            <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->role }}</p>
        </div>
    </div>
</div>
