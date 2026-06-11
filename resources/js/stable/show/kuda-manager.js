/**
 * Kuda Manager
 * Handles all kuda-related operations
 */

import { Config } from './config.js';
import { ModalManager } from './modal-manager.js';
import { FormHandler } from './form-handler.js';

export const KudaManager = {
    init() {
        document.getElementById('addKudaBtn').addEventListener('click', () => {
            document.getElementById('kudaForm').reset();
            document.getElementById('kudaModalTitle').textContent = 'Tambah Kuda';
            document.getElementById('kudaForm').dataset.id = '';
            ModalManager.openModal('kudaModal');
        });

        document.getElementById('kudaForm').addEventListener('submit', e => this.submit(e));
        document.getElementById('kudaTableBody')?.addEventListener('click', e => this.handleTableClick(e));
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
        const editBtn = e.target.closest('.editKudaBtn');
        const deleteBtn = e.target.closest('.deleteKudaBtn');

        if (editBtn) {
            const id = editBtn.dataset.kudaId;
            const row = editBtn.closest('tr');

            document.querySelector('#kudaForm [name="nama"]').value = row.dataset.kudaNama || '';
            document.querySelector('#kudaForm [name="pasport"]').value = row.dataset.kudaPasport || '';
            document.querySelector('#kudaForm [name="pemilik"]').value = row.dataset.kudaPemilik || '';
            document.querySelector('#kudaForm [name="keahlian"]').value = row.dataset.kudaKeahlian || '';
            document.querySelector('#kudaForm [name="prestasi"]').value = row.dataset.kudaPrestasi || '';

            document.getElementById('kudaForm').dataset.id = id;
            document.getElementById('kudaModalTitle').textContent = 'Edit Kuda';
            ModalManager.openModal('kudaModal');
        } else if (deleteBtn) {
            this.delete(deleteBtn.dataset.kudaId);
        }
    },

    delete(id) {
        const row = document.querySelector(`[data-kuda-id="${id}"]`);
        const name = row?.dataset.kudaNama || 'Kuda';
        window.deleteKudaId = id;
        document.getElementById('deleteKudaName').textContent = name;
        ModalManager.openModal('deleteKudaModal');
    }
};
