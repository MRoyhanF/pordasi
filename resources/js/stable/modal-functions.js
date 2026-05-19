/**
 * Stable Modal Functions
 * Handles modal operations for create, edit, and delete stable
 */

import { showToast } from './toast.js';

let deleteId = null;

// ===== MODAL OPEN/CLOSE FUNCTIONS =====

export function openCreateModal() {
    document.getElementById('createModal').classList.remove('modal-hidden');
    document.getElementById('createForm').reset();
    clearAllErrors('create');
}

export function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

export function openEditModal(id, kabupaten, nama, pemilik, alamat, pimpinan, berdiri, jumlahKandang) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editKabupaten').value = kabupaten;
    document.getElementById('editNama').value = nama;
    document.getElementById('editPemilik').value = pemilik;
    document.getElementById('editAlamat').value = alamat;
    document.getElementById('editPimpinan').value = pimpinan;
    document.getElementById('editBerdiri').value = berdiri || '';
    document.getElementById('editKandang').value = jumlahKandang || '';
    document.getElementById('editForm').action = `/stable/${id}`;
    clearAllErrors('edit');
}

export function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

export function openDeleteModal(id, nama) {
    deleteId = id;
    document.getElementById('deleteName').textContent = nama;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

export function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    deleteId = null;
}

// ===== UTILITY FUNCTIONS =====

function clearAllErrors(prefix) {
    document.querySelectorAll(`[id^="${prefix}"]`).forEach(el => {
        if (el.id.includes('Error')) el.textContent = '';
    });
}

// ===== DELETE CONFIRMATION =====

export function confirmDelete() {
    if (deleteId) {
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            csrfToken = document.querySelector('input[name="_token"]')?.value;
        }
        
        if (!csrfToken) {
            showToast('Error: CSRF token tidak ditemukan', 'error');
            closeDeleteModal();
            return;
        }
        
        fetch(`/stable/${deleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            closeDeleteModal();
            showToast('Stable berhasil dihapus!', 'success');
            setTimeout(() => window.location.reload(), 1000);
        })
        .catch(error => {
            closeDeleteModal();
            console.error('Delete error:', error);
            showToast('Gagal menghapus stable', 'error');
        });
    }
}

// ===== LOAD KABUPATEN =====

export async function loadKabupaten() {
    try {
        const response = await fetch('/stable/get-kabupaten');
        const kabupaten = await response.json();
        
        const createSelect = document.getElementById('createKabupaten');
        const editSelect = document.getElementById('editKabupaten');
        const filterSelect = document.getElementById('kabupatenFilter');
        
        // Clear existing options (keep the first option)
        [createSelect, editSelect].forEach(select => {
            while (select.options.length > 1) {
                select.remove(1);
            }
        });
        
        // Add kabupaten options to all selects
        kabupaten.forEach(item => {
            const optionCreate = document.createElement('option');
            optionCreate.value = item.id;
            optionCreate.textContent = item.name;
            createSelect.appendChild(optionCreate);
            
            const optionEdit = document.createElement('option');
            optionEdit.value = item.id;
            optionEdit.textContent = item.name;
            editSelect.appendChild(optionEdit);
            
            const optionFilter = document.createElement('option');
            optionFilter.value = item.id;
            optionFilter.textContent = item.name;
            filterSelect.appendChild(optionFilter);
        });
    } catch (error) {
        console.error('Error loading kabupaten:', error);
        showToast('Gagal memuat data kabupaten', 'error');
    }
}

// ===== EVENT LISTENERS =====

export function initModalEventListeners() {
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
}
