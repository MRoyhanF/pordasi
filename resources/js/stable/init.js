/**
 * Stable Index Initialization
 * Entry point for stable listing page
 */

import { showToast } from './toast.js';
import { 
    openCreateModal, 
    openEditModal, 
    openDeleteModal,
    loadKabupaten,
    initModalEventListeners
} from './modal-functions.js';
import { TableHandler } from './table-handler.js';

// ===== CSS ANIMATION SETUP =====
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

// ===== FORM HANDLERS =====
function setupFormHandlers() {
    // Create form handler
    document.getElementById('createForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) csrfToken = document.querySelector('input[name="_token"]')?.value;
        
        try {
            const response = await fetch('/stable', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                // Handle validation errors
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, errors]) => {
                        const errorEl = document.getElementById(`create${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        if (errorEl) errorEl.textContent = errors[0];
                    });
                } else {
                    showToast(data.message || 'Gagal menambah stable', 'error');
                }
                return;
            }
            
            closeCreateModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        }
    });

    // Edit form handler
    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const stableId = document.getElementById('editId').value;
        const formData = new FormData(e.target);
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) csrfToken = document.querySelector('input[name="_token"]')?.value;
        
        try {
            const response = await fetch(`/stable/${stableId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData,
                credentials: 'same-origin'
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                // Handle validation errors
                if (data.errors) {
                    Object.entries(data.errors).forEach(([key, errors]) => {
                        const errorEl = document.getElementById(`edit${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        if (errorEl) errorEl.textContent = errors[0];
                    });
                } else {
                    showToast(data.message || 'Gagal mengupdate stable', 'error');
                }
                return;
            }
            
            closeEditModal();
            showToast(data.message, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        }
    });
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

// ===== BUTTON EVENT HANDLERS =====
function setupButtonHandlers() {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('create-btn')) {
            openCreateModal();
        }
        if (e.target.closest('.edit-btn')) {
            const btn = e.target.closest('.edit-btn');
            openEditModal(
                btn.dataset.id,
                btn.dataset.kabupaten,
                btn.dataset.nama,
                btn.dataset.pemilik,
                btn.dataset.alamat,
                btn.dataset.pimpinan,
                btn.dataset.berdiri,
                btn.dataset.jumlahKandang
            );
        }
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            openDeleteModal(btn.dataset.id, btn.dataset.nama);
        }
    });
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    // Setup animations
    setupAnimations();

    // Load kabupaten to dropdowns
    loadKabupaten();

    // Initialize modal event listeners
    initModalEventListeners();

    // Setup form handlers
    setupFormHandlers();

    // Setup button handlers
    setupButtonHandlers();

    // Initialize table handler
    new TableHandler('stableTable');
});
