@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-green-700 via-green-600 to-green-800 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block px-3 py-1 bg-white/20 text-white text-xs font-semibold rounded-full mb-4 tracking-wide uppercase">Provinsi Jambi</span>
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
                        Selamat Datang di<br>
                        <span class="text-yellow-300">PORDASI</span> Jambi
                    </h1>
                    <p class="text-lg text-green-100 mb-8 leading-relaxed">
                        Persatuan Olahraga berkuda memanah yang berkomitmen mengembangkan atlet berprestasi dan melestarikan budaya berkuda di Provinsi Jambi.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('public.profil') }}" class="px-6 py-3 bg-white text-green-700 font-semibold rounded-lg hover:bg-green-50 transition shadow-md">
                            Tentang Kami
                        </a>
                        <a href="{{ route('public.stable.index') }}" class="px-6 py-3 bg-white/10 border border-white/30 text-white font-semibold rounded-lg hover:bg-white/20 transition">
                            Daftar Stable
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="{{ asset('favicon.png') }}" alt="Logo PORDASI" class="w-64 lg:w-80 drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center p-6 rounded-2xl bg-green-50 border border-green-100">
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ $stats['stable'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Stable Terdaftar</div>
                </div>
                <div class="text-center p-6 rounded-2xl bg-blue-50 border border-blue-100">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['atlet'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Total Atlet</div>
                </div>
                <div class="text-center p-6 rounded-2xl bg-yellow-50 border border-yellow-100">
                    <div class="text-4xl font-bold text-yellow-600 mb-2">{{ $stats['kuda'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Kuda Terdaftar</div>
                </div>
                <div class="text-center p-6 rounded-2xl bg-purple-50 border border-purple-100">
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ $stats['pelatih'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Pelatih Profesional</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">Mengenal PORDASI<br>Berkuda Memanah Jambi</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        PORDASI Berkuda Memanah Provinsi Jambi adalah organisasi olahraga yang berdedikasi dalam pembinaan dan pengembangan atlet berkuda memanah di wilayah Provinsi Jambi.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Kami berkomitmen untuk melestarikan olahraga berkuda sebagai bagian dari warisan budaya bangsa sekaligus mengembangkan prestasi atlet di tingkat nasional dan internasional.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('public.profil') }}" class="px-5 py-2.5 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition">Selengkapnya</a>
                        <a href="{{ route('public.visi-misi') }}" class="px-5 py-2.5 border border-green-600 text-green-600 rounded-lg text-sm font-medium hover:bg-green-50 transition">Visi & Misi</a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Pembinaan Atlet</h4>
                        <p class="text-xs text-gray-500">Program latihan terstruktur dan kompetisi berjenjang</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/></svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Sarana Modern</h4>
                        <p class="text-xs text-gray-500">Arena dan perlengkapan standar internasional</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Prestasi Nasional</h4>
                        <p class="text-xs text-gray-500">Mendorong atlet berprestasi di kejuaraan nasional</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/></svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Generasi Muda</h4>
                        <p class="text-xs text-gray-500">Menarik minat generasi muda untuk berkuda memanah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    @if($latestBerita->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Informasi Terkini</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">Berita Terbaru</h2>
                </div>
                <a href="{{ route('public.berita.index') }}" class="text-green-600 text-sm font-medium hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($latestBerita as $item)
                <article class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition group">
                    @if($item->thumbnail)
                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    <div class="p-5">
                        <div class="text-xs text-gray-400 mb-2">{{ $item->published_at->translatedFormat('d F Y') }}</div>
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition">{{ $item->judul }}</h3>
                        @if($item->ringkasan)
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $item->ringkasan }}</p>
                        @endif
                        <a href="{{ route('public.berita.show', $item->slug) }}" class="text-green-600 text-sm font-medium hover:underline">Baca Selengkapnya &rarr;</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Bergabunglah Bersama PORDASI Jambi</h2>
            <p class="text-green-100 text-lg mb-8 max-w-2xl mx-auto">Jadilah bagian dari komunitas berkuda memanah yang terus berkembang di Provinsi Jambi.</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('public.kontak') }}" class="px-6 py-3 bg-white text-green-700 font-semibold rounded-lg hover:bg-green-50 transition shadow-md">Hubungi Kami</a>
                <a href="{{ route('public.stable.index') }}" class="px-6 py-3 border border-white/40 text-white font-semibold rounded-lg hover:bg-white/10 transition">Lihat Stable</a>
            </div>
        </div>
    </section>
@endsection
