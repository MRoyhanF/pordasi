/**
 * Kuda Manager
 * Handles all kuda-related operations
 */

import { Config } from './config.js';
import { ModalManager } from './modal-manager.js';
import { FormHandler } from './form-handler.js';
import { showToast } from '../toast.js';

export const KudaManager = {
    init() {
        document.getElementById('addKudaBtn').addEventListener('click', () => {
            document.getElementById('kudaForm').reset();
            document.getElementById('kudaModalTitle').textContent = 'Tambah Kuda';
            document.getElementById('kudaForm').dataset.id = '';
            ModalManager.openModal('kudaModal');
        });

        document.getElementById('kudaForm').addEventListener('submit', e => this.submit(e));
        document.getElementById('kudaTableBody').addEventListener('click', e => this.handleTableClick(e));
    },

    async submit(e) {
        e.preventDefault();
        const form = document.getElementById('kudaForm');
        const id = form.dataset.id;
        const url = id ? Config.routes.kuda.update.replace(':id', id) : Config.routes.kuda.store;
        const method = id ? 'PUT' : 'POST';

        const result = await FormHandler.submit('kudaForm', url, method);
        if (result.success) {
            ModalManager.closeModal('kudaModal');
            location.reload();
        }
    },

    handleTableClick(e) {
        if (e.target.classList.contains('editKudaBtn')) {
            const id = e.target.dataset.kudaId;
            const row = e.target.closest('tr');
            
            // Get data dari data attributes
            const nama = row.dataset.kudaNama || '';
            const jenis = row.dataset.kudaJenis || '';
            const warna = row.dataset.kudaWarna || '';
            const pasport = row.dataset.kudaPasport || '';
            const prestasi = row.dataset.kudaPrestasi || '';
            const pemilik = row.dataset.kudaPemilik || '';
            
            // Populate form dengan semua data
            document.querySelector('#kudaForm [name="nama"]').value = nama;
            document.querySelector('#kudaForm [name="pasport"]').value = pasport;
            document.querySelector('#kudaForm [name="prestasi"]').value = prestasi;
            document.querySelector('#kudaForm [name="pemilik"]').value = pemilik;
            
            document.getElementById('kudaForm').dataset.id = id;
            document.getElementById('kudaModalTitle').textContent = 'Edit Kuda';
            ModalManager.openModal('kudaModal');
        } else if (e.target.classList.contains('deleteKudaBtn')) {
            const id = e.target.dataset.kudaId;
            this.delete(id);
        }
    },

    async delete(id) {
        const row = document.querySelector(`[data-kuda-id="${id}"]`);
        const name = row?.querySelector('td')?.textContent || 'Kuda';
        window.deleteKudaId = id;
        document.getElementById('deleteKudaName').textContent = name;
        ModalManager.openModal('deleteKudaModal');
    }
};
