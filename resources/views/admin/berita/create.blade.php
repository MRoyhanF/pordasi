@extends('layouts.dashboard')

@section('title', 'Tambah Berita')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-900 transition mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Berita</h1>
    </div>

    <form id="beritaForm" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm" placeholder="Masukkan judul berita">
                            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                            <textarea name="ringkasan" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm resize-none" placeholder="Ringkasan singkat berita (maks 500 karakter)">{{ old('ringkasan') }}</textarea>
                            @error('ringkasan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                            @error('isi_berita')<p class="text-red-500 text-xs mb-1">{{ $message }}</p>@enderror
                            <div id="quill-editor" style="min-height: 320px; font-size: 15px;"></div>
                            <textarea name="isi_berita" id="isi_berita" class="hidden">{{ old('isi_berita') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-4">Publikasi</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-sm bg-white">
                            <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" id="submitBtn" class="flex-1 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">Simpan</button>
                        <a href="{{ route('admin.berita.index') }}" class="flex-1 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition text-center">Batal</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-4">Thumbnail</h3>
                    <div id="thumbnailPreviewWrap" class="hidden mb-3">
                        <img id="thumbnailPreview" src="" alt="Preview" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — maks 2MB</p>
                        </div>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden">
                    </label>
                    @error('thumbnail')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </form>
</div>

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'blockquote'],
                [{ 'align': [] }],
                ['clean']
            ]
        },
        placeholder: 'Tulis isi berita di sini...'
    });

    // Load old content if validation failed
    var oldContent = document.getElementById('isi_berita').value;
    if (oldContent) {
        quill.root.innerHTML = oldContent;
    }

    document.getElementById('beritaForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var text = quill.getText().trim();
        if (!text) {
            alert('Isi berita tidak boleh kosong.');
            return;
        }
        document.getElementById('isi_berita').value = quill.root.innerHTML;
        this.submit();
    });

    document.getElementById('thumbnail').addEventListener('change', function (e) {
        var file = e.target.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('thumbnailPreview').src = ev.target.result;
            document.getElementById('thumbnailPreviewWrap').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
