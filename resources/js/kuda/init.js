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

function setupFormHandlers() {
    document.getElementById('createForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value;

        try {
            const response = await fetch('/kuda', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData,
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, errors]) => {
                        const el = document.getElementById(`create${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        if (el) el.textContent = errors[0];
                    });
                } else {
                    showToast(data.message || 'Gagal menambah kuda', 'error');
                }
                return;
            }

            document.getElementById('createModal').classList.add('modal-hidden');
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        }
    });

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const kudaId = document.getElementById('editId').value;
        const formData = new FormData(e.target);
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value;

        try {
            const response = await fetch(`/kuda/${kudaId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: formData,
                credentials: 'same-origin',
            });

            const data = await response.json();

            if (!response.ok) {
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, errors]) => {
                        const el = document.getElementById(`edit${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        if (el) el.textContent = errors[0];
                    });
                } else {
                    showToast(data.message || 'Gagal mengupdate kuda', 'error');
                }
                return;
            }

            document.getElementById('editModal').classList.add('modal-hidden');
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
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
                btn.dataset.pemilik,
                btn.dataset.pasport,
                btn.dataset.prestasi,
                btn.dataset.keahlian,
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
    new TableHandler('kudaTable');
});
