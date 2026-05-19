/**
 * Form Handler
 * Handles all form submissions via AJAX
 */

import { showToast } from '../toast.js';

export class FormHandler {
    static async submit(formId, url, method = 'POST') {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        
        // Get CSRF token
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
            csrfToken = document.querySelector('input[name="_token"]')?.value;
        }
        
        // Add CSRF token to FormData
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        // Add method override for PUT/DELETE
        if (method !== 'POST') {
            formData.append('_method', method);
        }
        
        try {
            const response = await fetch(url, {
                method: 'POST',  // Always use POST when using FormData with method override
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            if (!response.ok) {
                showToast(data.message || 'Gagal menyimpan data', 'error');
                return { success: false, data };
            }

            showToast(data.message || 'Berhasil', 'success');
            return { success: true, data };
        } catch (error) {
            showToast(error.message, 'error');
            return { success: false };
        }
    }
}
