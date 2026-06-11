@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold">{{ $kabupaten->name }}</h2>
        <a href="{{ route('kabupaten.index') }}" class="px-3 sm:px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg text-sm sm:text-base transition">
            ← Kembali
        </a>
    </div>
    <p class="text-green-100 text-sm sm:text-base">Lihat detail data untuk {{ $kabupaten->name }}</p>
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
                                <button class="edit-btn p-2 text-green-600 hover:bg-green-100 rounded-lg transition" 
                                    data-id="{{ $admin->idUser }}" data-name="{{ $admin->user->name }}" title="Edit">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </button>
                                <button class="delete-btn p-2 text-red-600 hover:bg-red-100 rounded-lg transition" 
                                    data-id="{{ $admin->idUser }}" data-name="{{ $admin->user->name }}" title="Hapus">
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


    <!-- Modals -->
    @include('kabupaten.partials.modal-edit-adminkabupaten')
    @include('kabupaten.partials.modal-delete-adminkabupaten')

    <!-- Set Kabupaten ID for JavaScript -->
    <script>
        window.kabupatanId = {{ $kabupaten->id }};
    </script>

    <!-- Scripts -->
    @vite('resources/js/kabupaten/admin-init.js')

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
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-gray-600 text-sm mb-2">Atlet Mula</p>
                    <p class="text-2xl font-bold text-green-600">{{ $kabupaten->atlets()->where('level', 'Mula')->count() }}</p>
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
