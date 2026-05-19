<!-- Modal Tambah Stable -->
<div id="createModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Tambah Stable</h3>
        
        <form id="createForm" action="{{ route('stable.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Kabupaten -->
                <div>
                    <label for="createKabupaten" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten / Kota</label>
                    <select id="createKabupaten" name="idKabupaten" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                    <p id="createKabupatenError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Nama Stable -->
                <div>
                    <label for="createNama" class="block text-sm font-medium text-gray-700 mb-2">Nama Stable</label>
                    <input type="text" id="createNama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Contoh: Stable Jaya" required>
                    <p id="createNamaError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pemilik -->
                <div>
                    <label for="createPemilik" class="block text-sm font-medium text-gray-700 mb-2">Pemilik</label>
                    <input type="text" id="createPemilik" name="pemilik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Nama pemilik" required>
                    <p id="createPemilikError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Pimpinan -->
                <div>
                    <label for="createPimpinan" class="block text-sm font-medium text-gray-700 mb-2">Pimpinan Stable</label>
                    <input type="text" id="createPimpinan" name="pimpinan_stable" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Nama pimpinan" required>
                    <p id="createPimpinanError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Tahun Berdiri -->
                <div>
                    <label for="createBerdiri" class="block text-sm font-medium text-gray-700 mb-2">Tahun Mulai Berdiri</label>
                    <input type="number" id="createBerdiri" name="mulai_berdiri" min="1900" max="{{ date('Y') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="2020">
                    <p id="createBerdiriError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Jumlah Kandang -->
                <div>
                    <label for="createKandang" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kandang</label>
                    <input type="number" id="createKandang" name="jumlah_kandang" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="10">
                    <p id="createKandangError" class="text-red-600 text-sm mt-1"></p>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="createAlamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Stable</label>
                <textarea id="createAlamat" name="alamat_stable" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Alamat lengkap stable" required></textarea>
                <p id="createAlamatError" class="text-red-600 text-sm mt-1"></p>
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
