<!-- Pelatih Modal -->
<div id="pelatihModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold mb-4 text-gray-900">Tambah Pelatih</h3>
        <form id="pelatihForm">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Pelatih <span class="text-red-500">*</span></label>
                    <select name="userId" id="pelatihUserSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">Memuat data...</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition font-medium">Simpan</button>
                <button type="button" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium" onclick="ModalManager.closeModal('pelatihModal')">Batal</button>
            </div>
        </form>
    </div>
</div>
