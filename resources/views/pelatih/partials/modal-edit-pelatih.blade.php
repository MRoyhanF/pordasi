<!-- Modal Edit Pelatih -->
<div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Edit Pelatih</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editUserId" value="">
            <input type="hidden" id="editOldStableId" value="">

            <div class="grid grid-cols-1 gap-4 mb-4">
                <!-- Nama (readonly info) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pelatih</label>
                    <input type="text" id="editNama" class="w-full px-4 py-2 border border-gray-200 bg-gray-50 rounded-lg text-gray-600 text-sm" disabled>
                </div>

                <!-- Stable -->
                <div>
                    <label for="editStableId" class="block text-sm font-medium text-gray-700 mb-2">Stable</label>
                    <select id="editStableId" name="stableId" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Stable --</option>
                    </select>
                    <p id="editStableIdError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="editIsActive" name="isActive" value="1" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="editIsActive" class="text-sm font-medium text-gray-700">Aktif</label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
