<aside id="sidebar" class="w-64 bg-gray-900 text-white shadow-lg overflow-y-auto fixed lg:static lg:translate-x-0 h-screen lg:h-auto flex flex-col z-40">
    <!-- Header -->
    @include('components.sidebar.header')

    <!-- Dynamic Menu based on User Role -->
    @switch(Auth::user()->role)
        @case('SuperAdmin')
            @include('components.sidebar.super-admin-menu')
            @break
        @case('Admin')
            @include('components.sidebar.admin-menu')
            @break
        @case('Pelatih')
            @include('components.sidebar.pelatih-menu')
            @break
        @case('Viewer')
            @include('components.sidebar.viewer-menu')
            @break
        @default
            @include('components.sidebar.admin-menu')
    @endswitch

    <!-- Footer -->
    @include('components.sidebar.footer')
</aside>
