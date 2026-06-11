<!-- Modal Tambah Pelatih -->
<div id="createModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Tambah Pelatih</h3>

        <form id="createForm" action="{{ route('pelatih.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4 mb-4">
                <!-- Pengguna -->
                <div>
                    <label for="createUserId" class="block text-sm font-medium text-gray-700 mb-2">Pengguna (Pelatih)</label>
                    <select id="createUserId" name="userId" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Pengguna --</option>
                    </select>
                    <p id="createUserIdError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Stable -->
                <div>
                    <label for="createStableId" class="block text-sm font-medium text-gray-700 mb-2">Stable</label>
                    <select id="createStableId" name="stableId" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Stable --</option>
                    </select>
                    <p id="createStableIdError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="createIsActive" name="isActive" value="1" checked class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="createIsActive" class="text-sm font-medium text-gray-700">Aktif</label>
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
