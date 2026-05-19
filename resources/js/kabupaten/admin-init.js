/**
 * Admin Initialization Script
 * Initializes admin modal and event handlers for kabupaten show page
 */

import { initAdminContext, initAdminEventListeners } from './admin-functions.js';

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
    console.log('Admin init script loaded');
    console.log('window.kabupatenId value:', window.kabupatanId);
    
    // Setup animations
    setupAnimations();
    
    // Get kabupaten ID from global variable (set in blade view)
    if (window.kabupatanId) {
        console.log('Initializing admin context with kabupaten ID:', window.kabupatanId);
        initAdminContext(window.kabupatanId);
    } else {
        console.error('Kabupaten ID tidak ditemukan! window.kabupatanId:', window.kabupatanId);
    }
    
    // Initialize admin event listeners
    initAdminEventListeners();
    console.log('Admin event listeners initialized');
});
