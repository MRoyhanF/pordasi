@extends('layouts.dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-green-100 text-sm sm:text-base">Anda login sebagai <strong>{{ Auth::user()->role }}</strong></p>
</div>

<!-- Dashboard Content -->
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-gray-600 text-xs sm:text-sm">Total Stable</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900">4</p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h9m-9 3h6"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div class="min-w-0">
                <p class="text-gray-600 text-xs sm:text-sm">Total Atlet</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900">57</p>
            </div>
            <div class="bg-green-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div class="min-w-0">
                <p class="text-gray-600 text-xs sm:text-sm">Total Kuda</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900">16</p>
            </div>
            <div class="bg-yellow-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div class="min-w-0">
                <p class="text-gray-600 text-xs sm:text-sm">Total Pelatih</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900">10</p>
            </div>
            <div class="bg-purple-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Menu Grid -->
    <div class="p-4 sm:p-6 lg:p-8 pt-0 sm:pt-0 lg:pt-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 sm:p-6">
                <div class="mb-4">
                    <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kelola Stable</h3>
                <p class="text-gray-600 text-sm mb-4">Lihat dan kelola data stable yang terdaftar</p>
                <a href="#" class="text-green-600 hover:text-green-700 font-medium text-sm">Buka →</a>
            </div>

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 sm:p-6">
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

            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 sm:p-6">
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
@endsection

