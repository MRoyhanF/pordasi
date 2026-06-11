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

export function openEditModal(id, stableId, nama, jenisKelamin, level, tanggalLahir, alamat) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editStable').value = stableId;
    document.getElementById('editNama').value = nama;
    document.getElementById('editJenisKelamin').value = jenisKelamin || '';
    document.getElementById('editLevel').value = level || '';
    document.getElementById('editTanggalLahir').value = tanggalLahir || '';
    document.getElementById('editAlamat').value = alamat || '';
    document.getElementById('editForm').action = `/atlet/${id}`;
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

const errorIds = {
    create: ['createIdStableError', 'createNamaError', 'createJenisKelaminError', 'createLevelError', 'createTanggalLahirError', 'createAlamatError'],
    edit:   ['editIdStableError', 'editNamaError', 'editJenisKelaminError', 'editLevelError', 'editTanggalLahirError', 'editAlamatError'],
};

const inputIds = {
    create: ['createStable', 'createNama', 'createJenisKelamin', 'createLevel', 'createTanggalLahir', 'createAlamat'],
    edit:   ['editStable', 'editNama', 'editJenisKelamin', 'editLevel', 'editTanggalLahir', 'editAlamat'],
};

function clearErrors(prefix) {
    errorIds[prefix].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
    inputIds[prefix].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('input-error');
    });
}

export function confirmDelete() {
    if (!deleteId) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        || document.querySelector('input[name="_token"]')?.value;

    if (!csrfToken) {
        showToast('Error: CSRF token tidak ditemukan', 'error');
        closeDeleteModal();
        return;
    }

    fetch(`/atlet/${deleteId}`, {
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
        showToast('Atlet berhasil dihapus!', 'success');
        setTimeout(() => window.location.reload(), 1000);
    })
    .catch(error => {
        closeDeleteModal();
        console.error('Delete error:', error);
        showToast('Gagal menghapus atlet', 'error');
    });
}

export async function loadStable() {
    try {
        const response = await fetch('/atlet/get-stable');
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
