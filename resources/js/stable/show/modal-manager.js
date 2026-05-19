/**
 * Modal Manager
 * Handles opening and closing of all modals
 */

export const ModalManager = {
    openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    },
    closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    },
    closeAllModals() {
        document.querySelectorAll('[id$="Modal"]').forEach(m => m.classList.add('hidden'));
    }
};
