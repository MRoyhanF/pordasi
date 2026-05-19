/**
 * Pelatih Manager
 * Handles all pelatih-related operations
 */

import { Config } from './config.js';
import { ModalManager } from './modal-manager.js';
import { FormHandler } from './form-handler.js';
import { showToast } from '../toast.js';

export const PelatihManager = {
    async init() {
        await this.loadUsers();

        document.getElementById('addPelatihBtn').addEventListener('click', () => {
            document.getElementById('pelatihForm').reset();
            ModalManager.openModal('pelatihModal');
        });

        document.getElementById('pelatihForm').addEventListener('submit', e => this.submit(e));
        document.getElementById('pelatihTableBody').addEventListener('click', e => this.handleTableClick(e));
    },

    async loadUsers() {
        try {
            const response = await fetch(Config.routes.pelatih.users);
            const users = await response.json();
            
            const select = document.getElementById('pelatihUserSelect');
            select.innerHTML = '<option value="">Pilih Pelatih</option>';
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                select.appendChild(option);
            });
        } catch (error) {
            showToast('Gagal memuat data pelatih', 'error');
        }
    },

    async submit(e) {
        e.preventDefault();
        const result = await FormHandler.submit('pelatihForm', Config.routes.pelatih.store, 'POST');
        if (result.success) {
            ModalManager.closeModal('pelatihModal');
            location.reload();
        }
    },

    async handleTableClick(e) {
        if (e.target.classList.contains('togglePelatihBtn')) {
            const userId = e.target.dataset.pelatihUserId;
            const isActive = e.target.classList.contains('bg-green-100');
            this.toggleStatus(userId, !isActive);
        } else if (e.target.classList.contains('deletePelatihBtn')) {
            const userId = e.target.dataset.pelatihUserId;
            this.delete(userId);
        }
    },

    async toggleStatus(userId, isActive) {
        const url = Config.routes.pelatih.update.replace(':id', userId);
        
        try {
            const response = await fetch(url, {
                method: 'PUT',
                body: JSON.stringify({ isActive }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });

            const data = await response.json();
            if (response.ok) {
                showToast(data.message || 'Status berhasil diubah', 'success');
                location.reload();
            } else {
                showToast(data.message || 'Gagal mengubah status', 'error');
            }
        } catch (error) {
            showToast(error.message, 'error');
        }
    },

    async delete(userId) {
        const row = document.querySelector(`[data-pelatih-user-id="${userId}"]`);
        const name = row?.querySelector('td')?.textContent || 'Pelatih';
        window.deletePelatihId = userId;
        document.getElementById('deletePelatihName').textContent = name;
        ModalManager.openModal('deletePelatihModal');
    }
};
