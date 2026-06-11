@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Set Stable ID for JavaScript -->
<script>window.stableId = {{ $stable->id }};</script>

<!-- Header Section -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-4">
        <div class="flex-1">
            <a href="{{ route('stable.index') }}" class="text-green-200 hover:text-white transition text-sm mb-2 inline-block">
                â† Kembali ke Daftar Stable
            </a>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">{{ $stable->nama }}</h2>
            <p class="text-green-100 text-sm mt-1">
                Kabupaten: <strong>{{ $stable->kabupaten->name ?? '-' }}</strong>
            </p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('stable.edit', $stable->id) }}" class="px-4 py-2 bg-white text-green-600 rounded-lg hover:bg-gray-100 transition text-sm font-medium flex items-center gap-2 whitespace-nowrap">
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
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition" 
                            data-atlet-id="{{ $atlet->id }}"
                            data-atlet-nama="{{ $atlet->nama }}"
                            data-atlet-jenis="{{ $atlet->jenisKelamin ?? '' }}"
                            data-atlet-level="{{ $atlet->level ?? '' }}"
                            data-atlet-lahir="{{ $atlet->tanggal_lahir ?? '' }}"
                            data-atlet-alamat="{{ $atlet->alamat ?? '' }}">
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
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Pasport</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Prestasi</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700">Pemilik</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kudaTableBody">
                        @foreach($stable->kuda as $k)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition" 
                            data-kuda-id="{{ $k->id }}"
                            data-kuda-nama="{{ $k->nama }}"
                            data-kuda-pasport="{{ $k->pasport ?? '' }}"
                            data-kuda-prestasi="{{ $k->prestasi ?? '' }}"
                            data-kuda-pemilik="{{ $k->pemilik ?? '' }}"
                            data-kuda-jenis="{{ $k->jenis ?? '' }}"
                            data-kuda-warna="{{ $k->warna ?? '' }}">
                            <td class="px-4 py-3 text-gray-900 font-medium">{{ $k->nama }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $k->pasport ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $k->prestasi ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $k->pemilik ?? '-' }}</td>
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
@include('stable.partials.modal-create-atletstable')
@include('stable.partials.modal-delete-atletstable')

@include('stable.partials.modal-create-kudastable')
@include('stable.partials.modal-delete-kudastable')

@include('stable.partials.modal-create-pelatihstable')
@include('stable.partials.modal-delete-pelatihstable')

<!-- Load Scripts -->
@vite('resources/js/stable/show/init.js')

@endsection
