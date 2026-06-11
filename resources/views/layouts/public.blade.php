<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PORDASI') - Berkuda Memanah Jambi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CKEditor / Quill content styles */
        .ck-content h1, .ql-editor h1 { font-size: 2em; font-weight: 700; margin: 0.67em 0; color: #111827; }
        .ck-content h2, .ql-editor h2 { font-size: 1.5em; font-weight: 700; margin: 0.75em 0; color: #111827; }
        .ck-content h3, .ql-editor h3 { font-size: 1.25em; font-weight: 600; margin: 0.83em 0; color: #111827; }
        .ck-content h4, .ql-editor h4 { font-size: 1.1em; font-weight: 600; margin: 1em 0; color: #111827; }
        .ck-content p, .ql-editor p { margin: 0.8em 0; line-height: 1.75; color: #374151; }
        .ck-content ul, .ql-editor ul { list-style-type: disc; padding-left: 1.5em; margin: 0.8em 0; color: #374151; }
        .ck-content ol, .ql-editor ol { list-style-type: decimal; padding-left: 1.5em; margin: 0.8em 0; color: #374151; }
        .ck-content li, .ql-editor li { margin: 0.3em 0; line-height: 1.75; }
        .ck-content blockquote, .ql-editor blockquote { border-left: 4px solid #16a34a; padding: 0.5em 1em; margin: 1em 0; color: #4b5563; background: #f9fafb; font-style: italic; }
        .ck-content a, .ql-editor a { color: #16a34a; text-decoration: underline; }
        .ck-content strong, .ql-editor strong { font-weight: 700; }
        .ck-content em, .ql-editor em { font-style: italic; }
        .ck-content img, .ql-editor img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1em 0; }
        .ck-content table, .ql-editor table { width: 100%; border-collapse: collapse; margin: 1em 0; font-size: 0.9em; }
        .ck-content table th, .ql-editor table th { background: #f3f4f6; font-weight: 600; padding: 0.6em 1em; border: 1px solid #e5e7eb; text-align: left; }
        .ck-content table td, .ql-editor table td { padding: 0.6em 1em; border: 1px solid #e5e7eb; }
        /* Quill specific */
        .quill-display h1 { font-size: 2em; font-weight: 700; margin: 0.67em 0; color: #111827; }
        .quill-display h2 { font-size: 1.5em; font-weight: 700; margin: 0.75em 0; color: #111827; }
        .quill-display h3 { font-size: 1.25em; font-weight: 600; margin: 0.83em 0; color: #111827; }
        .quill-display h4 { font-size: 1.1em; font-weight: 600; margin: 1em 0; color: #111827; }
        .quill-display p { margin: 0.8em 0; line-height: 1.75; color: #374151; }
        .quill-display ul { list-style-type: disc; padding-left: 1.5em; margin: 0.8em 0; color: #374151; }
        .quill-display ol { list-style-type: decimal; padding-left: 1.5em; margin: 0.8em 0; color: #374151; }
        .quill-display li { margin: 0.3em 0; line-height: 1.75; }
        .quill-display blockquote { border-left: 4px solid #16a34a; padding: 0.5em 1em; margin: 1em 0; color: #4b5563; background: #f9fafb; font-style: italic; }
        .quill-display a { color: #16a34a; text-decoration: underline; }
        .quill-display strong { font-weight: 700; }
        .quill-display em { font-style: italic; }
        .quill-display img { max-width: 100%; height: auto; border-radius: 0.5rem; margin: 1em 0; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('favicon.png') }}" alt="Logo PORDASI" class="h-10 w-auto">
                    <div>
                        <div class="font-bold text-base text-gray-900 leading-tight">PORDASI</div>
                        <div class="text-xs text-gray-500 leading-tight">Berkuda Memanah Jambi</div>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Beranda</a>
                    <a href="{{ route('public.profil') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('public.profil') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Profil</a>
                    <a href="{{ route('public.visi-misi') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('public.visi-misi') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Visi & Misi</a>
                    <a href="{{ route('public.stable.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('public.stable.*') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Daftar Stable</a>
                    <a href="{{ route('public.berita.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('public.berita.*') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Berita</a>
                    <a href="{{ route('public.kontak') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('public.kontak') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Kontak</a>
                </div>

                <!-- Right: Login / Dashboard -->
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">Login</a>
                    @endauth
                </div>

                <!-- Mobile hamburger -->
                <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                    <svg id="menuIconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="menuIconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden pb-4 border-t border-gray-100 pt-3">
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Beranda</a>
                    <a href="{{ route('public.profil') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('public.profil') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Profil</a>
                    <a href="{{ route('public.visi-misi') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('public.visi-misi') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Visi & Misi</a>
                    <a href="{{ route('public.stable.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('public.stable.*') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Daftar Stable</a>
                    <a href="{{ route('public.berita.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('public.berita.*') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Berita</a>
                    <a href="{{ route('public.kontak') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('public.kontak') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-100' }}">Kontak</a>
                    <hr class="my-2 border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium bg-green-600 text-white text-center">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg text-sm font-medium bg-green-600 text-white text-center">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('favicon.png') }}" alt="Logo PORDASI" class="h-10 w-auto">
                        <div>
                            <div class="font-bold text-lg">PORDASI</div>
                            <div class="text-xs text-gray-400">Berkuda Memanah Provinsi Jambi</div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Persatuan Olahraga berkuda memanah yang berkomitmen mengembangkan atlet berprestasi dan melestarikan budaya berkuda di Provinsi Jambi.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('public.profil') }}" class="text-gray-400 hover:text-white transition">Profil</a></li>
                        <li><a href="{{ route('public.visi-misi') }}" class="text-gray-400 hover:text-white transition">Visi & Misi</a></li>
                        <li><a href="{{ route('public.stable.index') }}" class="text-gray-400 hover:text-white transition">Daftar Stable</a></li>
                        <li><a href="{{ route('public.berita.index') }}" class="text-gray-400 hover:text-white transition">Berita</a></li>
                        <li><a href="{{ route('public.kontak') }}" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span>Jambi, Indonesia</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <span>info@pordasi-jambi.org</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} PORDASI Berkuda Memanah Provinsi Jambi. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        const iconOpen = document.getElementById('menuIconOpen');
        const iconClose = document.getElementById('menuIconClose');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>
