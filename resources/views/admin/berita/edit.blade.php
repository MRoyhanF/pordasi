@extends('layouts.dashboard')

@section('title', 'Edit Berita')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-900 transition mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
    </div>

    <form id="beritaForm" action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm">
                            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                            <textarea name="ringkasan" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm resize-none">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                            @error('ringkasan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita <span class="text-red-500">*</span></label>
                            @error('isi_berita')<p class="text-red-500 text-xs mb-1">{{ $message }}</p>@enderror
                            <div id="quill-editor" style="min-height: 320px; font-size: 15px;"></div>
                            <textarea name="isi_berita" id="isi_berita" class="hidden">{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-4">Publikasi</h3>
                    <div class="mb-3 text-xs text-gray-500">
                        Dibuat: {{ $berita->created_at->format('d M Y H:i') }}
                        @if($berita->published_at)
                            <br>Dipublish: {{ $berita->published_at->format('d M Y H:i') }}
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 text-sm bg-white">
                            <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $berita->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 py-2.5 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">Perbarui</button>
                        <a href="{{ route('admin.berita.index') }}" class="flex-1 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition text-center">Batal</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-4">Thumbnail</h3>
                    @if($berita->thumbnail)
                        <div class="mb-3">
                            <img id="thumbnailPreview" src="{{ Storage::url($berita->thumbnail) }}" alt="Thumbnail" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                            <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti gambar saat ini.</p>
                        </div>
                    @else
                        <div id="thumbnailPreviewWrap" class="hidden mb-3">
                            <img id="thumbnailPreview" src="" alt="Preview" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-5 text-center hover:border-green-400 transition">
                            <svg class="w-7 h-7 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-xs text-gray-500">Klik untuk upload gambar baru</p>
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
        }
    });

    // Load existing content
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
            var wrap = document.getElementById('thumbnailPreviewWrap');
            if (wrap) wrap.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
