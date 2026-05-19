/**
 * Admin Modal Functions
 * Handles admin edit/delete operations for kabupaten show page
 */

import { showToast } from './toast.js';

let currentKabupatanId = null;
let currentDeleteUserId = null;

// ===== INITIALIZATION =====

function initAdminContext(kabupatanId) {
    console.log('Setting currentKabupatanId to:', kabupatanId);
    currentKabupatanId = kabupatanId;
    console.log('currentKabupatanId is now:', currentKabupatanId);
}

// ===== MODAL OPEN/CLOSE FUNCTIONS =====

function openEditModal(id, name, email, isActive) {
    document.getElementById('editModal').classList.remove('modal-hidden');
    document.getElementById('editId').value = id;
    document.getElementById('editName').textContent = name;
    document.getElementById('editEmail').textContent = email;
    document.getElementById('editStatus').checked = isActive ? true : false;
    document.getElementById('editForm').action = `/kabupaten/${currentKabupatanId}/admin/${id}`;
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('modal-hidden');
}

function openDeleteModal(id, name) {
    window.deleteId = id;
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').classList.remove('modal-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('modal-hidden');
    window.deleteId = null;
}

// ===== FETCH ADMIN DATA =====

function fetchAdminData(adminId) {
    const url = `/kabupaten/${currentKabupatanId}/admin/${adminId}`;
    console.log('Fetching from:', url);
    
    return fetch(url, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response Status:', response.status);
        console.log('Response URL:', response.url);
        
        if (response.status === 410) {
            throw new Error('Admin ini telah dihapus dan tidak bisa diedit');
        }
        
        if (response.status === 404) {
            throw new Error(`Admin tidak ditemukan`);
        }
        
        if (!response.ok) {
            throw new Error(`Network error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Full Response Data:', data);
        
        // Handle error response
        if (data.error) {
            throw new Error(data.error + (data.details ? ` - ${data.details}` : ''));
        }
        
        // Handle success response with admin property
        if (data.admin) {
            console.log('Admin object found:', data.admin);
            
            // Validate required fields
            if (!data.admin.user) {
                console.warn('User relationship not loaded, data.admin:', data.admin);
                throw new Error('Data user admin tidak lengkap - silahkan refresh halaman');
            }
            
            return { admin: data.admin };
        }
        
        // If no data structure matches
        console.error('Unexpected response structure:', data);
        throw new Error('Struktur response tidak sesuai');
    })
    .catch(error => {
        console.error('Fetch Error:', error.message, 'Full error:', error);
        throw error;
    });
}

// ===== DELETE CONFIRMATION =====

function confirmDelete() {
    if (window.deleteId) {
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            csrfToken = document.querySelector('input[name="_token"]')?.value;
        }
        
        if (!csrfToken) {
            showToast('Error: CSRF token tidak ditemukan. Silahkan refresh halaman.', 'error');
            closeDeleteModal();
            return;
        }
        
        const deleteUrl = `/kabupaten/${currentKabupatanId}/admin/${window.deleteId}`;
        
        fetch(deleteUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (response.status === 419) {
                throw new Error('Session expired. Silahkan refresh halaman dan coba lagi.');
            }
            if (response.status === 404) {
                throw new Error('Data tidak ditemukan (404). Mungkin sudah dihapus sebelumnya.');
            }
            if (response.status === 405) {
                throw new Error('Method tidak diizinkan (405). Silahkan refresh halaman.');
            }
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            closeDeleteModal();
            showToast('Admin berhasil dihapus!', 'success');
            setTimeout(() => {
                location.reload();
            }, 1000);
        })
        .catch(error => {
            closeDeleteModal();
            console.error('Delete error:', error);
            showToast(error.message || 'Gagal menghapus admin', 'error');
        });
    }
}

// ===== FORM SUBMISSION =====

function handleEditFormSubmit(e) {
    e.preventDefault();
    
    // Get checkbox state
    const isActiveCheckbox = document.getElementById('editStatus');
    const isActiveValue = isActiveCheckbox.checked ? '1' : '0';
    
    const csrfToken = document.querySelector('input[name="_token"]').value;
    
    console.log('Form submission:', {
        isActive: isActiveValue,
        checkbox_checked: isActiveCheckbox.checked,
        url: document.getElementById('editForm').action
    });
    
    // Send as JSON instead of FormData
    fetch(document.getElementById('editForm').action, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            isActive: isActiveValue
        })
    })
    .then(response => {
        console.log('Response Status:', response.status);
        return response.json().then(data => ({status: response.status, data: data}));
    })
    .then(({status, data}) => {
        console.log('Response Data:', data);
        if (data.success) {
            showToast(data.message || 'Admin berhasil diperbarui', 'success');
            closeEditModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast(data.message || 'Gagal memperbarui admin', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan pada server', 'error');
    });
}

// ===== EVENT LISTENERS =====

function initAdminEventListeners() {
    // Close button handlers
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal')) {
            const modal = e.target.closest('[id*="Modal"]');
            if (modal?.id === 'editModal') closeEditModal();
            if (modal?.id === 'deleteModal') closeDeleteModal();
        }
        if (e.target.classList.contains('confirm-delete')) {
            confirmDelete();
        }
    });

    // Outside click close
    document.addEventListener('click', (e) => {
        if (e.target.id === 'editModal' && !e.target.classList.contains('modal-hidden')) {
            closeEditModal();
        }
        if (e.target.id === 'deleteModal' && !e.target.classList.contains('modal-hidden')) {
            closeDeleteModal();
        }
    });

    // Edit/Delete button click handlers
    document.addEventListener('click', (e) => {
        if (e.target.closest('.edit-btn')) {
            const btn = e.target.closest('.edit-btn');
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            
            console.log('Edit button clicked - ID:', id, 'Name:', name);
            
            fetchAdminData(id)
                .then(data => {
                    console.log('Successfully fetched admin data:', data);
                    if (data.admin) {
                        openEditModal(
                            data.admin.idUser,
                            data.admin.user.name,
                            data.admin.user.email,
                            data.admin.isActive
                        );
                    } else {
                        showToast('Data admin tidak lengkap', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error fetching admin:', error.message);
                    showToast(error.message || 'Gagal memuat data admin', 'error');
                });
        }
        
        if (e.target.closest('.delete-btn')) {
            const btn = e.target.closest('.delete-btn');
            openDeleteModal(btn.dataset.id, btn.dataset.name);
        }
    });

    // Form submission
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', handleEditFormSubmit);
    }
}

export {
    initAdminContext,
    openEditModal,
    closeEditModal,
    openDeleteModal,
    closeDeleteModal,
    confirmDelete,
    fetchAdminData,
    initAdminEventListeners
};
