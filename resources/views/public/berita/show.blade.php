@extends('layouts.public')

@section('title', $berita->judul)

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.berita.index') }}" class="hover:text-white">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-white line-clamp-1">{{ $berita->judul }}</span>
            </nav>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Article -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        @if($berita->thumbnail)
                            <img src="{{ Storage::url($berita->thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-72 object-cover">
                        @endif
                        <div class="p-6 lg:p-8">
                            <div class="flex items-center gap-3 text-sm text-gray-500 mb-4">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                    {{ $berita->published_at->translatedFormat('d F Y') }}
                                </span>
                                @if($berita->author)
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                                    {{ $berita->author->name }}
                                </span>
                                @endif
                            </div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6 leading-snug">{{ $berita->judul }}</h1>
                            @if($berita->ringkasan)
                                <p class="text-gray-600 text-lg leading-relaxed border-l-4 border-green-500 pl-4 mb-6 italic">{{ $berita->ringkasan }}</p>
                            @endif
                            <div class="quill-display">
                                {!! $berita->isi_berita !!}
                            </div>
                        </div>
                    </article>

                    <div class="mt-6">
                        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-2 text-green-600 text-sm font-medium hover:underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>

                <!-- Sidebar: Related -->
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Berita Lainnya</h3>
                    @if($related->isEmpty())
                        <p class="text-sm text-gray-500">Belum ada berita lainnya.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($related as $item)
                            <a href="{{ route('public.berita.show', $item->slug) }}" class="block bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition group">
                                @if($item->thumbnail)
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-32 object-cover">
                                @else
                                    <div class="w-full h-32 bg-gradient-to-br from-green-100 to-green-200"></div>
                                @endif
                                <div class="p-4">
                                    <div class="text-xs text-gray-400 mb-1">{{ $item->published_at->translatedFormat('d F Y') }}</div>
                                    <div class="font-semibold text-gray-900 text-sm line-clamp-2 group-hover:text-green-600 transition">{{ $item->judul }}</div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
