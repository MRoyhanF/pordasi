@extends('layouts.public')

@section('title', 'Berita')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">Berita</span>
            </nav>
            <h1 class="text-4xl font-bold">Berita & Informasi</h1>
            <p class="text-green-200 mt-2">Informasi terkini dari PORDASI Berkuda Memanah Provinsi Jambi</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($beritas->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="text-gray-500 text-lg">Belum ada berita tersedia.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($beritas as $berita)
                    <article class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition group flex flex-col">
                        @if($berita->thumbnail)
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-5 flex flex-col flex-1">
                            <div class="text-xs text-gray-400 mb-2">{{ $berita->published_at->translatedFormat('d F Y') }}</div>
                            <h2 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition flex-1">{{ $berita->judul }}</h2>
                            @if($berita->ringkasan)
                                <p class="text-sm text-gray-500 line-clamp-3 mb-4">{{ $berita->ringkasan }}</p>
                            @endif
                            <a href="{{ route('public.berita.show', $berita->slug) }}" class="mt-auto inline-flex items-center text-green-600 text-sm font-medium hover:underline">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $beritas->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
