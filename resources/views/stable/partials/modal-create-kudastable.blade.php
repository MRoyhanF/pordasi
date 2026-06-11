<!-- Kuda Modal -->
<div id="kudaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg max-h-screen overflow-y-auto">
        <div class="flex items-center justify-between p-5 border-b">
            <h3 class="text-lg font-bold text-gray-900" id="kudaModalTitle">Tambah Kuda</h3>
            <button type="button" onclick="ModalManager.closeModal('kudaModal')" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        </div>
        <form id="kudaForm" class="p-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kuda <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pasport</label>
                    <input type="text" name="pasport" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemilik</label>
                    <input type="text" name="pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keahlian</label>
                    <input type="text" name="keahlian" placeholder="cth: Dressage, Show Jumping, Endurance" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prestasi</label>
                    <textarea name="prestasi" rows="2" placeholder="Prestasi yang pernah diraih..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-sm resize-none"></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-5">
                <button type="button" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium" onclick="ModalManager.closeModal('kudaModal')">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-medium">Simpan</button>
            </div>
        </form>
    </div>
</div>
