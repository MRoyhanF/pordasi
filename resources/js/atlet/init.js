import { showToast } from './toast.js';
import {
    openCreateModal,
    openEditModal,
    openDeleteModal,
    loadStable,
    initModalEventListeners,
} from './modal-functions.js';
import { TableHandler } from './table-handler.js';

function setupAnimations() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
        .modal-hidden { display: none !important; }
        .input-error { border-color: #ef4444 !important; }
    `;
    document.head.appendChild(style);
}

const errorFieldMap = {
    create: {
        idStable:      'createIdStableError',
        nama:          'createNamaError',
        jenisKelamin:  'createJenisKelaminError',
        level:         'createLevelError',
        status:        'createStatusError',
        tanggal_lahir: 'createTanggalLahirError',
        alamat:        'createAlamatError',
        prestasi:      'createPrestasiError',
    },
    edit: {
        idStable:      'editIdStableError',
        nama:          'editNamaError',
        jenisKelamin:  'editJenisKelaminError',
        level:         'editLevelError',
        status:        'editStatusError',
        tanggal_lahir: 'editTanggalLahirError',
        alamat:        'editAlamatError',
        prestasi:      'editPrestasiError',
    },
};

const inputFieldMap = {
    create: {
        idStable:      'createStable',
        nama:          'createNama',
        jenisKelamin:  'createJenisKelamin',
        level:         'createLevel',
        status:        'createStatus',
        tanggal_lahir: 'createTanggalLahir',
        alamat:        'createAlamat',
        prestasi:      'createPrestasi',
    },
    edit: {
        idStable:      'editStable',
        nama:          'editNama',
        jenisKelamin:  'editJenisKelamin',
        level:         'editLevel',
        status:        'editStatus',
        tanggal_lahir: 'editTanggalLahir',
        alamat:        'editAlamat',
        prestasi:      'editPrestasi',
    },
};

function showFieldErrors(prefix, errors) {
    Object.values(errorFieldMap[prefix]).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
    Object.values(inputFieldMap[prefix]).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('input-error');
    });

    Object.entries(errors).forEach(([field, messages]) => {
        const errorId = errorFieldMap[prefix][field];
        const inputId = inputFieldMap[prefix][field];
        if (errorId) {
            const errorEl = document.getElementById(errorId);
            if (errorEl) errorEl.textContent = messages[0];
        }
        if (inputId) {
            const inputEl = document.getElementById(inputId);
            if (inputEl) inputEl.classList.add('input-error');
        }
    });
}

function clearFieldErrors(prefix) {
    Object.values(errorFieldMap[prefix]).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
    Object.values(inputFieldMap[prefix]).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('input-error');
    });
}

function setupFormHandlers() {
    document.getElementById('createForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        clearFieldErrors('create');
        const formData = new FormData(e.target);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value;

        try {
            const response = await fetch('/atlet', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData,
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    showFieldErrors('create', data.errors);
                    showToast('Periksa kembali data yang diisi', 'error');
                } else {
                    showToast(data.message || 'Gagal menambah atlet', 'error');
                }
                return;
            }

            document.getElementById('createModal').classList.add('modal-hidden');
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan pada server', 'error');
        }
    });

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        clearFieldErrors('edit');
        const atletId = document.getElementById('editId').value;
        const formData = new FormData(e.target);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value;

        try {
            const response = await fetch(`/atlet/${atletId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData,
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    showFieldErrors('edit', data.errors);
                    showToast('Periksa kembali data yang diisi', 'error');
                } else {
                    showToast(data.message || 'Gagal mengupdate atlet', 'error');
                }
                return;
            }

            document.getElementById('editModal').classList.add('modal-hidden');
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan pada server', 'error');
        }
    });

    ['createStable', 'createNama', 'createJenisKelamin', 'createLevel', 'createStatus', 'createTanggalLahir', 'createAlamat', 'createPrestasi',
     'editStable', 'editNama', 'editJenisKelamin', 'editLevel', 'editStatus', 'editTanggalLahir', 'editAlamat', 'editPrestasi'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', () => el.classList.remove('input-error'));
            el.addEventListener('change', () => el.classList.remove('input-error'));
        }
    });
}

function setupButtonHandlers() {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('create-btn') || e.target.closest('.create-btn')) {
            openCreateModal();
        }
        if (e.target.closest('.edit-btn')) {
            const btn = e.target.closest('.edit-btn');
            openEditModal(
                btn.dataset.id,
                btn.dataset.stable,
                btn.dataset.nama,
                btn.dataset.jenisKelamin,
                btn.dataset.level,
                btn.dataset.tanggalLahir,
                btn.dataset.alamat,
                btn.dataset.status,
                btn.dataset.prestasi,
            );
        }
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            openDeleteModal(btn.dataset.id, btn.dataset.nama);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupAnimations();
    loadStable();
    initModalEventListeners();
    setupFormHandlers();
    setupButtonHandlers();
    new TableHandler('atletTable');
});
