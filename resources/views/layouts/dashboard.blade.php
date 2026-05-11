<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - PORDASI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        
        /* Mobile: Sidebar hidden by default */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }
            
            #sidebar.open {
                transform: translateX(0);
            }
        }
        
        /* Desktop: Sidebar always visible */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
            }
        }
        
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
        }
        
        .sidebar-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
        
        @media (min-width: 1024px) {
            .sidebar-overlay {
                display: none !important;
            }
        }
        
        body.sidebar-open {
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('layouts.components.sidebar')

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden w-full">
            <!-- Navbar -->
            @include('layouts.components.navbar')

            <!-- Page Content -->
            <div class="flex-1 overflow-auto">
                @yield('content')
            </div>

            <!-- Footer -->
            @include('layouts.components.footer')
        </main>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const body = document.body;

        // Toggle sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
            body.classList.toggle('sidebar-open');
        }

        // Click hamburger button
        sidebarToggle?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });

        // Click overlay to close
        sidebarOverlay?.addEventListener('click', () => {
            if (sidebar.classList.contains('open')) {
                toggleSidebar();
            }
        });

        // Close sidebar when clicking a link on mobile
        const sidebarLinks = sidebar?.querySelectorAll('a');
        sidebarLinks?.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024 && sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            });
        });

        // Ensure sidebar is visible on desktop resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar?.classList.remove('open');
                sidebarOverlay?.classList.remove('show');
                body.classList.remove('sidebar-open');
            }
        });
    </script>
</body>
</html>
