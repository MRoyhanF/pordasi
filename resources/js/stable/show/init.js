/**
 * Stable Show Page Initialization
 * Entry point for all stable show page features
 */

import { AtletManager } from './atlet-manager.js';
import { KudaManager } from './kuda-manager.js';
import { PelatihManager } from './pelatih-manager.js';
import { ModalManager } from './modal-manager.js';
import { Config } from './config.js';
import { FormHandler } from './form-handler.js';
import { showToast } from '../toast.js';

function setupAnimations() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }
    `;
    document.head.appendChild(style);
}

function setupDeleteHandlers() {
    // Delete Atlet Handler
    document.querySelector('.confirm-delete-atlet')?.addEventListener('click', async () => {
        if (window.deleteAtletId) {
            const url = Config.routes.atlet.destroy.replace(':id', window.deleteAtletId);
            const result = await FormHandler.submit('atletForm', url, 'DELETE');
            if (result.success) {
                ModalManager.closeModal('deleteAtletModal');
                location.reload();
            }
        }
    });

    // Delete Kuda Handler
    document.querySelector('.confirm-delete-kuda')?.addEventListener('click', async () => {
        if (window.deleteKudaId) {
            const url = Config.routes.kuda.destroy.replace(':id', window.deleteKudaId);
            const result = await FormHandler.submit('kudaForm', url, 'DELETE');
            if (result.success) {
                ModalManager.closeModal('deleteKudaModal');
                location.reload();
            }
        }
    });

    // Delete Pelatih Handler
    document.querySelector('.confirm-delete-pelatih')?.addEventListener('click', async () => {
        if (window.deletePelatihId) {
            const url = Config.routes.pelatih.destroy.replace(':id', window.deletePelatihId);
            
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                csrfToken = document.querySelector('input[name="_token"]')?.value;
            }
            
            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();
                if (response.ok) {
                    ModalManager.closeModal('deletePelatihModal');
                    showToast(data.message || 'Pelatih berhasil dihapus', 'success');
                    location.reload();
                } else {
                    showToast(data.message || 'Gagal menghapus pelatih', 'error');
                }
            } catch (error) {
                showToast(error.message, 'error');
            }
        }
    });
}

function setupKeyboardShortcuts() {
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') ModalManager.closeAllModals();
    });
}

function setupGlobals() {
    // Make ModalManager and Config globally accessible for onclick handlers
    window.ModalManager = ModalManager;
    window.Config = Config;
}

async function initialize() {
    setupAnimations();
    setupGlobals();
    
    // Initialize all managers
    AtletManager.init();
    KudaManager.init();
    await PelatihManager.init();
    
    setupDeleteHandlers();
    setupKeyboardShortcuts();
}

document.addEventListener('DOMContentLoaded', initialize);
