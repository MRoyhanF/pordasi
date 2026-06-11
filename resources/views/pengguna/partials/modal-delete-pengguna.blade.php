<!-- Modal Delete Pengguna -->
<div id="deleteModal" class="modal-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm mx-4">
        <div class="flex items-center justify-between p-5 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Hapus Pengguna</h3>
            <button class="close-modal text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5 pointer-events-none" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="p-5">
            <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus pengguna <span id="deleteName" class="font-semibold text-gray-800"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end gap-3 mt-5">
                <button type="button" class="close-modal px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm font-medium">Batal</button>
                <button type="button" class="confirm-delete px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">Hapus</button>
            </div>
        </div>
    </div>
</div>
