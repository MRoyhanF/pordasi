@extends('layouts.dashboard')

@section('content')
<!-- Toast Container -->
<div id="toastContainer" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2"></div>

<!-- Header Section -->
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex-1">
            <a href="{{ route('stable.show', $stable->id) }}" class="text-green-200 hover:text-white transition text-sm mb-2 inline-block">
                ← Kembali ke Detail Stable
            </a>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">Edit Stable</h2>
            <p class="text-green-100 text-sm mt-1">{{ $stable->nama }}</p>
        </div>
    </div>
</div>

<!-- Content -->
<div class="p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-6 sm:p-8">
            <form id="editStableForm" method="POST" action="{{ route('stable.update', $stable->id) }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Row 1: Kabupaten and Nama Stable -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="idKabupaten" class="block text-sm font-medium text-gray-700 mb-2">
                                Kabupaten / Kota <span class="text-red-500">*</span>
                            </label>
                            <select id="idKabupaten" name="idKabupaten" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                <option value="">Pilih Kabupaten</option>
                                @foreach($kabupaten as $kab)
                                    <option value="{{ $kab->id }}" {{ $stable->idKabupaten == $kab->id ? 'selected' : '' }}>
                                        {{ $kab->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="idKabupatenerror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Stable <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ $stable->nama }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <span id="namaerror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                    </div>

                    <!-- Row 2: Pemilik and Pimpinan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pemilik" class="block text-sm font-medium text-gray-700 mb-2">
                                Pemilik Stable <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pemilik" name="pemilik" value="{{ $stable->pemilik }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <span id="pemilkerror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>

                        <div>
                            <label for="pimpinan_stable" class="block text-sm font-medium text-gray-700 mb-2">
                                Pimpinan Stable <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="pimpinan_stable" name="pimpinan_stable" value="{{ $stable->pimpinan_stable }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <span id="pimpinan_stableerror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                    </div>

                    <!-- Row 3: Tahun Berdiri and Jumlah Kandang -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="mulai_berdiri" class="block text-sm font-medium text-gray-700 mb-2">
                                Tahun Berdiri
                            </label>
                            <input type="number" id="mulai_berdiri" name="mulai_berdiri" value="{{ $stable->mulai_berdiri }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" min="1900" max="{{ date('Y') }}" placeholder="Contoh: 2020">
                            <span id="mulai_berdiriererror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>

                        <div>
                            <label for="jumlah_kandang" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Kandang
                            </label>
                            <input type="number" id="jumlah_kandang" name="jumlah_kandang" value="{{ $stable->jumlah_kandang }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" min="1" placeholder="Contoh: 10">
                            <span id="jumlah_kandangerror" class="text-red-500 text-sm mt-1 block"></span>
                        </div>
                    </div>

                    <!-- Alamat Stable -->
                    <div>
                        <label for="alamat_stable" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Stable <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat_stable" name="alamat_stable" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>{{ $stable->alamat_stable }}</textarea>
                        <span id="alamat_stableerror" class="text-red-500 text-sm mt-1 block"></span>
                    </div>

                    <!-- Optional Fields (Collapsible) -->
                    <details class="border-t pt-6">
                        <summary class="text-sm font-medium text-gray-700 cursor-pointer hover:text-gray-900">
                            ⚙️ Field Opsional
                        </summary>
                        
                        <div class="space-y-6 mt-6">
                            <!-- Alamat KTP Pemilik -->
                            <div>
                                <label for="alamat_ktp_pemilik" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat KTP Pemilik
                                </label>
                                <textarea id="alamat_ktp_pemilik" name="alamat_ktp_pemilik" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $stable->alamat_ktp_pemilik }}</textarea>
                            </div>

                            <!-- Row: Akte and Pengesahan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_akte_badan_hukum" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Akte Badan Hukum
                                    </label>
                                    <input type="text" id="no_akte_badan_hukum" name="no_akte_badan_hukum" value="{{ $stable->no_akte_badan_hukum }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>

                                <div>
                                    <label for="no_pengesahan_kumham" class="block text-sm font-medium text-gray-700 mb-2">
                                        No. Pengesahan KUMHAM
                                    </label>
                                    <input type="text" id="no_pengesahan_kumham" name="no_pengesahan_kumham" value="{{ $stable->no_pengesahan_kumham }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                </div>
                            </div>

                            <!-- Row: NPWP and Domisili -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="npwp" class="block text-sm font-medium text-gray-700 mb-2">
                                        NPWP
                                    </label>
                                    <input type="text" id="npwp" name="npwp" value="{{ $stable->npwp }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: 00.000.000/0000-00">
                                </div>

                                <div>
                                    <label for="domisili_badan_hukum" class="block text-sm font-medium text-gray-700 mb-2">
                                        Domisili Badan Hukum
                                    </label>
                                    <textarea id="domisili_badan_hukum" name="domisili_badan_hukum" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $stable->domisili_badan_hukum }}</textarea>
                                </div>
                            </div>
                        </div>
                    </details>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-6 border-t">
                        <a href="{{ route('stable.show', $stable->id) }}" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium text-center">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">
                <strong>ℹ️ Catatan:</strong> Field yang bertanda merah <span class="text-red-500">*</span> harus diisi. Kolom lainnya bersifat opsional.
            </p>
        </div>
    </div>
</div>

<script>
    // ===== TOAST NOTIFICATION =====
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        const icon = type === 'success' 
            ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
            : '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>';
        
        toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center gap-3 min-w-sm animate-fade-in`;
        toast.innerHTML = `${icon}<span>${message}</span>`;
        
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // ===== FORM HANDLER =====
    document.getElementById('editStableForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                // Clear all previous errors
                document.querySelectorAll('[id$="error"]').forEach(el => el.textContent = '');
                
                // Display validation errors
                if (data.errors) {
                    Object.entries(data.errors).forEach(([field, messages]) => {
                        const errorEl = document.getElementById(field + 'error');
                        if (errorEl) {
                            errorEl.textContent = Array.isArray(messages) ? messages[0] : messages;
                        }
                    });
                }
                
                showToast(data.message || 'Gagal menyimpan perubahan', 'error');
                return;
            }

            showToast(data.message || 'Stable berhasil diperbarui', 'success');
            setTimeout(() => {
                window.location.href = '{{ route("stable.show", $stable->id) }}';
            }, 1000);
        } catch (error) {
            showToast(error.message || 'Terjadi kesalahan', 'error');
        }
    });

    // ===== ANIMATION =====
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
    `;
    document.head.appendChild(style);
</script>

@endsection
