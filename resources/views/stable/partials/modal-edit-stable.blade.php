<!-- Modal Edit Stable -->
<div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Edit Stable</h3>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" value="">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Kabupaten -->
                <div>
                    <label for="editKabupaten" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten / Kota</label>
                    <select id="editKabupaten" name="idKabupaten" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                    <p id="editKabupatenError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Nama Stable -->
                <div>
                    <label for="editNama" class="block text-sm font-medium text-gray-700 mb-2">Nama Stable</label>
                    <input type="text" id="editNama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <p id="editNamaError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pemilik -->
                <div>
                    <label for="editPemilik" class="block text-sm font-medium text-gray-700 mb-2">Pemilik</label>
                    <input type="text" id="editPemilik" name="pemilik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <p id="editPemilikError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pimpinan -->
                <div>
                    <label for="editPimpinan" class="block text-sm font-medium text-gray-700 mb-2">Pimpinan Stable</label>
                    <input type="text" id="editPimpinan" name="pimpinan_stable" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <p id="editPimpinanError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Tahun Berdiri -->
                <div>
                    <label for="editBerdiri" class="block text-sm font-medium text-gray-700 mb-2">Tahun Mulai Berdiri</label>
                    <input type="number" id="editBerdiri" name="mulai_berdiri" min="1900" max="{{ date('Y') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <p id="editBerdiriError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Jumlah Kandang -->
                <div>
                    <label for="editKandang" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kandang</label>
                    <input type="number" id="editKandang" name="jumlah_kandang" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <p id="editKandangError" class="text-red-600 text-sm mt-1"></p>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="editAlamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Stable</label>
                <textarea id="editAlamat" name="alamat_stable" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
                <p id="editAlamatError" class="text-red-600 text-sm mt-1"></p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
