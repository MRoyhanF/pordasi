/**
 * Atlet Manager
 * Handles all atlet-related operations
 */

import { Config } from './config.js';
import { ModalManager } from './modal-manager.js';
import { FormHandler } from './form-handler.js';
import { showToast } from '../toast.js';

export const AtletManager = {
    init() {
        document.getElementById('addAtletBtn').addEventListener('click', () => {
            document.getElementById('atletForm').reset();
            document.getElementById('atletModalTitle').textContent = 'Tambah Atlet';
            document.getElementById('atletForm').dataset.id = '';
            ModalManager.openModal('atletModal');
        });

        document.getElementById('atletForm').addEventListener('submit', e => this.submit(e));
        document.getElementById('atletTableBody').addEventListener('click', e => this.handleTableClick(e));
    },

    async submit(e) {
        e.preventDefault();
        const form = document.getElementById('atletForm');
        const id = form.dataset.id;
        const url = id ? Config.routes.atlet.update.replace(':id', id) : Config.routes.atlet.store;
        const method = id ? 'PUT' : 'POST';

        const result = await FormHandler.submit('atletForm', url, method);
        if (result.success) {
            ModalManager.closeModal('atletModal');
            location.reload();
        }
    },

    handleTableClick(e) {
        if (e.target.classList.contains('editAtletBtn')) {
            const id = e.target.dataset.atletId;
            const row = e.target.closest('tr');
            const cells = row.querySelectorAll('td');
            
            document.querySelector('#atletForm [name="nama"]').value = cells[0].textContent;
            document.querySelector('#atletForm [name="jenisKelamin"]').value = cells[1].textContent;
            document.querySelector('#atletForm [name="level"]').value = cells[2].textContent.trim();
            
            document.getElementById('atletForm').dataset.id = id;
            document.getElementById('atletModalTitle').textContent = 'Edit Atlet';
            ModalManager.openModal('atletModal');
        } else if (e.target.classList.contains('deleteAtletBtn')) {
            const id = e.target.dataset.atletId;
            this.delete(id);
        }
    },

    async delete(id) {
        const row = document.querySelector(`[data-atlet-id="${id}"]`);
        const name = row?.querySelector('td')?.textContent || 'Atlet';
        window.deleteAtletId = id;
        document.getElementById('deleteAtletName').textContent = name;
        ModalManager.openModal('deleteAtletModal');
    }
};
