/**
 * Modal Functions
 * Handles opening/closing modals and delete confirmation
 */

import { showToast } from './toast.js';

// ===== MODAL OPEN/CLOSE FUNCTIONS =====

function openCreateModal() {
    document.getElementById('createModal').classList.remove('modal-hidden');
    document.getElementById('createName').value = '';
    document.getElementById('createError').textContent = '';
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

function openEditModal(id, name) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editForm').action = `/kabupaten/${id}`;
    document.getElementById('editError').textContent = '';
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

function openDeleteModal(id, name) {
    window.deleteId = id;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    window.deleteId = null;
}

// ===== DELETE CONFIRMATION =====

function confirmDelete() {
    if (window.deleteId) {
        // Get CSRF token dari multiple sources untuk reliability
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Fallback: cari dari form jika meta tag tidak ada
        if (!csrfToken) {
            csrfToken = document.querySelector('input[name="_token"]')?.value;
        }
        
        // Jika masih tidak ada token
        if (!csrfToken) {
            showToast('Error: CSRF token tidak ditemukan. Silahkan refresh halaman.', 'error');
            closeDeleteModal();
            return;
        }
        
        const deleteUrl = `/kabupaten/${window.deleteId}`;
        console.log('Delete URL:', deleteUrl);
        console.log('Delete ID:', window.deleteId);
        
        // Gunakan fetch untuk request yang lebih reliable
        fetch(deleteUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('Response Status:', response.status);
            console.log('Response Headers:', response.headers);
            
            if (response.status === 419) {
                throw new Error('Session expired. Silahkan refresh halaman dan coba lagi.');
            }
            if (response.status === 404) {
                throw new Error('Data tidak ditemukan (404). Mungkin sudah dihapus sebelumnya.');
            }
            if (response.status === 405) {
                throw new Error('Method tidak diizinkan (405). Silahkan refresh halaman.');
            }
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response Data:', data);
            closeDeleteModal();
            showToast('Data berhasil dihapus!', 'success');
            // Reload halaman setelah 1 detik
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        })
        .catch(error => {
            closeDeleteModal();
            console.error('Delete error:', error);
            showToast(error.message || 'Gagal menghapus data', 'error');
        });
    }
}

// ===== EVENT LISTENERS =====

function initModalEventListeners() {
    // Close button handlers
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal')) {
            const modal = e.target.closest('[id*="Modal"]');
            if (modal?.id === 'createModal') closeCreateModal();
            if (modal?.id === 'editModal') closeEditModal();
            if (modal?.id === 'deleteModal') closeDeleteModal();
        }
        if (e.target.classList.contains('confirm-delete')) {
            confirmDelete();
        }
    });

    // Outside click close
    document.addEventListener('click', (e) => {
        if (e.target.id === 'createModal' && !e.target.classList.contains('modal-hidden')) {
            closeCreateModal();
        }
        if (e.target.id === 'editModal' && !e.target.classList.contains('modal-hidden')) {
            closeEditModal();
        }
        if (e.target.id === 'deleteModal' && !e.target.classList.contains('modal-hidden')) {
            closeDeleteModal();
        }
    });

    // Button click delegates
    document.addEventListener('click', (e) => {
        if (e.target.closest('.create-btn')) {
            openCreateModal();
        }
        if (e.target.closest('.edit-btn')) {
            const btn = e.target.closest('.edit-btn');
            openEditModal(btn.dataset.id, btn.dataset.name);
        }
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            openDeleteModal(btn.dataset.id, btn.dataset.name);
        }
    });
}

export {
    openCreateModal,
    closeCreateModal,
    openEditModal,
    closeEditModal,
    openDeleteModal,
    closeDeleteModal,
    confirmDelete,
    initModalEventListeners
};
