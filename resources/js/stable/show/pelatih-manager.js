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
        document.getElementById('pelatihEditForm').addEventListener('submit', e => this.submitEdit(e));
        document.getElementById('pelatihTableBody')?.addEventListener('click', e => this.handleTableClick(e));
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

    async submitEdit(e) {
        e.preventDefault();
        const userId = document.getElementById('pelatihEditForm').dataset.userId;
        const url = Config.routes.pelatih.update.replace(':id', userId);

        const level = document.querySelector('#pelatihEditForm [name="level"]').value || null;
        const isActive = document.querySelector('#pelatihEditForm [name="isActive"]').value === '1';

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value;

        try {
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('_method', 'PUT');
            formData.append('isActive', isActive ? '1' : '0');
            if (level) formData.append('level', level);

            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await response.json();
            if (response.ok) {
                showToast(data.message || 'Pelatih berhasil diperbarui', 'success');
                ModalManager.closeModal('pelatihEditModal');
                location.reload();
            } else {
                showToast(data.message || 'Gagal memperbarui pelatih', 'error');
            }
        } catch (error) {
            showToast(error.message, 'error');
        }
    },

    handleTableClick(e) {
        const editBtn = e.target.closest('.editPelatihBtn');
        const toggleBtn = e.target.closest('.togglePelatihBtn');
        const deleteBtn = e.target.closest('.deletePelatihBtn');

        if (toggleBtn) {
            const userId = toggleBtn.dataset.pelatihUserId;
            const row = toggleBtn.closest('tr');
            document.getElementById('pelatihEditForm').dataset.userId = userId;
            document.getElementById('pelatihEditNama').value = row.dataset.pelatihNama || '';
            document.querySelector('#pelatihEditForm [name="level"]').value = row.dataset.pelatihLevel || '';
            document.querySelector('#pelatihEditForm [name="isActive"]').value = row.dataset.pelatihIsActive || '1';
            ModalManager.openModal('pelatihEditModal');
        } else if (editBtn) {
            const userId = editBtn.dataset.pelatihUserId;
            const row = editBtn.closest('tr');

            document.getElementById('pelatihEditForm').dataset.userId = userId;
            document.getElementById('pelatihEditNama').value = row.dataset.pelatihNama || '';
            document.querySelector('#pelatihEditForm [name="level"]').value = row.dataset.pelatihLevel || '';
            document.querySelector('#pelatihEditForm [name="isActive"]').value = row.dataset.pelatihIsActive || '1';

            ModalManager.openModal('pelatihEditModal');
        } else if (deleteBtn) {
            this.delete(deleteBtn.dataset.pelatihUserId);
        }
    },

    delete(userId) {
        const row = document.querySelector(`[data-pelatih-user-id="${userId}"]`);
        const name = row?.dataset.pelatihNama || 'Pelatih';
        window.deletePelatihId = userId;
        document.getElementById('deletePelatihName').textContent = name;
        ModalManager.openModal('deletePelatihModal');
    }
};
