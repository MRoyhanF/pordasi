import { showToast } from './toast.js';

let deleteUserId = null;
let deleteStableId = null;

export function openCreateModal() {
    document.getElementById('createModal').classList.remove('modal-hidden');
    document.getElementById('createForm').reset();
    clearErrors('create');
}

export function closeCreateModal() {
    document.getElementById('createModal').classList.add('modal-hidden');
}

export function openEditModal(userId, stableId, nama, isActive, level) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editUserId').value = userId;
    document.getElementById('editOldStableId').value = stableId;
    document.getElementById('editNama').value = nama || '';
    document.getElementById('editStableId').value = stableId;
    document.getElementById('editIsActive').checked = isActive === '1';
    document.getElementById('editLevel').value = level || '';
    document.getElementById('editForm').action = `/pelatih/${userId}/${stableId}`;
    clearErrors('edit');
}

export function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

export function openDeleteModal(userId, stableId, nama) {
    deleteUserId = userId;
    deleteStableId = stableId;
    document.getElementById('deleteName').textContent = nama;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

export function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    deleteUserId = null;
    deleteStableId = null;
}

function clearErrors(prefix) {
    document.querySelectorAll(`[id^="${prefix}"]`).forEach(el => {
        if (el.id.includes('Error')) el.textContent = '';
    });
}

export function confirmDelete() {
    if (!deleteUserId || !deleteStableId) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        || document.querySelector('input[name="_token"]')?.value;

    if (!csrfToken) {
        showToast('Error: CSRF token tidak ditemukan', 'error');
        closeDeleteModal();
        return;
    }

    fetch(`/pelatih/${deleteUserId}/${deleteStableId}`, {
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
        showToast('Pelatih berhasil dihapus!', 'success');
        setTimeout(() => window.location.reload(), 1000);
    })
    .catch(error => {
        closeDeleteModal();
        console.error('Delete error:', error);
        showToast('Gagal menghapus pelatih', 'error');
    });
}

export async function loadUsers() {
    try {
        const response = await fetch('/pelatih/get-users');
        const users = await response.json();

        const createSelect = document.getElementById('createUserId');
        while (createSelect.options.length > 1) createSelect.remove(1);

        users.forEach(user => {
            const label = user.email ? `${user.name} (${user.email})` : user.name;
            createSelect.appendChild(new Option(label, user.id));
        });
    } catch (error) {
        console.error('Error loading users:', error);
        showToast('Gagal memuat data pengguna', 'error');
    }
}

export async function loadStable() {
    try {
        const response = await fetch('/pelatih/get-stable');
        const stables = await response.json();

        const createSelect = document.getElementById('createStableId');
        const editSelect = document.getElementById('editStableId');
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
