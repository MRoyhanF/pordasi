@extends('layouts.dashboard')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex items-center justify-between mb-2">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold">Edit Kabupaten / Kota</h2>
        <a href="{{ route('kabupaten.index') }}" class="px-4 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg text-sm font-medium transition">
            ← Kembali
        </a>
    </div>
    <p class="text-blue-100 text-sm sm:text-base">Edit data kabupaten/kota</p>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8">
    <div class="max-w-2xl">
        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <form action="{{ route('kabupaten.update', $kabupaten->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kabupaten / Kota</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $kabupaten->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Jambi" required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('kabupaten.index') }}" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
