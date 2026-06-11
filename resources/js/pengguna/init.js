import { showToast } from './toast.js';
import {
    openCreateModal,
    openEditModal,
    openDeleteModal,
    closeCreateModal,
    closeEditModal,
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
    `;
    document.head.appendChild(style);
}

function setupFormHandlers() {
    const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    document.getElementById('createForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch('/pengguna', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
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
                    showToast(data.message || 'Gagal menambah pengguna', 'error');
                }
                return;
            }

            closeCreateModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch {
            showToast('Terjadi kesalahan', 'error');
        }
    });

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const userId = document.getElementById('editId').value;
        const formData = new FormData(e.target);

        try {
            const response = await fetch(`/pengguna/${userId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken(), 'Accept': 'application/json' },
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
                    showToast(data.message || 'Gagal memperbarui pengguna', 'error');
                }
                return;
            }

            closeEditModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch {
            showToast('Terjadi kesalahan', 'error');
        }
    });
}

function setupButtonHandlers() {
    document.addEventListener('click', (e) => {
        if (e.target.closest('.create-btn')) openCreateModal();

        const editBtn = e.target.closest('.edit-btn');
        if (editBtn) {
            openEditModal(
                editBtn.dataset.id,
                editBtn.dataset.name,
                editBtn.dataset.email,
                editBtn.dataset.role,
            );
        }

        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) openDeleteModal(deleteBtn.dataset.id, deleteBtn.dataset.name);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setupAnimations();
    initModalEventListeners();
    setupFormHandlers();
    setupButtonHandlers();
    new TableHandler('penggunaTable');
});
