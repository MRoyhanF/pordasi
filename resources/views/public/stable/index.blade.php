@extends('layouts.public')

@section('title', 'Daftar Stable')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">Daftar Stable</span>
            </nav>
            <h1 class="text-4xl font-bold">Daftar Stable</h1>
            <p class="text-green-200 mt-2">Seluruh stable berkuda memanah yang terdaftar di PORDASI Jambi</p>
        </div>
    </section>

    <!-- Filter & Search -->
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('public.stable.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Stable</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm" placeholder="Nama atau alamat stable...">
                    </div>
                </div>
                <div class="min-w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                    <select name="kabupaten" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm bg-white">
                        <option value="">Semua Wilayah</option>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}" {{ request('kabupaten') == $kab->id ? 'selected' : '' }}>{{ $kab->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-5 py-2.5 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">Cari</button>
                    @if(request()->hasAny(['search', 'kabupaten']))
                        <a href="{{ route('public.stable.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Stable Grid -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($stables->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <p class="text-gray-500 text-lg">Tidak ada stable ditemukan.</p>
                    <a href="{{ route('public.stable.index') }}" class="mt-4 inline-block text-green-600 text-sm hover:underline">Tampilkan semua</a>
                </div>
            @else
                <div class="mb-4 text-sm text-gray-500">Menampilkan {{ $stables->firstItem() }}–{{ $stables->lastItem() }} dari {{ $stables->total() }} stable</div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($stables as $stable)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition overflow-hidden group">
                        <div class="h-40 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center relative">
                            <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 bg-green-600 text-white text-xs font-medium rounded-full">{{ $stable->kabupaten->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 text-lg mb-1 group-hover:text-green-600 transition">{{ $stable->nama }}</h3>
                            <p class="text-sm text-gray-500 mb-4 flex items-start gap-1.5">
                                <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                {{ Str::limit($stable->alamat_stable, 60) }}
                            </p>
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="text-center p-2 bg-blue-50 rounded-lg">
                                    <div class="text-lg font-bold text-blue-600">{{ $stable->atlets->count() }}</div>
                                    <div class="text-xs text-gray-500">Atlet</div>
                                </div>
                                <div class="text-center p-2 bg-yellow-50 rounded-lg">
                                    <div class="text-lg font-bold text-yellow-600">{{ $stable->kuda->count() }}</div>
                                    <div class="text-xs text-gray-500">Kuda</div>
                                </div>
                                <div class="text-center p-2 bg-purple-50 rounded-lg">
                                    <div class="text-lg font-bold text-purple-600">{{ \App\Models\Pelatih::where('stableId', $stable->id)->count() }}</div>
                                    <div class="text-xs text-gray-500">Pelatih</div>
                                </div>
                            </div>
                            <a href="{{ route('public.stable.show', $stable) }}" class="block w-full text-center py-2 border border-green-600 text-green-600 text-sm font-medium rounded-lg hover:bg-green-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $stables->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
