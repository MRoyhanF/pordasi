<!-- Modal Edit Kuda -->
<div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Edit Kuda</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" value="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Stable -->
                <div class="md:col-span-2">
                    <label for="editStable" class="block text-sm font-medium text-gray-700 mb-2">Stable</label>
                    <select id="editStable" name="stable" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Stable --</option>
                    </select>
                    <p id="editStableError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Nama Kuda -->
                <div>
                    <label for="editNama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kuda</label>
                    <input type="text" id="editNama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <p id="editNamaError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pemilik -->
                <div>
                    <label for="editPemilik" class="block text-sm font-medium text-gray-700 mb-2">Pemilik</label>
                    <input type="text" id="editPemilik" name="pemilik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p id="editPemilikError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pasport -->
                <div>
                    <label for="editPasport" class="block text-sm font-medium text-gray-700 mb-2">No. Pasport</label>
                    <input type="text" id="editPasport" name="pasport" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p id="editPasportError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Keahlian -->
                <div>
                    <label for="editKeahlian" class="block text-sm font-medium text-gray-700 mb-2">Keahlian</label>
                    <select id="editKeahlian" name="keahlian" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">-- Pilih Keahlian --</option>
                        <option value="berkuda_memanah">Berkuda Memanah</option>
                        <option value="jumping">Jumping</option>
                        <option value="dressage">Dressage</option>
                        <option value="polo">Polo</option>
                    </select>
                    <p id="editKeahlianError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Prestasi -->
                <div>
                    <label for="editPrestasi" class="block text-sm font-medium text-gray-700 mb-2">Prestasi</label>
                    <input type="text" id="editPrestasi" name="prestasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p id="editPrestasiError" class="text-red-600 text-sm mt-1"></p>
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
