<!-- Modal Edit Atlet -->
<div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
        <h3 class="text-lg font-bold mb-4">Edit Atlet</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" value="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Stable -->
                <div class="md:col-span-2">
                    <label for="editStable" class="block text-sm font-medium text-gray-700 mb-2">
                        Stable <span class="text-red-500">*</span>
                    </label>
                    <select id="editStable" name="idStable"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Stable --</option>
                    </select>
                    <p id="editIdStableError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Nama Atlet -->
                <div class="md:col-span-2">
                    <label for="editNama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Atlet <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="editNama" name="nama"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <p id="editNamaError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="editJenisKelamin" class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <select id="editJenisKelamin" name="jenisKelamin"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih --</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                    <p id="editJenisKelaminError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Level -->
                <div>
                    <label for="editLevel" class="block text-sm font-medium text-gray-700 mb-2">
                        Level <span class="text-red-500">*</span>
                    </label>
                    <select id="editLevel" name="level"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="Mula">Mula</option>
                        <option value="Madya">Madya</option>
                        <option value="Wira">Wira</option>
                    </select>
                    <p id="editLevelError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Status -->
                <div>
                    <label for="editStatus" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="editStatus" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak_aktif">Tidak Aktif</option>
                    </select>
                    <p id="editStatusError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="editTanggalLahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" id="editTanggalLahir" name="tanggal_lahir"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p id="editTanggalLahirError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="editAlamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <input type="text" id="editAlamat" name="alamat"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p id="editAlamatError" class="text-red-600 text-sm mt-1"></p>
                </div>

                <!-- Prestasi -->
                <div class="md:col-span-2">
                    <label for="editPrestasi" class="block text-sm font-medium text-gray-700 mb-2">Prestasi</label>
                    <textarea id="editPrestasi" name="prestasi" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Prestasi atlet (opsional)"></textarea>
                    <p id="editPrestasiError" class="text-red-600 text-sm mt-1"></p>
                </div>
            </div>

            <p class="text-xs text-gray-500 mb-4"><span class="text-red-500">*</span> Wajib diisi</p>

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
