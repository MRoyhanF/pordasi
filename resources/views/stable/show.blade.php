@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-4">
        <div class="flex-1">
            <a href="{{ route('stable.index') }}" class="text-purple-200 hover:text-white transition text-sm mb-2 inline-block">
                ← Kembali ke Daftar Stable
            </a>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">{{ $stable->nama }}</h2>
            <p class="text-purple-100 text-sm mt-1">
                Kabupaten: <strong>{{ $stable->kabupaten->name ?? '-' }}</strong>
            </p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('stable.edit', $stable->id) }}" class="px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-gray-100 transition text-sm font-medium flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                Edit Stable
            </a>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 space-y-6">
    
    <!-- Main Info Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold mb-6 text-gray-900">Informasi Stable</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="pb-4 border-b md:border-b-0">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Nama Stable</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->nama }}</p>
            </div>
            
            <div class="pb-4 border-b md:border-b-0 lg:border-b-0">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Kabupaten / Kota</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->kabupaten->name ?? '-' }}</p>
            </div>
            
            <div class="pb-4 border-b md:border-b-0 lg:border-b-0">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Pemilik</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->pemilik }}</p>
            </div>
            
            <div class="pb-4 border-b md:border-b-0">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Pimpinan Stable</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->pimpinan_stable }}</p>
            </div>
            
            <div class="pb-4 border-b md:border-b-0 lg:border-b-0">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Tahun Berdiri</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->mulai_berdiri ?? '-' }}</p>
            </div>
            
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Jumlah Kandang</p>
                <p class="text-gray-900 font-semibold text-lg mt-2">{{ $stable->jumlah_kandang ?? '-' }}</p>
            </div>
        </div>
        
        <div class="mt-6 pt-6 border-t">
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wide mb-2">Alamat Stable</p>
            <p class="text-gray-900 font-semibold">{{ $stable->alamat_stable }}</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow p-6">
            <p class="text-green-100 text-sm font-medium">Total Atlet</p>
            <p class="text-4xl font-bold mt-2" id="atletCount">{{ $stable->atlets->count() }}</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow p-6">
            <p class="text-orange-100 text-sm font-medium">Total Pelatih</p>
            <p class="text-4xl font-bold mt-2" id="pelatihCount">{{ $stable->pelatih->count() }}</p>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-lg shadow p-6">
            <p class="text-yellow-100 text-sm font-medium">Total Kuda</p>
            <p class="text-4xl font-bold mt-2" id="kudaCount">{{ $stable->kuda->count() }}</p>
        </div>
    </div>

    <!-- Atlet Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-900">Daftar Atlet</h3>
            <div class="flex gap-2 items-center">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold" id="atletBadge">
                    {{ $stable->atlets->count() }} Atlet
                </span>
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium" id="addAtletBtn">
                    + Tambah Atlet
                </button>
            </div>
        </div>
        
        @if($stable->atlets->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama Atlet</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Jenis Kelamin</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Level</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="atletTableBody">
                        @foreach($stable->atlets as $atlet)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition" data-atlet-id="{{ $atlet->id }}">
                            <td class="px-4 py-3 text-gray-900 font-medium">{{ $atlet->nama }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ ucfirst($atlet->jenisKelamin ?? '-') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">
                                    {{ $atlet->level ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <button class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition editAtletBtn" data-atlet-id="{{ $atlet->id }}">
                                        Edit
                                    </button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition deleteAtletBtn" data-atlet-id="{{ $atlet->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada atlet di stable ini</p>
        @endif
    </div>

    <!-- Kuda Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-900">Daftar Kuda</h3>
            <div class="flex gap-2 items-center">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold" id="kudaBadge">
                    {{ $stable->kuda->count() }} Kuda
                </span>
                <button class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-medium" id="addKudaBtn">
                    + Tambah Kuda
                </button>
            </div>
        </div>
        
        @if($stable->kuda->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama Kuda</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Jenis</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Warna</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kudaTableBody">
                        @foreach($stable->kuda as $k)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition" data-kuda-id="{{ $k->id }}">
                            <td class="px-4 py-3 text-gray-900 font-medium">{{ $k->nama }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $k->jenis ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $k->warna ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <button class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition editKudaBtn" data-kuda-id="{{ $k->id }}">
                                        Edit
                                    </button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition deleteKudaBtn" data-kuda-id="{{ $k->id }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada kuda di stable ini</p>
        @endif
    </div>

    <!-- Pelatih Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-900">Daftar Pelatih</h3>
            <div class="flex gap-2 items-center">
                <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold" id="pelatihBadge">
                    {{ $stable->pelatih->count() }} Pelatih
                </span>
                <button class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition text-sm font-medium" id="addPelatihBtn">
                    + Tambah Pelatih
                </button>
            </div>
        </div>
        
        @if($stable->pelatih->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Nama Pelatih</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Email</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700">Status</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pelatihTableBody">
                        @foreach($stable->pelatih as $p)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition" data-pelatih-user-id="{{ $p->userId }}">
                            <td class="px-4 py-3 text-gray-900 font-medium">{{ $p->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $p->user->email ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <button class="px-3 py-1 rounded text-xs font-semibold togglePelatihBtn transition {{ $p->isActive ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}" 
                                    data-pelatih-user-id="{{ $p->userId }}">
                                    {{ $p->isActive ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition deletePelatihBtn" data-pelatih-user-id="{{ $p->userId }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada pelatih di stable ini</p>
        @endif
    </div>

    <!-- Metadata Footer -->
    <div class="bg-gray-50 rounded-lg p-6 text-sm text-gray-600 border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-500 font-medium">Dibuat pada:</p>
                <p class="text-gray-900 font-semibold mt-1">{{ $stable->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-500 font-medium">Diperbarui pada:</p>
                <p class="text-gray-900 font-semibold mt-1">{{ $stable->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>

</div>

<!-- ========== MODALS ========== -->

<!-- Atlet Modal -->
<div id="atletModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold mb-4 text-gray-900" id="atletModalTitle">Tambah Atlet</h3>
        <form id="atletForm">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Atlet <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenisKelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level <span class="text-red-500">*</span></label>
                    <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Level</option>
                        <option value="Mula">Mula</option>
                        <option value="Madya">Madya</option>
                        <option value="Wira">Wira</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">Simpan</button>
                <button type="button" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium" onclick="ModalManager.closeModal('atletModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Kuda Modal -->
<div id="kudaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold mb-4 text-gray-900" id="kudaModalTitle">Tambah Kuda</h3>
        <form id="kudaForm">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kuda <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pasport</label>
                    <input type="text" name="pasport" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prestasi</label>
                    <textarea name="prestasi" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemilik</label>
                    <input type="text" name="pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-medium">Simpan</button>
                <button type="button" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium" onclick="ModalManager.closeModal('kudaModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

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

<!-- Delete Atlet Modal -->
<div id="deleteAtletModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-center mb-2">Hapus Atlet</h3>
        <p class="text-gray-600 text-center text-sm mb-6">Apakah Anda yakin ingin menghapus <span id="deleteAtletName" class="font-semibold"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
        <div class="flex gap-3">
            <button type="button" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium" onclick="ModalManager.closeModal('deleteAtletModal')">Batal</button>
            <button type="button" class="confirm-delete-atlet flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">Hapus</button>
        </div>
    </div>
</div>

<!-- Delete Kuda Modal -->
<div id="deleteKudaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-center mb-2">Hapus Kuda</h3>
        <p class="text-gray-600 text-center text-sm mb-6">Apakah Anda yakin ingin menghapus <span id="deleteKudaName" class="font-semibold"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
        <div class="flex gap-3">
            <button type="button" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium" onclick="ModalManager.closeModal('deleteKudaModal')">Batal</button>
            <button type="button" class="confirm-delete-kuda flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">Hapus</button>
        </div>
    </div>
</div>

<!-- Delete Pelatih Modal -->
<div id="deletePelatihModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-center mb-2">Hapus Pelatih</h3>
        <p class="text-gray-600 text-center text-sm mb-6">Apakah Anda yakin ingin menghapus <span id="deletePelatihName" class="font-semibold"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
        <div class="flex gap-3">
            <button type="button" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium" onclick="ModalManager.closeModal('deletePelatihModal')">Batal</button>
            <button type="button" class="confirm-delete-pelatih flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">Hapus</button>
        </div>
    </div>
</div>

<script>
    // ========== CONFIG ==========
    const Config = {
        stableId: {{ $stable->id }},
        routes: {
            atlet: {
                store: '/stable/{{ $stable->id }}/atlet',
                update: '/stable/{{ $stable->id }}/atlet/:id',
                destroy: '/stable/{{ $stable->id }}/atlet/:id'
            },
            kuda: {
                store: '/stable/{{ $stable->id }}/kuda',
                update: '/stable/{{ $stable->id }}/kuda/:id',
                destroy: '/stable/{{ $stable->id }}/kuda/:id'
            },
            pelatih: {
                users: '/stable/{{ $stable->id }}/pelatih/users',
                store: '/stable/{{ $stable->id }}/pelatih',
                update: '/stable/{{ $stable->id }}/pelatih/:id',
                destroy: '/stable/{{ $stable->id }}/pelatih/:id'
            }
        }
    };

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

    // ===== MODAL MANAGER =====
    const ModalManager = {
        openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        },
        closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        },
        closeAllModals() {
            document.querySelectorAll('[id$="Modal"]').forEach(m => m.classList.add('hidden'));
        }
    };

    // ===== FORM HANDLER =====
    class FormHandler {
        static async submit(formId, url, method = 'POST') {
            const form = document.getElementById(formId);
            const formData = new FormData(form);
            
            // Get CSRF token
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                csrfToken = document.querySelector('input[name="_token"]')?.value;
            }
            
            // Add CSRF token to FormData
            if (csrfToken) {
                formData.append('_token', csrfToken);
            }
            
            // Add method override for PUT/DELETE
            if (method !== 'POST') {
                formData.append('_method', method);
            }
            
            try {
                const response = await fetch(url, {
                    method: 'POST',  // Always use POST when using FormData with method override
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();
                if (!response.ok) {
                    showToast(data.message || 'Gagal menyimpan data', 'error');
                    return { success: false, data };
                }

                showToast(data.message || 'Berhasil', 'success');
                return { success: true, data };
            } catch (error) {
                showToast(error.message, 'error');
                return { success: false };
            }
        }
    }

    // ===== ATLET MANAGER =====
    const AtletManager = {
        init() {
            document.getElementById('addAtletBtn').addEventListener('click', () => {
                document.getElementById('atletForm').reset();
                document.getElementById('atletModalTitle').textContent = 'Tambah Atlet';
                document.getElementById('atletForm').dataset.id = '';
                ModalManager.openModal('atletModal');
            });

            document.getElementById('atletForm').addEventListener('submit', e => this.submit(e));
            document.getElementById('atletTableBody').addEventListener('click', e => this.handleTableClick(e));
        },

        async submit(e) {
            e.preventDefault();
            const form = document.getElementById('atletForm');
            const id = form.dataset.id;
            const url = id ? Config.routes.atlet.update.replace(':id', id) : Config.routes.atlet.store;
            const method = id ? 'PUT' : 'POST';

            const result = await FormHandler.submit('atletForm', url, method);
            if (result.success) {
                ModalManager.closeModal('atletModal');
                location.reload();
            }
        },

        handleTableClick(e) {
            if (e.target.classList.contains('editAtletBtn')) {
                const id = e.target.dataset.atletId;
                const row = e.target.closest('tr');
                const cells = row.querySelectorAll('td');
                
                document.querySelector('#atletForm [name="nama"]').value = cells[0].textContent;
                document.querySelector('#atletForm [name="jenisKelamin"]').value = cells[1].textContent;
                document.querySelector('#atletForm [name="level"]').value = cells[2].textContent.trim();
                
                document.getElementById('atletForm').dataset.id = id;
                document.getElementById('atletModalTitle').textContent = 'Edit Atlet';
                ModalManager.openModal('atletModal');
            } else if (e.target.classList.contains('deleteAtletBtn')) {
                const id = e.target.dataset.atletId;
                this.delete(id);
            }
        },

        async delete(id) {
            const row = document.querySelector(`[data-atlet-id="${id}"]`);
            const name = row?.querySelector('td')?.textContent || 'Atlet';
            window.deleteAtletId = id;
            document.getElementById('deleteAtletName').textContent = name;
            ModalManager.openModal('deleteAtletModal');
        }
    };

    // ===== KUDA MANAGER =====
    const KudaManager = {
        init() {
            document.getElementById('addKudaBtn').addEventListener('click', () => {
                document.getElementById('kudaForm').reset();
                document.getElementById('kudaModalTitle').textContent = 'Tambah Kuda';
                document.getElementById('kudaForm').dataset.id = '';
                ModalManager.openModal('kudaModal');
            });

            document.getElementById('kudaForm').addEventListener('submit', e => this.submit(e));
            document.getElementById('kudaTableBody').addEventListener('click', e => this.handleTableClick(e));
        },

        async submit(e) {
            e.preventDefault();
            const form = document.getElementById('kudaForm');
            const id = form.dataset.id;
            const url = id ? Config.routes.kuda.update.replace(':id', id) : Config.routes.kuda.store;
            const method = id ? 'PUT' : 'POST';

            const result = await FormHandler.submit('kudaForm', url, method);
            if (result.success) {
                ModalManager.closeModal('kudaModal');
                location.reload();
            }
        },

        handleTableClick(e) {
            if (e.target.classList.contains('editKudaBtn')) {
                const id = e.target.dataset.kudaId;
                const row = e.target.closest('tr');
                const cells = row.querySelectorAll('td');
                
                document.querySelector('#kudaForm [name="nama"]').value = cells[0].textContent;
                document.querySelector('#kudaForm [name="pasport"]').value = cells[1].textContent !== '-' ? cells[1].textContent : '';
                document.querySelector('#kudaForm [name="prestasi"]').value = '';
                document.querySelector('#kudaForm [name="pemilik"]').value = '';
                
                document.getElementById('kudaForm').dataset.id = id;
                document.getElementById('kudaModalTitle').textContent = 'Edit Kuda';
                ModalManager.openModal('kudaModal');
            } else if (e.target.classList.contains('deleteKudaBtn')) {
                const id = e.target.dataset.kudaId;
                this.delete(id);
            }
        },

        async delete(id) {
            const row = document.querySelector(`[data-kuda-id="${id}"]`);
            const name = row?.querySelector('td')?.textContent || 'Kuda';
            window.deleteKudaId = id;
            document.getElementById('deleteKudaName').textContent = name;
            ModalManager.openModal('deleteKudaModal');
        }
    };

    // ===== PELATIH MANAGER =====
    const PelatihManager = {
        async init() {
            await this.loadUsers();

            document.getElementById('addPelatihBtn').addEventListener('click', () => {
                document.getElementById('pelatihForm').reset();
                ModalManager.openModal('pelatihModal');
            });

            document.getElementById('pelatihForm').addEventListener('submit', e => this.submit(e));
            document.getElementById('pelatihTableBody').addEventListener('click', e => this.handleTableClick(e));
        },

        async loadUsers() {
            try {
                const response = await fetch(Config.routes.pelatih.users);
                const users = await response.json();
                
                const select = document.getElementById('pelatihUserSelect');
                select.innerHTML = '<option value="">Pilih Pelatih</option>';
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    select.appendChild(option);
                });
            } catch (error) {
                showToast('Gagal memuat data pelatih', 'error');
            }
        },

        async submit(e) {
            e.preventDefault();
            const result = await FormHandler.submit('pelatihForm', Config.routes.pelatih.store, 'POST');
            if (result.success) {
                ModalManager.closeModal('pelatihModal');
                location.reload();
            }
        },

        async handleTableClick(e) {
            if (e.target.classList.contains('togglePelatihBtn')) {
                const userId = e.target.dataset.pelatihUserId;
                const isActive = e.target.classList.contains('bg-green-100');
                this.toggleStatus(userId, !isActive);
            } else if (e.target.classList.contains('deletePelatihBtn')) {
                const userId = e.target.dataset.pelatihUserId;
                this.delete(userId);
            }
        },

        async toggleStatus(userId, isActive) {
            const url = Config.routes.pelatih.update.replace(':id', userId);
            
            try {
                const response = await fetch(url, {
                    method: 'PUT',
                    body: JSON.stringify({ isActive }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                const data = await response.json();
                if (response.ok) {
                    showToast(data.message || 'Status berhasil diubah', 'success');
                    location.reload();
                } else {
                    showToast(data.message || 'Gagal mengubah status', 'error');
                }
            } catch (error) {
                showToast(error.message, 'error');
            }
        },

        async delete(userId) {
            const row = document.querySelector(`[data-pelatih-user-id="${userId}"]`);
            const name = row?.querySelector('td')?.textContent || 'Pelatih';
            window.deletePelatihId = userId;
            document.getElementById('deletePelatihName').textContent = name;
            ModalManager.openModal('deletePelatihModal');
        }
    };

    // ===== INITIALIZE =====
    document.addEventListener('DOMContentLoaded', () => {
        AtletManager.init();
        KudaManager.init();
        PelatihManager.init();

        // Delete Atlet Handler
        document.querySelector('.confirm-delete-atlet')?.addEventListener('click', async () => {
            if (window.deleteAtletId) {
                const formData = new FormData();
                let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrfToken) formData.append('_token', csrfToken);
                formData.append('_method', 'DELETE');
                
                const url = Config.routes.atlet.destroy.replace(':id', window.deleteAtletId);
                const result = await FormHandler.submit('atletForm', url, 'DELETE');
                if (result.success) {
                    ModalManager.closeModal('deleteAtletModal');
                    location.reload();
                }
            }
        });

        // Delete Kuda Handler
        document.querySelector('.confirm-delete-kuda')?.addEventListener('click', async () => {
            if (window.deleteKudaId) {
                const url = Config.routes.kuda.destroy.replace(':id', window.deleteKudaId);
                const result = await FormHandler.submit('kudaForm', url, 'DELETE');
                if (result.success) {
                    ModalManager.closeModal('deleteKudaModal');
                    location.reload();
                }
            }
        });

        // Delete Pelatih Handler
        document.querySelector('.confirm-delete-pelatih')?.addEventListener('click', async () => {
            if (window.deletePelatihId) {
                const url = Config.routes.pelatih.destroy.replace(':id', window.deletePelatihId);
                
                let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    csrfToken = document.querySelector('input[name="_token"]')?.value;
                }
                
                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();
                    if (response.ok) {
                        ModalManager.closeModal('deletePelatihModal');
                        showToast(data.message || 'Pelatih berhasil dihapus', 'success');
                        location.reload();
                    } else {
                        showToast(data.message || 'Gagal menghapus pelatih', 'error');
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                }
            }
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') ModalManager.closeAllModals();
        });
    });

    // CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
    `;
    document.head.appendChild(style);
</script>

@endsection
