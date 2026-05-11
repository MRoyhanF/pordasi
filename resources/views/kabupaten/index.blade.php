@extends('layouts.dashboard')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">Data Kabupaten / Kota</h2>
    <p class="text-blue-100 text-sm sm:text-base">Kelola dan lihat data per kabupaten/kota</p>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Search & Filter -->
    <form method="GET" class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="flex-1 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kabupaten..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">Cari</button>
            @if(request('search'))
                <a href="{{ route('kabupaten.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition text-sm font-medium">Reset</a>
            @endif
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">No</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Kabupaten / Kota</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Stable</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Atlet</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Pelatih</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Kuda</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($kabupaten as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition kabupaten-row" data-name="{{ strtolower($item->name) }}">
                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $kabupaten->firstItem() + $index }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center text-gray-700">
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                {{ $item->stables()->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center text-gray-700">
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                {{ $item->atlets()->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center text-gray-700">
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-semibold">
                                {{ $item->pelatih()->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center text-gray-700">
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                {{ $item->kuda()->count() }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-sm text-center">
                            <a href="{{ route('kabupaten.show', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                            <p class="text-sm">Tidak ada data kabupaten</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $kabupaten->appends(request()->query())->links() }}
    </div>
</div>
@endsection
