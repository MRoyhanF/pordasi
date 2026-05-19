/**
 * Table Handler
 * Manages table filtering, search, and pagination for stable listing
 */

import { showToast } from './toast.js';

export class TableHandler {
    constructor(tableId, options = {}) {
        this.table = document.getElementById(tableId);
        this.tbody = this.table.querySelector('tbody');
        this.itemsPerPageSelect = document.getElementById('itemsPerPage');
        this.searchInput = document.getElementById('searchInput');
        this.kabupatenFilter = document.getElementById('kabupatenFilter');
        this.clearFilterBtn = document.getElementById('clearFilter');
        this.paginationContainer = document.getElementById('pagination');
        this.pageNumbers = document.getElementById('pageNumbers');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        
        this.itemsPerPage = parseInt(this.itemsPerPageSelect.value) || 10;
        this.currentPage = 1;
        this.allRows = Array.from(this.tbody.querySelectorAll('tr:not(:has(td[colspan]))'));
        this.filteredRows = [...this.allRows];
        
        this.init();
    }

    init() {
        this.render();
        this.attachEventListeners();
    }

    attachEventListeners() {
        this.searchInput.addEventListener('input', () => this.handleSearch());
        this.kabupatenFilter.addEventListener('change', () => this.handleKabupatenFilter());
        this.itemsPerPageSelect.addEventListener('change', () => this.handleItemsPerPageChange());
        this.clearFilterBtn.addEventListener('click', () => this.handleClearFilter());
        this.prevBtn.addEventListener('click', () => this.previousPage());
        this.nextBtn.addEventListener('click', () => this.nextPage());
    }

    handleSearch() {
        const searchValue = this.searchInput.value.toLowerCase();
        this.applyFilters(searchValue);
    }

    handleKabupatenFilter() {
        const searchValue = this.searchInput.value.toLowerCase();
        this.applyFilters(searchValue);
    }

    applyFilters(searchValue = '') {
        const kabupatenId = this.kabupatenFilter.value;

        this.filteredRows = this.allRows.filter(row => {
            const kabupatenMatch = !kabupatenId || row.dataset.kabupatanId === kabupatenId;
            const searchMatch = !searchValue || row.textContent.toLowerCase().includes(searchValue);
            return kabupatenMatch && searchMatch;
        });

        this.currentPage = 1;
        this.render();
    }

    handleItemsPerPageChange() {
        this.itemsPerPage = parseInt(this.itemsPerPageSelect.value);
        this.currentPage = 1;
        this.render();
    }

    handleClearFilter() {
        this.searchInput.value = '';
        this.kabupatenFilter.value = '';
        this.itemsPerPageSelect.value = '10';
        this.itemsPerPage = 10;
        this.currentPage = 1;
        this.filteredRows = [...this.allRows];
        this.render();
    }

    render() {
        this.renderTableBody();
        this.renderPagination();
        this.updatePaginationInfo();
    }

    renderTableBody() {
        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        const paginatedRows = this.filteredRows.slice(startIndex, endIndex);

        this.tbody.innerHTML = '';

        if (paginatedRows.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `<td colspan="9" class="text-center text-gray-500 py-8 text-sm">Tidak ada data stable</td>`;
            this.tbody.appendChild(emptyRow);
        } else {
            paginatedRows.forEach((row, index) => {
                row.cells[0].textContent = startIndex + index + 1;
                this.tbody.appendChild(row);
            });
        }
    }

    renderPagination() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        this.pageNumbers.innerHTML = '';

        const maxButtons = 5;
        let startPage = Math.max(1, this.currentPage - Math.floor(maxButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxButtons - 1);
        
        if (endPage - startPage + 1 < maxButtons) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        // Previous button
        this.prevBtn.disabled = this.currentPage === 1 || totalPages === 0;

        // Page buttons
        for (let i = startPage; i <= endPage; i++) {
            const button = this.createPageButton(i);
            this.pageNumbers.appendChild(button);
        }

        // Next button
        this.nextBtn.disabled = this.currentPage === totalPages || totalPages === 0;
    }

    createPageButton(pageNum) {
        const button = document.createElement('button');
        button.textContent = pageNum;
        button.type = 'button';
        button.className = pageNum === this.currentPage
            ? 'px-3 py-2 bg-purple-600 text-white rounded-lg text-sm font-medium'
            : 'px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium';
        button.addEventListener('click', () => this.goToPage(pageNum));
        return button;
    }

    updatePaginationInfo() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        const startItem = this.filteredRows.length === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
        const endItem = Math.min(this.currentPage * this.itemsPerPage, this.filteredRows.length);

        document.getElementById('startItem').textContent = startItem;
        document.getElementById('endItem').textContent = endItem;
        document.getElementById('totalItems').textContent = this.filteredRows.length;
    }

    goToPage(pageNum) {
        this.currentPage = pageNum;
        this.render();
    }

    previousPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
            this.render();
        }
    }

    nextPage() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        if (this.currentPage < totalPages) {
            this.currentPage++;
            this.render();
        }
    }
}
