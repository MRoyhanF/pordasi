import { showToast } from './toast.js';

let deleteId = null;

export function openCreateModal() {
    document.getElementById('createModal').classList.remove('modal-hidden');
    document.getElementById('createForm').reset();
    clearErrors('create');
}

export function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

export function openEditModal(id, name, email, role) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    document.getElementById('editPassword').value = '';
    document.getElementById('editPasswordConfirmation').value = '';
    clearErrors('edit');
}

export function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

export function openDeleteModal(id, name) {
    deleteId = id;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

export function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    deleteId = null;
}

export function confirmDelete() {
    if (!deleteId) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    fetch(`/pengguna/${deleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        credentials: 'same-origin',
    })
    .then(res => res.json())
    .then(data => {
        closeDeleteModal();
        if (data.success) {
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast(data.message || 'Gagal menghapus pengguna', 'error');
        }
    })
    .catch(() => {
        closeDeleteModal();
        showToast('Terjadi kesalahan', 'error');
    });
}

export function initModalEventListeners() {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal')) {
            const modal = e.target.closest('[id*="Modal"]');
            if (modal?.id === 'createModal') closeCreateModal();
            if (modal?.id === 'editModal') closeEditModal();
            if (modal?.id === 'deleteModal') closeDeleteModal();
        }
        if (e.target.classList.contains('confirm-delete')) confirmDelete();
    });

    document.addEventListener('click', (e) => {
        if (e.target.id === 'createModal') closeCreateModal();
        if (e.target.id === 'editModal') closeEditModal();
        if (e.target.id === 'deleteModal') closeDeleteModal();
    });
}

function clearErrors(prefix) {
    document.querySelectorAll(`[id^="${prefix}"][id$="Error"]`).forEach(el => el.textContent = '');
}
