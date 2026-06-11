<!-- Modal Tambah Kuda -->
<div id="createModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Tambah Kuda</h3>

        <form id="createForm" action="{{ route('kuda.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Stable -->
                <div class="md:col-span-2">
                    <label for="createStable" class="block text-sm font-medium text-gray-700 mb-2">Stable</label>
                    <select id="createStable" name="stable" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Stable --</option>
                    </select>
                    <p id="createStableError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Nama Kuda -->
                <div>
                    <label for="createNama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kuda</label>
                    <input type="text" id="createNama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Kuda Hitam" required>
                    <p id="createNamaError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pemilik -->
                <div>
                    <label for="createPemilik" class="block text-sm font-medium text-gray-700 mb-2">Pemilik</label>
                    <input type="text" id="createPemilik" name="pemilik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nama pemilik">
                    <p id="createPemilikError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pasport -->
                <div>
                    <label for="createPasport" class="block text-sm font-medium text-gray-700 mb-2">No. Pasport</label>
                    <input type="text" id="createPasport" name="pasport" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Nomor pasport kuda">
                    <p id="createPasportError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Prestasi -->
                <div>
                    <label for="createPrestasi" class="block text-sm font-medium text-gray-700 mb-2">Prestasi</label>
                    <input type="text" id="createPrestasi" name="prestasi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Prestasi kuda">
                    <p id="createPrestasiError" class="text-red-600 text-sm mt-1"></p>
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
