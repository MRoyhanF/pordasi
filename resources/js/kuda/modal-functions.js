import { showToast } from './toast.js';

let deleteId = null;

export function openCreateModal() {
    document.getElementById('createModal').classList.remove('modal-hidden');
    document.getElementById('createForm').reset();
    clearErrors('create');
}

export function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

export function openEditModal(id, stableId, nama, pemilik, pasport, prestasi, keahlian) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editStable').value = stableId;
    document.getElementById('editNama').value = nama;
    document.getElementById('editPemilik').value = pemilik || '';
    document.getElementById('editPasport').value = pasport || '';
    document.getElementById('editPrestasi').value = prestasi || '';
    document.getElementById('editKeahlian').value = keahlian || '';
    document.getElementById('editForm').action = `/kuda/${id}`;
    clearErrors('edit');
}

export function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

export function openDeleteModal(id, nama) {
    deleteId = id;
    document.getElementById('deleteName').textContent = nama;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

export function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    deleteId = null;
}

function clearErrors(prefix) {
    document.querySelectorAll(`[id^="${prefix}"]`).forEach(el => {
        if (el.id.includes('Error')) el.textContent = '';
    });
}

export function confirmDelete() {
    if (!deleteId) return;

    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        || document.querySelector('input[name="_token"]')?.value;

    if (!csrfToken) {
        showToast('Error: CSRF token tidak ditemukan', 'error');
        closeDeleteModal();
        return;
    }

    fetch(`/kuda/${deleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        credentials: 'same-origin',
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
    })
    .then(() => {
        closeDeleteModal();
        showToast('Kuda berhasil dihapus!', 'success');
        setTimeout(() => window.location.reload(), 1000);
    })
    .catch(error => {
        closeDeleteModal();
        console.error('Delete error:', error);
        showToast('Gagal menghapus kuda', 'error');
    });
}

export async function loadStable() {
    try {
        const response = await fetch('/kuda/get-stable');
        const stables = await response.json();

        const createSelect = document.getElementById('createStable');
        const editSelect = document.getElementById('editStable');
        const filterSelect = document.getElementById('stableFilter');

        [createSelect, editSelect].forEach(select => {
            while (select.options.length > 1) select.remove(1);
        });

        stables.forEach(item => {
            const label = item.kabupaten ? `${item.nama} (${item.kabupaten.name})` : item.nama;
            createSelect.appendChild(new Option(label, item.id));
            editSelect.appendChild(new Option(label, item.id));
            filterSelect.appendChild(new Option(label, item.id));
        });
    } catch (error) {
        console.error('Error loading stable:', error);
        showToast('Gagal memuat data stable', 'error');
    }
}

export function initModalEventListeners() {
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal')) {
            const modal = e.target.closest('[id*="Modal"]');
            if (modal?.id === 'createModal') closeCreateModal();
            if (modal?.id === 'editModal') closeEditModal();
            if (modal?.id === 'deleteModal') closeDeleteModal();
        }
        if (e.target.classList.contains('confirm-delete')) confirmDelete();
        if (e.target.id === 'createModal') closeCreateModal();
        if (e.target.id === 'editModal') closeEditModal();
        if (e.target.id === 'deleteModal') closeDeleteModal();
    });
}
