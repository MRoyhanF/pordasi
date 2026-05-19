/**
 * Initialization Script
 * Initializes all modules when the page loads
 */

import { showToast } from './toast.js';
import { initModalEventListeners, openCreateModal, openEditModal } from './modal-functions.js';
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

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    // Setup animations
    setupAnimations();
    
    // Initialize modal event listeners
    initModalEventListeners();
    
    // Initialize table handler
    new TableHandler('kabupatenTable');
    
    // Check for success message and show toast
    const msgEl = document.querySelector('[data-toast]');
    if (msgEl?.dataset.toast) {
        showToast(msgEl.dataset.toast, 'success');
    }
    
    // Auto-open modals with errors
    const createError = document.getElementById('createError')?.textContent;
    if (createError?.trim()) openCreateModal();
    
    const editError = document.getElementById('editError')?.textContent;
    if (editError?.trim()) {
        const id = document.getElementById('editId')?.value;
        const name = document.getElementById('editName')?.value;
        if (id && name) openEditModal(id, name);
    }
});
