@extends('layouts.dashboard')

@section('content')
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>
<script>window.stableId = {{ $stable->id }};</script>

<!-- Header -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex-1">
            <a href="{{ route('stable.index') }}" class="text-green-200 hover:text-white transition text-sm mb-2 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar Stable
            </a>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">{{ $stable->nama }}</h2>
            <p class="text-green-100 text-sm mt-1 flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                {{ $stable->kabupaten->name ?? '-' }}
            </p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('stable.edit', $stable->id) }}" class="px-4 py-2 bg-white text-green-700 rounded-lg hover:bg-green-50 transition text-sm font-medium flex items-center gap-2 whitespace-nowrap shadow">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                Edit Stable
            </a>
        </div>
    </div>
</div>

<div class="p-4 sm:p-6 lg:p-8 space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow border border-green-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 14.094A5.973 5.973 0 004 17v1H1v-1a3 3 0 013.75-2.906z"/></svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Total Atlet</p>
                <p class="text-3xl font-bold text-gray-900" id="atletCount">{{ $stable->atlets->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow border border-orange-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Total Pelatih</p>
                <p class="text-3xl font-bold text-gray-900" id="pelatihCount">{{ $stable->pelatih->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow border border-yellow-100 p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 24 24"><path d="M21 8c-1.5 0-2.5 1-3.5 2S16 12 14.5 12c-.5 0-1-.2-1.5-.4V9c0-.6-.4-1-1-1H9C8.4 8 8 8.4 8 9v1.6C7.5 10.2 7 10 6.5 10 5 10 4 11 3 12S1.5 14 0 14v2c2 0 3.5-1.5 4.5-2.5S6 12 6.5 12c.5 0 1 .2 1.5.4V17c0 .6.4 1 1 1h3c.6 0 1-.4 1-1v-1.6c.5.2 1 .4 1.5.4.5 0 1-.2 1.5-.5C17.5 16.5 19 18 21 18h1v-2c-1.5 0-2.5-1-3.5-2S17 12 17 12s1-.5 2-1.5 2-2.5 3-2.5V6c-2 0-3.5 1.5-4.5 2.5S16 10 15.5 10c-.5 0-1-.2-1.5-.4V9h-2v1.4c-.5-.2-1-.4-1.5-.4-.5 0-1 .2-1.5.5C8.5 9.5 7 8 5 8H4v2c1.5 0 2.5 1 3.5 2s1 2 1.5 2"/></svg>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide">Total Kuda</p>
                <p class="text-3xl font-bold text-gray-900" id="kudaCount">{{ $stable->kuda->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Stable -->
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-bold text-gray-900">Informasi Stable</h3>
            <button id="toggleDetailBtn" class="text-sm text-green-600 hover:text-green-700 font-medium flex items-center gap-1">
                <svg id="toggleDetailIcon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                Lihat Detail
            </button>
        </div>

        <!-- Info Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Nama Stable</p>
                <p class="text-gray-900 font-semibold">{{ $stable->nama }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Kabupaten / Kota</p>
                <p class="text-gray-900 font-semibold">{{ $stable->kabupaten->name ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Pemilik</p>
                <p class="text-gray-900 font-semibold">{{ $stable->pemilik }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Pimpinan Stable</p>
                <p class="text-gray-900 font-semibold">{{ $stable->pimpinan_stable }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Tahun Berdiri</p>
                <p class="text-gray-900 font-semibold">{{ $stable->mulai_berdiri ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Jumlah Kandang</p>
                <p class="text-gray-900 font-semibold">{{ $stable->jumlah_kandang ?? '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 md:col-span-2 lg:col-span-3">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Alamat Stable</p>
                <p class="text-gray-900 font-semibold">{{ $stable->alamat_stable }}</p>
            </div>
        </div>

        <!-- Detail Tambahan (tersembunyi by default) -->
        <div id="stableDetailExtra" class="hidden mt-5 pt-5 border-t">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Informasi Legalitas</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Alamat KTP Pemilik</p>
                    <p class="text-gray-900 font-semibold">{{ $stable->alamat_ktp_pemilik ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">No. Akte Badan Hukum</p>
                    <p class="text-gray-900 font-semibold">{{ $stable->no_akte_badan_hukum ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">No. Pengesahan Kumham</p>
                    <p class="text-gray-900 font-semibold">{{ $stable->no_pengesahan_kumham ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">NPWP</p>
                    <p class="text-gray-900 font-semibold">{{ $stable->npwp ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-1">Domisili Badan Hukum</p>
                    <p class="text-gray-900 font-semibold">{{ $stable->domisili_badan_hukum ?? '-' }}</p>
                </div>
            </div>
            @if($stable->frameMap)
            <div class="mt-5">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide mb-2">Peta Lokasi</p>
                <div class="rounded-lg overflow-hidden border border-gray-200">{!! $stable->frameMap !!}</div>
            </div>
            @endif
        </div>
    </div>

    <!-- Atlet Section -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900">Daftar Atlet</h3>
                    <p class="text-xs text-gray-500"><span id="atletBadge">{{ $stable->atlets->count() }}</span> atlet terdaftar</p>
                </div>
            </div>
            <div class="flex gap-2 items-center flex-wrap">
                <div class="relative">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="searchAtlet" placeholder="Cari atlet..." class="pl-9 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-44">
                </div>
                <select id="filterAtletStatus" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 w-48">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
                <button id="addAtletBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium flex items-center gap-1 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Tambah Atlet
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            @if($stable->atlets->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <th class="text-left px-5 py-3 font-semibold">Nama</th>
                        <th class="text-left px-5 py-3 font-semibold">Jenis Kelamin</th>
                        <th class="text-left px-5 py-3 font-semibold">Level</th>
                        <th class="text-left px-5 py-3 font-semibold">Tgl Lahir</th>
                        <th class="text-left px-5 py-3 font-semibold">Status</th>
                        <th class="text-left px-5 py-3 font-semibold">Prestasi</th>
                        <th class="text-center px-5 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="atletTableBody">
                    @foreach($stable->atlets as $atlet)
                    <tr class="border-t border-gray-100 hover:bg-green-50 transition atlet-row"
                        data-atlet-id="{{ $atlet->id }}"
                        data-atlet-nama="{{ $atlet->nama }}"
                        data-atlet-jenis="{{ $atlet->jenisKelamin ?? '' }}"
                        data-atlet-level="{{ $atlet->level ?? '' }}"
                        data-atlet-lahir="{{ $atlet->tanggal_lahir ?? '' }}"
                        data-atlet-alamat="{{ $atlet->alamat ?? '' }}"
                        data-atlet-status="{{ $atlet->status ?? '' }}"
                        data-atlet-prestasi="{{ $atlet->prestasi ?? '' }}">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-700 font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($atlet->nama, 0, 1)) }}
                                </div>
                                <span class="text-gray-900 font-medium text-sm">{{ $atlet->nama }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-700">
                            @if($atlet->jenisKelamin === 'Pria')
                                <span class="inline-flex items-center gap-1 text-blue-700"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>Pria</span>
                            @elseif($atlet->jenisKelamin === 'Wanita')
                                <span class="inline-flex items-center gap-1 text-pink-700"><svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>Wanita</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            @php
                                $levelColor = ['Mula' => 'bg-blue-100 text-blue-800', 'Madya' => 'bg-purple-100 text-purple-800', 'Wira' => 'bg-red-100 text-red-800'];
                                $color = $levelColor[$atlet->level] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-2 py-0.5 {{ $color }} rounded-full text-xs font-semibold">{{ $atlet->level ?? '-' }}</span>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-700">{{ $atlet->tanggal_lahir ? \Carbon\Carbon::parse($atlet->tanggal_lahir)->format('d M Y') : '-' }}</td>
                        <td class="px-5 py-3">
                            @if($atlet->status === 'aktif')
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                            @elseif($atlet->status === 'tidak_aktif')
                                <span class="px-2 py-0.5 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Tidak Aktif</span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-700 max-w-xs truncate">{{ $atlet->prestasi ?? '-' }}</td>
                        <td class="px-5 py-3 text-center">
                            <div class="flex gap-1.5 justify-center">
                                <button class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition editAtletBtn" data-atlet-id="{{ $atlet->id }}" title="Edit">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                </button>
                                <button class="p-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition deleteAtletBtn" data-atlet-id="{{ $atlet->id }}" title="Hapus">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="atletEmpty" class="hidden py-10 text-center text-gray-400 text-sm">Tidak ada atlet yang cocok dengan pencarian.</div>
            @else
            <div class="py-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1z"/></svg>
                <p class="text-gray-500 font-medium">Belum ada atlet di stable ini</p>
                <p class="text-gray-400 text-sm mt-1">Klik "Tambah Atlet" untuk menambahkan</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Kuda Section -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 24 24"><path d="M21 8c-1.5 0-2.5 1-3.5 2S16 12 14.5 12c-.5 0-1-.2-1.5-.4V9c0-.6-.4-1-1-1H9C8.4 8 8 8.4 8 9v1.6C7.5 10.2 7 10 6.5 10 5 10 4 11 3 12S1.5 14 0 14v2c2 0 3.5-1.5 4.5-2.5S6 12 6.5 12c.5 0 1 .2 1.5.4V17c0 .6.4 1 1 1h3c.6 0 1-.4 1-1v-1.6c.5.2 1 .4 1.5.4.5 0 1-.2 1.5-.5C17.5 16.5 19 18 21 18h1v-2c-1.5 0-2.5-1-3.5-2S17 12 17 12s1-.5 2-1.5 2-2.5 3-2.5V6c-2 0-3.5 1.5-4.5 2.5S16 10 15.5 10c-.5 0-1-.2-1.5-.4V9h-2v1.4c-.5-.2-1-.4-1.5-.4-.5 0-1 .2-1.5.5C8.5 9.5 7 8 5 8H4v2c1.5 0 2.5 1 3.5 2s1 2 1.5 2"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900">Daftar Kuda</h3>
                    <p class="text-xs text-gray-500"><span id="kudaBadge">{{ $stable->kuda->count() }}</span> kuda terdaftar</p>
                </div>
            </div>
            <div class="flex gap-2 items-center flex-wrap">
                <div class="relative">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="searchKuda" placeholder="Cari kuda..." class="pl-9 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 w-44">
                </div>
                <button id="addKudaBtn" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-medium flex items-center gap-1 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Tambah Kuda
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            @if($stable->kuda->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <th class="text-left px-5 py-3 font-semibold">Nama Kuda</th>
                        <th class="text-left px-5 py-3 font-semibold">Pasport</th>
                        <th class="text-left px-5 py-3 font-semibold">Pemilik</th>
                        <th class="text-left px-5 py-3 font-semibold">Keahlian</th>
                        <th class="text-left px-5 py-3 font-semibold">Prestasi</th>
                        <th class="text-center px-5 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kudaTableBody">
                    @foreach($stable->kuda as $k)
                    <tr class="border-t border-gray-100 hover:bg-yellow-50 transition kuda-row"
                        data-kuda-id="{{ $k->id }}"
                        data-kuda-nama="{{ $k->nama }}"
                        data-kuda-pasport="{{ $k->pasport ?? '' }}"
                        data-kuda-prestasi="{{ $k->prestasi ?? '' }}"
                        data-kuda-pemilik="{{ $k->pemilik ?? '' }}"
                        data-kuda-keahlian="{{ $k->keahlian ?? '' }}">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-700 font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($k->nama, 0, 1)) }}
                                </div>
                                <span class="text-gray-900 font-medium text-sm">{{ $k->nama }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-700">{{ $k->pasport ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm text-gray-700">{{ $k->pemilik ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm text-gray-700">{{ $k->keahlian ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm text-gray-700 max-w-xs truncate">{{ $k->prestasi ?? '-' }}</td>
                        <td class="px-5 py-3 text-center">
                            <div class="flex gap-1.5 justify-center">
                                <button class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition editKudaBtn" data-kuda-id="{{ $k->id }}" title="Edit">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                </button>
                                <button class="p-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition deleteKudaBtn" data-kuda-id="{{ $k->id }}" title="Hapus">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="kudaEmpty" class="hidden py-10 text-center text-gray-400 text-sm">Tidak ada kuda yang cocok dengan pencarian.</div>
            @else
            <div class="py-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M21 8c-1.5 0-2.5 1-3.5 2S16 12 14.5 12c-.5 0-1-.2-1.5-.4V9c0-.6-.4-1-1-1H9C8.4 8 8 8.4 8 9v1.6C7.5 10.2 7 10 6.5 10 5 10 4 11 3 12S1.5 14 0 14v2c2 0 3.5-1.5 4.5-2.5S6 12 6.5 12c.5 0 1 .2 1.5.4V17c0 .6.4 1 1 1h3c.6 0 1-.4 1-1v-1.6c.5.2 1 .4 1.5.4.5 0 1-.2 1.5-.5C17.5 16.5 19 18 21 18h1v-2c-1.5 0-2.5-1-3.5-2S17 12 17 12s1-.5 2-1.5 2-2.5 3-2.5V6c-2 0-3.5 1.5-4.5 2.5S16 10 15.5 10c-.5 0-1-.2-1.5-.4V9h-2v1.4c-.5-.2-1-.4-1.5-.4-.5 0-1 .2-1.5.5C8.5 9.5 7 8 5 8H4v2c1.5 0 2.5 1 3.5 2s1 2 1.5 2"/></svg>
                <p class="text-gray-500 font-medium">Belum ada kuda di stable ini</p>
                <p class="text-gray-400 text-sm mt-1">Klik "Tambah Kuda" untuk menambahkan</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Pelatih Section -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900">Daftar Pelatih</h3>
                    <p class="text-xs text-gray-500"><span id="pelatihBadge">{{ $stable->pelatih->count() }}</span> pelatih terdaftar</p>
                </div>
            </div>
            <div class="flex gap-2 items-center flex-wrap">
                <div class="relative">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="searchPelatih" placeholder="Cari pelatih..." class="pl-9 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 w-44">
                </div>
                <select id="filterPelatihStatus" class="px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="">Semua Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
                <button id="addPelatihBtn" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition text-sm font-medium flex items-center gap-1 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Tambah Pelatih
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            @if($stable->pelatih->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <th class="text-left px-5 py-3 font-semibold">Nama Pelatih</th>
                        <th class="text-left px-5 py-3 font-semibold">Email</th>
                        <th class="text-left px-5 py-3 font-semibold">Level</th>
                        <th class="text-center px-5 py-3 font-semibold">Status</th>
                        <th class="text-center px-5 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pelatihTableBody">
                    @foreach($stable->pelatih as $p)
                    <tr class="border-t border-gray-100 hover:bg-orange-50 transition pelatih-row"
                        data-pelatih-user-id="{{ $p->userId }}"
                        data-pelatih-nama="{{ $p->user->name ?? '' }}"
                        data-pelatih-level="{{ $p->level ?? '' }}"
                        data-pelatih-is-active="{{ $p->isActive ? '1' : '0' }}">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-700 font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($p->user->name ?? 'P', 0, 1)) }}
                                </div>
                                <span class="text-gray-900 font-medium text-sm">{{ $p->user->name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-700">{{ $p->user->email ?? '-' }}</td>
                        <td class="px-5 py-3">
                            @if($p->level)
                                <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">{{ $p->level }}</span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 rounded-full text-xs font-semibold togglePelatihBtn transition {{ $p->isActive ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}"
                                data-pelatih-user-id="{{ $p->userId }}">
                                {{ $p->isActive ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <div class="flex gap-1.5 justify-center">
                                <button class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition editPelatihBtn" data-pelatih-user-id="{{ $p->userId }}" title="Edit">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                </button>
                                <button class="p-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition deletePelatihBtn" data-pelatih-user-id="{{ $p->userId }}" title="Hapus">
                                    <svg class="w-4 h-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pelatihEmpty" class="hidden py-10 text-center text-gray-400 text-sm">Tidak ada pelatih yang cocok dengan pencarian.</div>
            @else
            <div class="py-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                <p class="text-gray-500 font-medium">Belum ada pelatih di stable ini</p>
                <p class="text-gray-400 text-sm mt-1">Klik "Tambah Pelatih" untuk menambahkan</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Metadata Footer -->
    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 flex flex-col sm:flex-row gap-4 text-sm">
        <div class="flex-1">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Dibuat pada</p>
            <p class="text-gray-700 font-semibold mt-1">{{ $stable->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="flex-1">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide">Terakhir diperbarui</p>
            <p class="text-gray-700 font-semibold mt-1">{{ $stable->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

</div>

<!-- Inline script for toggle detail & search -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toggle detail legalitas
    const toggleBtn = document.getElementById('toggleDetailBtn');
    const detailExtra = document.getElementById('stableDetailExtra');
    const toggleIcon = document.getElementById('toggleDetailIcon');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const hidden = detailExtra.classList.toggle('hidden');
            toggleBtn.querySelector('span') && null;
            toggleBtn.childNodes.forEach(n => { if (n.nodeType === 3) n.textContent = hidden ? ' Lihat Detail' : ' Sembunyikan'; });
            toggleIcon.style.transform = hidden ? '' : 'rotate(180deg)';
        });
    }

    function filterAtlet() {
        const q = document.getElementById('searchAtlet')?.value.toLowerCase() || '';
        const status = document.getElementById('filterAtletStatus')?.value || '';
        const rows = document.querySelectorAll('.atlet-row');
        let visible = 0;
        rows.forEach(r => {
            const nameMatch = r.dataset.atletNama?.toLowerCase().includes(q) ||
                              r.dataset.atletLevel?.toLowerCase().includes(q);
            const statusMatch = !status || r.dataset.atletStatus === status;
            const show = nameMatch && statusMatch;
            r.classList.toggle('hidden', !show);
            if (show) visible++;
        });
        document.getElementById('atletEmpty')?.classList.toggle('hidden', visible > 0);
    }
    document.getElementById('searchAtlet')?.addEventListener('input', filterAtlet);
    document.getElementById('filterAtletStatus')?.addEventListener('change', filterAtlet);

    // Search Kuda
    document.getElementById('searchKuda')?.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('.kuda-row');
        let visible = 0;
        rows.forEach(r => {
            const match = r.dataset.kudaNama?.toLowerCase().includes(q) ||
                          r.dataset.kudaPemilik?.toLowerCase().includes(q);
            r.classList.toggle('hidden', !match);
            if (match) visible++;
        });
        document.getElementById('kudaEmpty')?.classList.toggle('hidden', visible > 0);
    });

    // Search + Filter Pelatih
    function filterPelatih() {
        const q = document.getElementById('searchPelatih')?.value.toLowerCase() || '';
        const status = document.getElementById('filterPelatihStatus')?.value || '';
        const rows = document.querySelectorAll('.pelatih-row');
        let visible = 0;
        rows.forEach(r => {
            const nameMatch = r.dataset.pelatihNama?.toLowerCase().includes(q) ||
                              r.querySelectorAll('td')[1]?.textContent.toLowerCase().includes(q);
            const statusMatch = !status || r.dataset.pelatihIsActive === status;
            const show = nameMatch && statusMatch;
            r.classList.toggle('hidden', !show);
            if (show) visible++;
        });
        document.getElementById('pelatihEmpty')?.classList.toggle('hidden', visible > 0);
    }
    document.getElementById('searchPelatih')?.addEventListener('input', filterPelatih);
    document.getElementById('filterPelatihStatus')?.addEventListener('change', filterPelatih);
});
</script>

<!-- MODALS -->
@include('stable.partials.modal-create-atletstable')
@include('stable.partials.modal-delete-atletstable')
@include('stable.partials.modal-create-kudastable')
@include('stable.partials.modal-delete-kudastable')
@include('stable.partials.modal-create-pelatihstable')
@include('stable.partials.modal-edit-pelatihstable')
@include('stable.partials.modal-delete-pelatihstable')

@vite('resources/js/stable/show/init.js')
@endsection
