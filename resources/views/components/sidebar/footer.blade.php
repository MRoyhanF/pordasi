<!-- Logout Button -->
<div class="p-3 sm:p-4 border-t border-gray-700 flex-shrink-0">
    <form action="{{ route('logout') }}" method="POST" class="w-full">
        @csrf
        <button type="submit" class="w-full px-3 sm:px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition text-sm sm:text-base flex items-center justify-center gap-2">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
            </svg>
            <span>Logout</span>
        </button>
    </form>
</div>
