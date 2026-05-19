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
            
            // Get data dari data attributes
            const nama = row.dataset.atletNama || '';
            const jenis = row.dataset.atletJenis || '';
            const level = row.dataset.atletLevel || '';
            const lahir = row.dataset.atletLahir || '';
            const alamat = row.dataset.atletAlamat || '';
            
            // Populate form dengan semua data
            document.querySelector('#atletForm [name="nama"]').value = nama;
            document.querySelector('#atletForm [name="jenisKelamin"]').value = jenis;
            document.querySelector('#atletForm [name="level"]').value = level;
            document.querySelector('#atletForm [name="tanggal_lahir"]').value = lahir;
            document.querySelector('#atletForm [name="alamat"]').value = alamat;
            
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
