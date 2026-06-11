@extends('layouts.public')

@section('title', 'Profil PORDASI Jambi')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-green-700 to-green-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-green-200 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-white">Profil</span>
            </nav>
            <h1 class="text-4xl font-bold">Profil PORDASI Jambi</h1>
            <p class="text-green-200 mt-2">Persatuan Olahraga Berkuda Memanah Provinsi Jambi</p>
        </div>
    </section>

    <!-- Sejarah Singkat -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Sejarah Singkat</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">Tentang PORDASI Berkuda Memanah Provinsi Jambi</h2>
                    <div class="prose prose-gray max-w-none space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            PORDASI (Persatuan Olahraga Berkuda Memanah Seluruh Indonesia) Provinsi Jambi merupakan organisasi olahraga yang dibentuk untuk menaungi, membina, dan mengembangkan olahraga berkuda memanah di wilayah Provinsi Jambi. Organisasi ini hadir sebagai wadah resmi yang menghubungkan seluruh stable, atlet, dan pelatih berkuda memanah di Jambi.
                        </p>
                        <p>
                            Olahraga berkuda memanah merupakan perpaduan antara seni berkuda dan olahraga memanah yang telah lama dikenal dalam tradisi budaya Nusantara. Melalui PORDASI Jambi, olahraga ini tidak hanya dilestarikan sebagai warisan budaya, tetapi juga dikembangkan sebagai cabang olahraga berprestasi yang mampu bersaing di tingkat nasional maupun internasional.
                        </p>
                        <p>
                            Dengan dukungan dari pemerintah daerah, komunitas berkuda, dan para penggemar olahraga berkuda memanah, PORDASI Jambi terus berupaya memperluas jangkauan pembinaan ke seluruh kabupaten dan kota di Provinsi Jambi, mencetak atlet-atlet berbakat yang siap membawa nama baik daerah.
                        </p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-green-50 border border-green-100 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm">Nama Organisasi</h4>
                        </div>
                        <p class="text-sm text-gray-600">PORDASI Berkuda Memanah Provinsi Jambi</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm">Wilayah</h4>
                        </div>
                        <p class="text-sm text-gray-600">Provinsi Jambi, Indonesia</p>
                    </div>
                    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 text-sm">Bidang</h4>
                        </div>
                        <p class="text-sm text-gray-600">Olahraga Berkuda Memanah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tujuan Organisasi -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Tujuan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Tujuan Organisasi</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Pembinaan Atlet</h3>
                    <p class="text-sm text-gray-500">Mencetak atlet berkuda memanah berprestasi melalui program pembinaan terstruktur dan berkesinambungan.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Pelestarian Budaya</h3>
                    <p class="text-sm text-gray-500">Menjaga dan melestarikan olahraga berkuda memanah sebagai warisan budaya bangsa yang bernilai tinggi.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-yellow-600" fill="currentColor" viewBox="0 0 20 20"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Prestasi Nasional</h3>
                    <p class="text-sm text-gray-500">Mendorong atlet Jambi untuk berprestasi di kejuaraan nasional dan internasional demi kebanggaan daerah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wide">Kepengurusan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Struktur Organisasi</h2>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto">PORDASI Berkuda Memanah Provinsi Jambi dikelola oleh pengurus yang berpengalaman dan berdedikasi di bidang olahraga berkuda memanah.</p>
            </div>
            <div class="max-w-3xl mx-auto">
                <div class="flex flex-col items-center gap-4">
                    <!-- Top -->
                    <div class="bg-green-600 text-white rounded-xl px-8 py-4 text-center shadow-md">
                        <div class="text-xs text-green-200 uppercase tracking-wide mb-1">Pimpinan Tertinggi</div>
                        <div class="font-bold text-lg">Ketua Umum</div>
                    </div>
                    <div class="w-0.5 h-6 bg-gray-300"></div>
                    <!-- Second -->
                    <div class="grid grid-cols-2 gap-6 w-full max-w-xl">
                        <div class="bg-green-50 border border-green-200 rounded-xl px-6 py-4 text-center">
                            <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">Sekretariat</div>
                            <div class="font-semibold text-gray-900">Sekretaris Umum</div>
                        </div>
                        <div class="bg-green-50 border border-green-200 rounded-xl px-6 py-4 text-center">
                            <div class="text-xs text-gray-500 uppercase tracking-wide mb-1">Keuangan</div>
                            <div class="font-semibold text-gray-900">Bendahara Umum</div>
                        </div>
                    </div>
                    <div class="w-0.5 h-6 bg-gray-300"></div>
                    <!-- Bidang -->
                    <div class="grid grid-cols-3 gap-4 w-full">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center">
                            <div class="text-xs text-gray-500 mb-1">Bidang</div>
                            <div class="font-medium text-gray-900 text-sm">Pembinaan & Prestasi</div>
                        </div>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center">
                            <div class="text-xs text-gray-500 mb-1">Bidang</div>
                            <div class="font-medium text-gray-900 text-sm">Sarana & Prasarana</div>
                        </div>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center">
                            <div class="text-xs text-gray-500 mb-1">Bidang</div>
                            <div class="font-medium text-gray-900 text-sm">Hubungan Masyarakat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Peran PORDASI -->
    <section class="py-16 bg-gradient-to-br from-green-700 to-green-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-300 font-semibold text-sm uppercase tracking-wide">Kontribusi</span>
                <h2 class="text-3xl font-bold mt-2">Peran PORDASI dalam Olahraga Jambi</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-300 mb-2">Regulasi</div>
                    <p class="text-green-100 text-sm">Menetapkan standar dan regulasi kompetisi berkuda memanah di Provinsi Jambi</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-300 mb-2">Sertifikasi</div>
                    <p class="text-green-100 text-sm">Memberikan lisensi resmi bagi pelatih dan atlet yang memenuhi standar kompetensi</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-300 mb-2">Kompetisi</div>
                    <p class="text-green-100 text-sm">Menyelenggarakan kejuaraan regional dan mewakili Jambi di kejuaraan nasional</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center border border-white/20">
                    <div class="text-3xl font-bold text-yellow-300 mb-2">Koordinasi</div>
                    <p class="text-green-100 text-sm">Menjadi jembatan antara stable, atlet, pemerintah, dan federasi nasional</p>
                </div>
            </div>
        </div>
    </section>
@endsection
