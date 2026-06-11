@extends('layouts.public')

@section('title', 'Visi & Misi')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">Visi & Misi</span>
            </nav>
            <h1 class="text-4xl font-bold">Visi & Misi</h1>
            <p class="text-green-200 mt-2">Arah dan tujuan PORDASI Berkuda Memanah Provinsi Jambi</p>
        </div>
    </section>

    <!-- Visi -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Pandangan Ke Depan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Visi</h2>
            </div>
            <div class="relative bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-8 lg:p-12 text-white text-center shadow-xl">
                <div class="absolute top-4 left-6 text-white/20 text-8xl font-serif leading-none">"</div>
                <div class="relative z-10">
                    <p class="text-xl lg:text-2xl font-medium leading-relaxed">
                        Menjadi wadah unggulan pembinaan dan pengembangan olahraga berkuda memanah yang berprestasi, berbudaya, dan berdaya saing di tingkat nasional maupun internasional, dengan menjunjung tinggi sportivitas serta nilai-nilai luhur bangsa.
                    </p>
                </div>
                <div class="absolute bottom-4 right-6 text-white/20 text-8xl font-serif leading-none rotate-180">"</div>
            </div>
        </div>
    </section>

    <!-- Misi -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Langkah Nyata</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Misi</h2>
                <p class="text-gray-500 mt-3">Enam pilar misi PORDASI Jambi dalam mewujudkan visi organisasi</p>
            </div>
            <div class="space-y-5">
                <!-- Misi 1 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <span class="text-green-700 font-bold text-lg">1</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Pembinaan Atlet dan Pelatih</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Meningkatkan kualitas atlet dan pelatih berkuda memanah melalui program latihan terstruktur, kompetisi berjenjang, serta penguasaan teknik modern tanpa meninggalkan nilai tradisi.</p>
                    </div>
                </div>
                <!-- Misi 2 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <span class="text-blue-700 font-bold text-lg">2</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Pengembangan Sarana dan Prasarana</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Memfasilitasi ketersediaan arena, kuda, serta perlengkapan standar internasional untuk mendukung latihan dan kompetisi.</p>
                    </div>
                </div>
                <!-- Misi 3 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <span class="text-yellow-700 font-bold text-lg">3</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Pelestarian Budaya dan Identitas Bangsa</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Mengembangkan olahraga berkuda memanah sebagai bagian dari warisan budaya berkuda Nusantara dengan menanamkan nilai disiplin, keberanian, dan kehormatan.</p>
                    </div>
                </div>
                <!-- Misi 4 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <span class="text-red-700 font-bold text-lg">4</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Peningkatan Prestasi dan Kompetisi</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Mendorong keikutsertaan dalam kejuaraan nasional maupun internasional, serta menyelenggarakan event berkala untuk mencetak atlet berprestasi.</p>
                    </div>
                </div>
                <!-- Misi 5 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <span class="text-purple-700 font-bold text-lg">5</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Kerja Sama dan Jejaring</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Menjalin kolaborasi dengan lembaga pendidikan, komunitas, federasi internasional, dan pemerintah guna memperkuat ekosistem olahraga berkuda memanah.</p>
                    </div>
                </div>
                <!-- Misi 6 -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                        <span class="text-teal-700 font-bold text-lg">6</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">Pembinaan Generasi Muda</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Menarik minat generasi muda untuk mengenal, mencintai, dan mengembangkan olahraga berkuda memanah sebagai ajang pembentukan karakter positif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Bersama Mewujudkan Visi PORDASI Jambi</h3>
            <p class="text-gray-500 mb-6">Dukung pengembangan olahraga berkuda memanah di Provinsi Jambi.</p>
            <a href="{{ route('public.kontak') }}" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Hubungi Kami</a>
        </div>
    </section>
@endsection
