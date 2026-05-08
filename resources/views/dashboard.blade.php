<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PORDASI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Mobile Menu Toggle -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="sidebarToggle" class="p-2 rounded-lg bg-gray-900 text-white hover:bg-gray-800">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V5zm0 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 5a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gray-900 text-white shadow-lg overflow-y-auto fixed h-screen lg:static lg:h-auto lg:block hidden lg:flex lg:flex-col z-40">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('favicon.png') }}" alt="Logo Pordasi" class="h-10 w-auto">
                    <div>
                        <h1 class="font-bold text-lg">PORDASI</h1>
                        <p class="text-xs text-gray-400">Berkuda Menanah</p>
                    </div>
                </div>
            </div>

            <!-- User Profile in Sidebar -->
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="p-4 space-y-2 flex-1">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h9m-9 3h6"/>
                    </svg>
                    Stable
                </a>

                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                    </svg>
                    Atlet
                </a>

                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                    </svg>
                    Kuda
                </a>

                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                    </svg>
                    Pelatih
                </a>

                <hr class="border-gray-700 my-4">

                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Beranda
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Navbar -->
            <nav class="bg-white shadow-md sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('favicon.png') }}" alt="Logo Pordasi" class="h-10 w-auto">
                            <div>
                                <h1 class="font-bold text-lg text-gray-900">PORDASI</h1>
                                <p class="text-xs text-gray-600">Berkuda Memanah Jambi</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-700 hidden sm:inline">{{ Auth::user()->name }}</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full hidden sm:inline">{{ Auth::user()->role }}</span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto">
                <!-- Welcome Section -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 sm:p-8">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-blue-100">Anda login sebagai <strong>{{ Auth::user()->role }}</strong></p>
                </div>

                <!-- Dashboard Content -->
                <div class="p-6 sm:p-8">
                    <!-- Dashboard Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Stable</p>
                                    <p class="text-3xl font-bold text-gray-900">4</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full flex-shrink-0">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h9m-9 3h6"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Atlet</p>
                                    <p class="text-3xl font-bold text-gray-900">57</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full flex-shrink-0">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Kuda</p>
                                    <p class="text-3xl font-bold text-gray-900">16</p>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full flex-shrink-0">
                                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Pelatih</p>
                                    <p class="text-3xl font-bold text-gray-900">10</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full flex-shrink-0">
                                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                        <div class="mb-4">
                            <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kelola Stable</h3>
                        <p class="text-gray-600 text-sm mb-4">Lihat dan kelola data stable yang terdaftar</p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Buka →</a>
                    </div>

                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                        <div class="mb-4">
                            <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kelola Atlet</h3>
                        <p class="text-gray-600 text-sm mb-4">Lihat dan kelola data atlet yang terdaftar</p>
                        <a href="#" class="text-green-600 hover:text-green-700 font-medium text-sm">Buka →</a>
                    </div>

                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                        <div class="mb-4">
                            <div class="bg-yellow-100 w-12 h-12 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kelola Kuda</h3>
                        <p class="text-gray-600 text-sm mb-4">Lihat dan kelola data kuda yang terdaftar</p>
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium text-sm">Buka →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-4 text-center text-xs sm:text-sm border-t border-gray-800">
                <p>&copy; 2026 PORDASI Berkuda Menanah Provinsi Jambi. Semua hak dilindungi.</p>
            </footer>
        </main>
    </div>

    <script>
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('block');
        });

        // Close sidebar when clicking on a link (mobile)
        const sidebarLinks = sidebar?.querySelectorAll('a');
        sidebarLinks?.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('block');
                }
            });
        });
    </script>
</body>
</html>
