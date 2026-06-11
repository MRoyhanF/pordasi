<!-- Edit Pelatih Modal -->
<div id="pelatihEditModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="flex items-center justify-between p-5 border-b">
            <h3 class="text-lg font-bold text-gray-900">Edit Pelatih</h3>
            <button type="button" onclick="ModalManager.closeModal('pelatihEditModal')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        </div>
        <form id="pelatihEditForm" class="p-5">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelatih</label>
                    <input type="text" id="pelatihEditNama" class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-500 text-sm cursor-not-allowed" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm">
                        <option value="">Pilih Level (opsional)</option>
                        <option value="pelopor">Pelopor</option>
                        <option value="jelajah">Jelajah</option>
                        <option value="sigap">Sigap</option>
                        <option value="utama">Utama</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="isActive" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium" onclick="ModalManager.closeModal('pelatihEditModal')">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition text-sm font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
