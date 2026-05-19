<!-- Modal Tambah Kabupaten -->
<div id="createModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-4">Tambah Kabupaten / Kota</h3>
        
        <form id="createForm" action="{{ route('kabupaten.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="createName" class="block text-sm font-medium text-gray-700 mb-2">Nama Kabupaten / Kota</label>
                <input type="text" id="createName" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Jambi" required>
                <p id="createError" class="text-red-600 text-sm mt-1"></p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
