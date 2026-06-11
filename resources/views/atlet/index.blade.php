@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Header Section -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold">Data Atlet</h2>
        <button class="create-btn px-4 py-2 bg-white text-green-600 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
            + Tambah Atlet
        </button>
    </div>
    <p class="text-green-100 text-sm sm:text-base">Kelola dan lihat data atlet</p>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8 flex flex-col">
    <!-- Filter Bar -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Atlet</label>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Ketik nama atlet..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                >
            </div>

            <!-- Filter Stable -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter Stable</label>
                <select
                    id="stableFilter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                >
                    <option value="">Semua Stable</option>
                </select>
            </div>

            <!-- Rows Per Page -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data Per Halaman</label>
                <select
                    id="itemsPerPage"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                >
                    <option value="5">5 Item</option>
                    <option value="10" selected>10 Item</option>
                    <option value="25">25 Item</option>
                    <option value="50">50 Item</option>
                </select>
            </div>

            <!-- Reset Filter -->
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
        <table id="atletTable" class="w-full">
            <thead>
                <tr>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">No</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Nama Atlet</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Stable</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Kabupaten</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Jenis Kelamin</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Level</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Alamat</th>
                    <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($atlet as $item)
                <tr class="hover:bg-gray-50 border-b border-gray-100 transition" data-stable-id="{{ $item->idStable }}">
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $item->nama }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->stable->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->stable->kabupaten->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->jenisKelamin }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->level ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $item->alamat ?? '-' }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="edit-btn p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition"
                                data-id="{{ $item->id }}"
                                data-stable="{{ $item->idStable }}"
                                data-nama="{{ $item->nama }}"
                                data-level="{{ $item->level }}"
                                data-jenis-kelamin="{{ $item->jenisKelamin }}"
                                data-tanggal-lahir="{{ $item->tanggal_lahir }}"
                                data-alamat="{{ $item->alamat }}"
                                title="Edit">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </button>
                            <button class="delete-btn p-2 text-red-600 hover:bg-red-100 rounded-lg transition"
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-500 py-8 text-sm">Tidak ada data atlet</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between px-4 py-4 bg-gray-50 border-t border-gray-100 gap-4">
            <div class="text-sm text-gray-600">
                Menampilkan <span id="startItem" class="font-semibold">1</span> hingga <span id="endItem" class="font-semibold">10</span> dari <span id="totalItems" class="font-semibold">{{ count($atlet) }}</span> data
            </div>
            <nav class="flex items-center gap-2" id="pagination">
                <button id="prevBtn" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">← Sebelumnya</button>
                <div id="pageNumbers" class="flex gap-1"></div>
                <button id="nextBtn" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">Selanjutnya →</button>
            </nav>
        </div>
    </div>
</div>

<!-- Modals -->
@include('atlet.partials.modal-create-atlet')
@include('atlet.partials.modal-edit-atlet')
@include('atlet.partials.modal-delete-atlet')

<!-- Scripts -->
@vite('resources/js/atlet/init.js')

@endsection
