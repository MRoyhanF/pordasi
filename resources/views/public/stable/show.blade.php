@extends('layouts.public')

@section('title', $stable->nama)

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.stable.index') }}" class="hover:text-white">Daftar Stable</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $stable->nama }}</span>
            </nav>
            <h1 class="text-4xl font-bold">{{ $stable->nama }}</h1>
            <p class="text-green-200 mt-2">{{ $stable->kabupaten->name ?? '' }}</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="font-bold text-gray-900 text-xl mb-5">Informasi Stable</h2>
                        <div class="grid sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Nama Stable</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->nama }}</div>
                            </div>
                            <div>
                                <span class="text-gray-500">Kabupaten/Kota</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->kabupaten->name ?? '-' }}</div>
                            </div>
                            <div>
                                <span class="text-gray-500">Pemilik</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->pemilik }}</div>
                            </div>
                            <div>
                                <span class="text-gray-500">Pimpinan Stable</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->pimpinan_stable }}</div>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="text-gray-500">Alamat</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->alamat_stable }}</div>
                            </div>
                            @if($stable->mulai_berdiri)
                            <div>
                                <span class="text-gray-500">Mulai Berdiri</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->mulai_berdiri }}</div>
                            </div>
                            @endif
                            @if($stable->jumlah_kandang)
                            <div>
                                <span class="text-gray-500">Jumlah Kandang</span>
                                <div class="font-medium text-gray-900 mt-0.5">{{ $stable->jumlah_kandang }} Kandang</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pelatih -->
                    @if($pelatih->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="font-bold text-gray-900 text-xl mb-5">Pelatih Aktif</h2>
                        <div class="space-y-3">
                            @foreach($pelatih as $p)
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">{{ $p->user->name ?? '-' }}</div>
                                    @if($p->level)
                                    <div class="text-xs text-gray-500">Level {{ $p->level }}</div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Atlet -->
                    @if($stable->atlets->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="font-bold text-gray-900 text-xl mb-5">Daftar Atlet ({{ $stable->atlets->count() }})</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-100">
                                        <th class="text-left py-2 text-gray-500 font-medium">#</th>
                                        <th class="text-left py-2 text-gray-500 font-medium">Nama</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($stable->atlets as $i => $atlet)
                                    <tr>
                                        <td class="py-2 text-gray-400">{{ $i + 1 }}</td>
                                        <td class="py-2 font-medium text-gray-900">{{ $atlet->nama }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar Stats -->
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <h3 class="font-semibold text-gray-900 mb-4">Statistik Stable</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="text-sm text-gray-600">Total Atlet</span>
                                <span class="text-xl font-bold text-blue-600">{{ $stable->atlets->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                <span class="text-sm text-gray-600">Total Kuda</span>
                                <span class="text-xl font-bold text-yellow-600">{{ $stable->kuda->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                                <span class="text-sm text-gray-600">Total Pelatih</span>
                                <span class="text-xl font-bold text-purple-600">{{ $pelatih->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('public.stable.index') }}" class="block text-center px-4 py-2.5 border border-green-600 text-green-600 text-sm font-medium rounded-lg hover:bg-green-600 hover:text-white transition">
                        &larr; Kembali ke Daftar Stable
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
