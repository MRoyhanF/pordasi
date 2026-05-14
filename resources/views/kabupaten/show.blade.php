@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold">{{ $kabupaten->name }}</h2>
        <a href="{{ route('kabupaten.index') }}" class="px-3 sm:px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg text-sm sm:text-base transition">
            ← Kembali
        </a>
    </div>
    <p class="text-blue-100 text-sm sm:text-base">Lihat detail data untuk {{ $kabupaten->name }}</p>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs sm:text-sm">Total Stable</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_stable'] }}</p>
                </div>
                <div class="bg-purple-100 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h9m-9 3h6"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs sm:text-sm">Total Atlet</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_atlet'] }}</p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs sm:text-sm">Total Pelatih</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_pelatih'] }}</p>
                </div>
                <div class="bg-orange-100 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs sm:text-sm">Total Kuda</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total_kuda'] }}</p>
                </div>
                <div class="bg-yellow-100 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin List and action -->
    <div class="mb-6 bg-white rounded-lg shadow overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-900 p-4">Admin Kabupaten</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">No</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Nama Admin</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kabupaten->adminKabupaten as $index => $admin)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $admin->user->name }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $admin->user->email }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center">
                            @if($admin->isActive)
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center">
                            <div class="flex justify-center gap-2">
                                <button class="edit-btn p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition" 
                                    data-id="{{ $admin->user->id }}" data-name="{{ $admin->user->name }}" title="Edit">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </button>
                                <button class="delete-btn p-2 text-red-600 hover:bg-red-100 rounded-lg transition" 
                                    data-id="{{ $admin->user->id }}" data-name="{{ $admin->user->name }}" title="Hapus">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                            <p class="text-sm">Tidak ada admin untuk kabupaten ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



        <!-- Modal Edit Admin -->
    <div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h3 class="text-lg font-bold mb-4">Edit Status Admin</h3>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" id="editId" value="">
                
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Admin</p>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p id="editName" class="font-semibold text-gray-900"></p>
                        <p id="editEmail" class="text-sm text-gray-600 mt-1"></p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="editStatus" name="isActive" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                        <span class="ml-3 text-sm text-gray-700">Admin Aktif</span>
                    </label>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Admin -->
    <div id="deleteModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            
            <h3 class="text-lg font-bold text-center mb-2">Hapus Admin</h3>
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
        let currentKabupatanId = {{ $kabupaten->id }};
        let currentDeleteUserId = null;

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
        function openEditModal(id, name, email, isActive) {
            document.getElementById('editModal').classList.remove('modal-hidden');
            document.getElementById('editId').value = id;
            document.getElementById('editName').textContent = name;
            document.getElementById('editEmail').textContent = email;
            document.getElementById('editStatus').checked = isActive ? true : false;
            document.getElementById('editForm').action = `/kabupaten/${currentKabupatanId}/admin/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('modal-hidden');
        }

        function openDeleteModal(id, name) {
            window.deleteId = id;
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteModal').classList.remove('modal-hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('modal-hidden');
            window.deleteId = null;
        }

        function confirmDelete() {
            if (window.deleteId) {
                let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                if (!csrfToken) {
                    csrfToken = document.querySelector('input[name="_token"]')?.value;
                }
                
                if (!csrfToken) {
                    showToast('Error: CSRF token tidak ditemukan. Silahkan refresh halaman.', 'error');
                    closeDeleteModal();
                    return;
                }
                
                const deleteUrl = `/kabupaten/${currentKabupatanId}/admin/${window.deleteId}`;
                
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (response.status === 419) {
                        throw new Error('Session expired. Silahkan refresh halaman dan coba lagi.');
                    }
                    if (response.status === 404) {
                        throw new Error('Data tidak ditemukan (404). Mungkin sudah dihapus sebelumnya.');
                    }
                    if (response.status === 405) {
                        throw new Error('Method tidak diizinkan (405). Silahkan refresh halaman.');
                    }
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    closeDeleteModal();
                    showToast('Admin berhasil dihapus!', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
                .catch(error => {
                    closeDeleteModal();
                    console.error('Delete error:', error);
                    showToast(error.message || 'Gagal menghapus admin', 'error');
                });
            }
        }

        // ===== MODAL CLOSE BUTTON HANDLERS =====
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('close-modal')) {
                const modal = e.target.closest('[id*="Modal"]');
                if (modal?.id === 'editModal') closeEditModal();
                if (modal?.id === 'deleteModal') closeDeleteModal();
            }
            if (e.target.classList.contains('confirm-delete')) {
                confirmDelete();
            }
        });

        // ===== MODAL OUTSIDE CLICK CLOSE =====
        document.addEventListener('click', (e) => {
            if (e.target.id === 'editModal' && !e.target.classList.contains('modal-hidden')) {
                closeEditModal();
            }
            if (e.target.id === 'deleteModal' && !e.target.classList.contains('modal-hidden')) {
                closeDeleteModal();
            }
        });

        // ===== INITIALIZATION & EVENT DELEGATION =====
        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('click', (e) => {
                if (e.target.closest('.edit-btn')) {
                    const btn = e.target.closest('.edit-btn');
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    
                    fetch(`/kabupaten/${currentKabupatanId}/admin/${id}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network error');
                        return response.json();
                    })
                    .then(data => {
                        if (data.admin) {
                            openEditModal(id, data.admin.user.name, data.admin.user.email, data.admin.isActive);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Gagal memuat data admin', 'error');
                    });
                }
                if (e.target.closest('.delete-btn')) {
                    const btn = e.target.closest('.delete-btn');
                    openDeleteModal(btn.dataset.id, btn.dataset.name);
                }
            });
        });

        // ===== FORM SUBMISSION =====
        document.getElementById('editForm').addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(document.getElementById('editForm'));
            
            fetch(document.getElementById('editForm').action, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Admin berhasil diperbarui', 'success');
                    closeEditModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'Gagal memperbarui admin', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan pada server', 'error');
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

    <!-- Stables List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Stable</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">No</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Nama Stable</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Pemilik</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Atlet</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Pelatih</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kabupaten->stables as $index => $stable)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $stable->nama }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $stable->pemilik }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center">
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                {{ $stable->atlets->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center">
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">
                                {{ $stable->pelatih->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center text-gray-700">
                            {{ $stable->mulai_berdiri ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                            <p class="text-sm">Tidak ada data stable di kabupaten ini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Atlets Summary -->
    <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Ringkasan Atlet per Level</h3>
        </div>
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-gray-600 text-sm mb-2">Atlet Mula</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $kabupaten->atlets()->where('level', 'Mula')->count() }}</p>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <p class="text-gray-600 text-sm mb-2">Atlet Madya</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $kabupaten->atlets()->where('level', 'Madya')->count() }}</p>
                </div>
                <div class="text-center p-4 bg-pink-50 rounded-lg">
                    <p class="text-gray-600 text-sm mb-2">Atlet Wira</p>
                    <p class="text-2xl font-bold text-pink-600">{{ $kabupaten->atlets()->where('level', 'Wira')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
