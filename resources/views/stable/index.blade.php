@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold">Data Stable</h2>
        <button class="create-btn px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
            + Tambah Stable
        </button>
    </div>
    <p class="text-purple-100 text-sm sm:text-base">Kelola dan lihat data stable/kandang kuda</p>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 flex flex-col">
    <!-- Filter Bar -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Stable</label>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Ketik nama stable..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                >
            </div>

            <!-- Filter by Kabupaten -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Kabupaten</label>
                <select 
                    id="kabupatenFilter" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                >
                    <option value="">Semua Kabupaten</option>
                </select>
            </div>
            
            <!-- Rows Per Page -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data Per Halaman</label>
                <select 
                    id="itemsPerPage" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                >
                    <option value="5">5 Item</option>
                    <option value="10" selected>10 Item</option>
                    <option value="25">25 Item</option>
                    <option value="50">50 Item</option>
                </select>
            </div>

            <!-- Clear Filter -->
            <div class="flex items-end">
                <button 
                    id="clearFilter" 
                    class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium text-sm"
                >
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
        <table id="stableTable" class="w-full">
            <thead>
                <tr>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">No</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Nama Stable</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Kabupaten</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Pemilik</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Jumlah Kandang</th>
                    <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Atlet</th>
                    <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Pelatih</th>
                    <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Kuda</th>
                    <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($stables as $item)
                <tr class="hover:bg-gray-50 border-b border-gray-100 transition" data-kabupaten-id="{{ $item->idKabupaten }}">
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('stable.show', $item->id) }}" class="text-purple-600 hover:text-purple-800 hover:underline font-medium">
                            {{ $item->nama }}
                        </a>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ $item->kabupaten->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ $item->pemilik }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ $item->jumlah_kandang ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            {{ $item->atlets()->count() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">
                            {{ $item->pelatih()->count() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                            {{ $item->kuda()->count() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="edit-btn p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition" 
                                data-id="{{ $item->id }}" 
                                data-kabupaten="{{ $item->idKabupaten }}" 
                                data-nama="{{ $item->nama }}" 
                                data-pemilik="{{ $item->pemilik }}" 
                                data-alamat="{{ $item->alamat_stable }}" 
                                data-pimpinan="{{ $item->pimpinan_stable }}" 
                                data-berdiri="{{ $item->mulai_berdiri }}" 
                                data-jumlah-kandang="{{ $item->jumlah_kandang }}" 
                                title="Edit"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </button>
                            <button class="delete-btn p-2 text-red-600 hover:bg-red-100 rounded-lg transition" 
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" title="Hapus">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-500 py-8 text-sm">Tidak ada data stable</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t border-gray-100 gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span id="startItem" class="font-semibold">1</span> hingga <span id="endItem" class="font-semibold">10</span> dari <span id="totalItems" class="font-semibold">{{ count($stables) }}</span> data
            </div>
            
            <nav class="flex items-center gap-2" id="pagination">
                <button id="prevBtn" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">← Sebelumnya</button>
                <div id="pageNumbers" class="flex gap-1"></div>
                <button id="nextBtn" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">Selanjutnya →</button>
            </nav>
        </div>
    </div>

</div>

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

<!-- Modal Delete Stable -->
<div id="deleteModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        
        <h3 class="text-lg font-bold text-center mb-2">Hapus Stable</h3>
        <p class="text-gray-600 text-center text-sm mb-6">Apakah Anda yakin ingin menghapus <span id="deleteName" class="font-semibold"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
        
        <div class="flex gap-3">
            <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                Batal
            </button>
            <button type="button" class="confirm-delete flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
    // ===== TOAST NOTIFICATION =====
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' 
            ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
            : '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>';
        
        toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center gap-3 min-w-sm animate-fade-in`;
        toast.innerHTML = `${icon}<span>${message}</span>`;
        
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // ===== MODAL FUNCTIONS =====
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('modal-hidden');
        document.getElementById('createForm').reset();
        clearAllErrors('create');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('modal-hidden');
    }

    function openEditModal(id, kabupaten, nama, pemilik, alamat, pimpinan, berdiri, jumlahKandang) {
        document.getElementById('editModal').classList.remove('modal-hidden');
        document.getElementById('editId').value = id;
        document.getElementById('editKabupaten').value = kabupaten;
        document.getElementById('editNama').value = nama;
        document.getElementById('editPemilik').value = pemilik;
        document.getElementById('editAlamat').value = alamat;
        document.getElementById('editPimpinan').value = pimpinan;
        document.getElementById('editBerdiri').value = berdiri || '';
        document.getElementById('editKandang').value = jumlahKandang || '';
        document.getElementById('editForm').action = `/stable/${id}`;
        clearAllErrors('edit');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('modal-hidden');
    }

    function openDeleteModal(id, nama) {
        window.deleteId = id;
        document.getElementById('deleteName').textContent = nama;
        document.getElementById('deleteModal').classList.remove('modal-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('modal-hidden');
        window.deleteId = null;
    }

    function clearAllErrors(prefix) {
        document.querySelectorAll(`[id^="${prefix}"]`).forEach(el => {
            if (el.id.includes('Error')) el.textContent = '';
        });
    }

    function confirmDelete() {
        if (window.deleteId) {
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                csrfToken = document.querySelector('input[name="_token"]')?.value;
            }
            
            if (!csrfToken) {
                showToast('Error: CSRF token tidak ditemukan', 'error');
                closeDeleteModal();
                return;
            }
            
            fetch(`/stable/${window.deleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                closeDeleteModal();
                showToast('Stable berhasil dihapus!', 'success');
                setTimeout(() => window.location.reload(), 1000);
            })
            .catch(error => {
                closeDeleteModal();
                console.error('Delete error:', error);
                showToast('Gagal menghapus stable', 'error');
            });
        }
    }

    // ===== LOAD KABUPATEN TO DROPDOWNS =====
    async function loadKabupaten() {
        try {
            const response = await fetch('/stable/get-kabupaten');
            const kabupaten = await response.json();
            
            const createSelect = document.getElementById('createKabupaten');
            const editSelect = document.getElementById('editKabupaten');
            const filterSelect = document.getElementById('kabupatenFilter');
            
            // Clear existing options (keep the first option)
            [createSelect, editSelect].forEach(select => {
                while (select.options.length > 1) {
                    select.remove(1);
                }
            });
            
            // Add kabupaten options to all selects
            kabupaten.forEach(item => {
                // Create separate options for each select
                const optionCreate = document.createElement('option');
                optionCreate.value = item.id;
                optionCreate.textContent = item.name;
                createSelect.appendChild(optionCreate);
                
                const optionEdit = document.createElement('option');
                optionEdit.value = item.id;
                optionEdit.textContent = item.name;
                editSelect.appendChild(optionEdit);
                
                const optionFilter = document.createElement('option');
                optionFilter.value = item.id;
                optionFilter.textContent = item.name;
                filterSelect.appendChild(optionFilter);
            });
        } catch (error) {
            console.error('Error loading kabupaten:', error);
            showToast('Gagal memuat data kabupaten', 'error');
        }
    }

    // ===== FORM HANDLERS =====
    document.getElementById('createForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) csrfToken = document.querySelector('input[name="_token"]')?.value;
        
        try {
            const response = await fetch('/stable', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const errorEl = document.getElementById(`create${field.charAt(0).toUpperCase() + field.slice(1)}Error`);
                        if (errorEl) errorEl.textContent = messages[0];
                    });
                }
                return;
            }
            
            closeCreateModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        }
    });

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const stableId = document.getElementById('editId').value;
        const formData = new FormData(e.target);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) csrfToken = document.querySelector('input[name="_token"]')?.value;
        
        try {
            const response = await fetch(`/stable/${stableId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const errorEl = document.getElementById(`edit${field.charAt(0).toUpperCase() + field.slice(1)}Error`);
                        if (errorEl) errorEl.textContent = messages[0];
                    });
                }
                return;
            }
            
            closeEditModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        }
    });

    // ===== MODAL CLOSE BUTTON HANDLERS =====
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal')) {
            const modal = e.target.closest('[id*="Modal"]');
            if (modal?.id === 'createModal') closeCreateModal();
            if (modal?.id === 'editModal') closeEditModal();
            if (modal?.id === 'deleteModal') closeDeleteModal();
        }
        if (e.target.classList.contains('confirm-delete')) {
            confirmDelete();
        }
    });

    // ===== MODAL OUTSIDE CLICK CLOSE =====
    document.addEventListener('click', (e) => {
        if (e.target.id === 'createModal' && !e.target.classList.contains('modal-hidden')) {
            closeCreateModal();
        }
        if (e.target.id === 'editModal' && !e.target.classList.contains('modal-hidden')) {
            closeEditModal();
        }
        if (e.target.id === 'deleteModal' && !e.target.classList.contains('modal-hidden')) {
            closeDeleteModal();
        }
    });

    // ===== INITIALIZATION =====
    document.addEventListener('DOMContentLoaded', () => {
        loadKabupaten();
        
        // Delegate edit/delete button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.create-btn')) {
                openCreateModal();
            }
            if (e.target.closest('.edit-btn')) {
                const btn = e.target.closest('.edit-btn');
                openEditModal(btn.dataset.id, btn.dataset.kabupaten, btn.dataset.nama, 
                              btn.dataset.pemilik, btn.dataset.alamat, btn.dataset.pimpinan, btn.dataset.berdiri, btn.dataset.jumlahKandang);
            }
            if (e.target.closest('.delete-btn')) {
                const btn = e.target.closest('.delete-btn');
                openDeleteModal(btn.dataset.id, btn.dataset.nama);
            }
        });
    });

    // ===== CSS ANIMATION =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
        .modal-hidden { display: none !important; }
    `;
    document.head.appendChild(style);
</script>

{{-- Custom Table Handler --}}
<script>
    class TableHandler {
        constructor(tableId, options = {}) {
            this.table = document.getElementById(tableId);
            this.tbody = document.getElementById('tableBody');
            this.searchInput = document.getElementById('searchInput');
            this.kabupatenFilter = document.getElementById('kabupatenFilter');
            this.itemsPerPageSelect = document.getElementById('itemsPerPage');
            this.clearFilterBtn = document.getElementById('clearFilter');
            this.prevBtn = document.getElementById('prevBtn');
            this.nextBtn = document.getElementById('nextBtn');
            this.pageNumbersContainer = document.getElementById('pageNumbers');
            
            this.currentPage = 1;
            this.itemsPerPage = 10;
            this.allRows = [];
            this.filteredRows = [];
            
            this.init();
            this.attachEventListeners();
        }
        
        init() {
            const rows = this.table.querySelectorAll('tbody tr:not(:last-child)');
            this.allRows = Array.from(rows).map(row => ({
                element: row,
                nama: row.querySelector('td:nth-child(2) a')?.textContent?.toLowerCase() || '',
                kabupatenId: row.dataset.kabupatenId || '',
                html: row.innerHTML
            }));
            
            if (this.allRows.length > 0) {
                this.filteredRows = [...this.allRows];
                this.render();
            }
        }
        
        attachEventListeners() {
            this.searchInput.addEventListener('input', () => this.handleSearch());
            this.kabupatenFilter.addEventListener('change', () => this.handleKabupatenFilter());
            this.itemsPerPageSelect.addEventListener('change', () => this.handleItemsPerPageChange());
            this.clearFilterBtn.addEventListener('click', () => this.handleClearFilter());
            this.prevBtn.addEventListener('click', () => this.previousPage());
            this.nextBtn.addEventListener('click', () => this.nextPage());
        }
        
        handleSearch() {
            this.applyFilters();
        }

        handleKabupatenFilter() {
            this.applyFilters();
        }

        applyFilters() {
            const searchTerm = this.searchInput.value.toLowerCase();
            const kabupatenFilter = this.kabupatenFilter.value;
            
            this.filteredRows = this.allRows.filter(row => {
                const namaMatch = row.nama.includes(searchTerm);
                const kabupatenMatch = !kabupatenFilter || row.kabupatenId === kabupatenFilter;
                return namaMatch && kabupatenMatch;
            });
            
            this.currentPage = 1;
            this.render();
        }
        
        handleItemsPerPageChange() {
            this.itemsPerPage = parseInt(this.itemsPerPageSelect.value);
            this.currentPage = 1;
            this.render();
        }
        
        handleClearFilter() {
            this.searchInput.value = '';
            this.kabupatenFilter.value = '';
            this.itemsPerPageSelect.value = 10;
            this.itemsPerPage = 10;
            this.currentPage = 1;
            this.filteredRows = [...this.allRows];
            this.render();
        }
        
        render() {
            this.renderTableBody();
            this.renderPagination();
            this.updatePaginationInfo();
        }
        
        renderTableBody() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            const paginatedRows = this.filteredRows.slice(start, end);
            
            if (paginatedRows.length === 0) {
                this.tbody.innerHTML = `<tr><td colspan="8" class="text-center text-gray-500 py-8 text-sm">Tidak ada data yang cocok</td></tr>`;
                return;
            }
            
            this.tbody.innerHTML = paginatedRows.map((row, index) => {
                const rowNumber = start + index + 1;
                const tr = document.createElement('tr');
                tr.innerHTML = row.html;
                tr.dataset.kabupatenId = row.kabupatenId;
                
                const noCell = tr.querySelector('td:first-child');
                if (noCell) noCell.textContent = rowNumber;
                
                tr.className = 'hover:bg-gray-50 border-b border-gray-100 transition';
                
                return tr.outerHTML;
            }).join('');
        }
        
        renderPagination() {
            const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
            this.pageNumbersContainer.innerHTML = '';
            
            if (totalPages <= 1) {
                this.prevBtn.disabled = true;
                this.nextBtn.disabled = true;
                return;
            }
            
            let startPage = Math.max(1, this.currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);
            
            this.prevBtn.disabled = this.currentPage === 1;
            
            if (startPage > 1) {
                const btn = this.createPageButton(1);
                this.pageNumbersContainer.appendChild(btn);
                
                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-2 py-2 text-gray-500';
                    ellipsis.textContent = '...';
                    this.pageNumbersContainer.appendChild(ellipsis);
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                const btn = this.createPageButton(i);
                this.pageNumbersContainer.appendChild(btn);
            }
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'px-2 py-2 text-gray-500';
                    ellipsis.textContent = '...';
                    this.pageNumbersContainer.appendChild(ellipsis);
                }
                
                const btn = this.createPageButton(totalPages);
                this.pageNumbersContainer.appendChild(btn);
            }
            
            this.nextBtn.disabled = this.currentPage === totalPages;
        }
        
        createPageButton(pageNum) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = pageNum;
            btn.className = `px-3 py-2 rounded-lg text-sm font-medium transition ${
                this.currentPage === pageNum 
                    ? 'bg-purple-600 text-white border border-purple-600' 
                    : 'border border-gray-300 text-gray-700 hover:bg-gray-200'
            }`;
            
            btn.addEventListener('click', () => this.goToPage(pageNum));
            return btn;
        }
        
        updatePaginationInfo() {
            const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
            const start = this.filteredRows.length === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
            const end = Math.min(this.currentPage * this.itemsPerPage, this.filteredRows.length);
            const total = this.filteredRows.length;
            
            document.getElementById('startItem').textContent = start;
            document.getElementById('endItem').textContent = end;
            document.getElementById('totalItems').textContent = total;
        }
        
        goToPage(pageNum) {
            this.currentPage = pageNum;
            this.render();
        }
        
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.render();
            }
        }
        
        nextPage() {
            const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
            if (this.currentPage < totalPages) {
                this.currentPage++;
                this.render();
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        new TableHandler('stableTable');
    });
</script>

@endsection
