/**
 * Atlet Manager
 * Handles all atlet-related operations
 */

import { Config } from './config.js';
import { ModalManager } from './modal-manager.js';
import { FormHandler } from './form-handler.js';

export const AtletManager = {
    init() {
        document.getElementById('addAtletBtn').addEventListener('click', () => {
            document.getElementById('atletForm').reset();
            document.getElementById('atletModalTitle').textContent = 'Tambah Atlet';
            document.getElementById('atletForm').dataset.id = '';
            ModalManager.openModal('atletModal');
        });

        document.getElementById('atletForm').addEventListener('submit', e => this.submit(e));
        document.getElementById('atletTableBody')?.addEventListener('click', e => this.handleTableClick(e));
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
        const editBtn = e.target.closest('.editAtletBtn');
        const deleteBtn = e.target.closest('.deleteAtletBtn');

        if (editBtn) {
            const id = editBtn.dataset.atletId;
            const row = editBtn.closest('tr');

            document.querySelector('#atletForm [name="nama"]').value = row.dataset.atletNama || '';
            document.querySelector('#atletForm [name="jenisKelamin"]').value = row.dataset.atletJenis || '';
            document.querySelector('#atletForm [name="level"]').value = row.dataset.atletLevel || '';
            document.querySelector('#atletForm [name="tanggal_lahir"]').value = row.dataset.atletLahir || '';
            document.querySelector('#atletForm [name="alamat"]').value = row.dataset.atletAlamat || '';
            document.querySelector('#atletForm [name="status"]').value = row.dataset.atletStatus || '';
            document.querySelector('#atletForm [name="prestasi"]').value = row.dataset.atletPrestasi || '';

            document.getElementById('atletForm').dataset.id = id;
            document.getElementById('atletModalTitle').textContent = 'Edit Atlet';
            ModalManager.openModal('atletModal');
        } else if (deleteBtn) {
            this.delete(deleteBtn.dataset.atletId);
        }
    },

    delete(id) {
        const row = document.querySelector(`[data-atlet-id="${id}"]`);
        const name = row?.dataset.atletNama || 'Atlet';
        window.deleteAtletId = id;
        document.getElementById('deleteAtletName').textContent = name;
        ModalManager.openModal('deleteAtletModal');
    }
};
