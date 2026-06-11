<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORDASI Berkuda Memanah Provinsi Jambi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('favicon.png') }}" alt="Logo Pordasi" class="h-12 w-auto">
                    <div>
                        <h1 class="font-bold text-lg text-gray-900">PORDASI</h1>
                        <p class="text-xs text-gray-600">Berkuda Memanah Jambi</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="py-16 bg-gradient-to-r from-green-600 to-green-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-12">
                    <div class="flex-1">
                        <h2 class="text-5xl font-bold mb-4">Selamat Datang di PORDASI</h2>
                        <p class="text-xl text-blue-100 mb-8">Persatuan Olahraga Daerah Atletik Silang Jabang Indonesia - Provinsi Jambi</p>
                        <p class="text-lg text-blue-100 mb-8">Organisasi olahraga berkuda dan memanah terkemuka di Provinsi Jambi yang berkomitmen mengembangkan bakat atlet.</p>
                        @guest
                            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-white text-green-600 font-bold rounded-lg hover:bg-gray-100">Masuk Sekarang</a>
                        @endguest
                    </div>
                    <div class="flex-1">
                        <img src="{{ asset('favicon.png') }}" alt="Logo PORDASI" class="w-full max-w-md">
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center mb-12">Statistik Kami</h3>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600">4</div>
                    <p class="text-gray-600 mt-2">Stable Terdaftar</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600">57</div>
                    <p class="text-gray-600 mt-2">Total Atlet</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600">16</div>
                    <p class="text-gray-600 mt-2">Kuda Berkualitas</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600">10</div>
                    <p class="text-gray-600 mt-2">Pelatih Profesional</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold mb-8">Tentang PORDASI</h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xl font-bold text-green-600 mb-4">Visi</h4>
                    <p class="text-gray-700 leading-relaxed">Menjadi organisasi olahraga berkuda dan memanah terdepan di Indonesia yang menghasilkan atlet berprestasi dan berwawasan global.</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-green-600 mb-4">Misi</h4>
                    <p class="text-gray-700 leading-relaxed">Mengembangkan talenta atlet melalui pelatihan profesional, memfasilitasi kompetisi berkualitas, dan mempromosikan olahraga berkuda serta memanah di Provinsi Jambi.</p>
                </div>
            </div>
        </div>
    </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2026 PORDASI Berkuda Memanah Provinsi Jambi. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
