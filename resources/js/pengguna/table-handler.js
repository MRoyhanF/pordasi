export class TableHandler {
    constructor(tableId) {
        this.table = document.getElementById(tableId);
        this.tbody = this.table.querySelector('tbody');
        this.itemsPerPageSelect = document.getElementById('itemsPerPage');
        this.searchInput = document.getElementById('searchInput');
        this.roleFilter = document.getElementById('roleFilter');
        this.clearFilterBtn = document.getElementById('clearFilter');
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
        this.searchInput.addEventListener('input', () => this.applyFilters());
        this.roleFilter.addEventListener('change', () => this.applyFilters());
        this.itemsPerPageSelect.addEventListener('change', () => {
            this.itemsPerPage = parseInt(this.itemsPerPageSelect.value);
            this.currentPage = 1;
            this.render();
        });
        this.clearFilterBtn.addEventListener('click', () => {
            this.searchInput.value = '';
            this.roleFilter.value = '';
            this.itemsPerPageSelect.value = '10';
            this.itemsPerPage = 10;
            this.currentPage = 1;
            this.filteredRows = [...this.allRows];
            this.render();
        });
        this.prevBtn.addEventListener('click', () => {
            if (this.currentPage > 1) { this.currentPage--; this.render(); }
        });
        this.nextBtn.addEventListener('click', () => {
            const total = Math.ceil(this.filteredRows.length / this.itemsPerPage);
            if (this.currentPage < total) { this.currentPage++; this.render(); }
        });
    }

    applyFilters() {
        const search = this.searchInput.value.toLowerCase();
        const role = this.roleFilter.value;

        this.filteredRows = this.allRows.filter(row => {
            const roleMatch = !role || row.dataset.role === role;
            const searchMatch = !search || row.textContent.toLowerCase().includes(search);
            return roleMatch && searchMatch;
        });

        this.currentPage = 1;
        this.render();
    }

    render() {
        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const paginatedRows = this.filteredRows.slice(startIndex, startIndex + this.itemsPerPage);

        this.tbody.innerHTML = '';

        if (paginatedRows.length === 0) {
            const empty = document.createElement('tr');
            empty.innerHTML = `<td colspan="6" class="text-center text-gray-500 py-8 text-sm">Tidak ada data pengguna</td>`;
            this.tbody.appendChild(empty);
        } else {
            paginatedRows.forEach((row, index) => {
                row.cells[0].textContent = startIndex + index + 1;
                this.tbody.appendChild(row);
            });
        }

        this.renderPagination();
        this.updateInfo(startIndex);
    }

    renderPagination() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        this.pageNumbers.innerHTML = '';

        const maxButtons = 5;
        let startPage = Math.max(1, this.currentPage - Math.floor(maxButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxButtons - 1);
        if (endPage - startPage + 1 < maxButtons) startPage = Math.max(1, endPage - maxButtons + 1);

        this.prevBtn.disabled = this.currentPage === 1 || totalPages === 0;
        this.nextBtn.disabled = this.currentPage === totalPages || totalPages === 0;

        for (let i = startPage; i <= endPage; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.type = 'button';
            btn.className = i === this.currentPage
                ? 'px-3 py-2 bg-green-600 text-white rounded-lg text-sm font-medium'
                : 'px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm font-medium';
            btn.addEventListener('click', () => { this.currentPage = i; this.render(); });
            this.pageNumbers.appendChild(btn);
        }
    }

    updateInfo(startIndex) {
        const endIndex = Math.min(startIndex + this.itemsPerPage, this.filteredRows.length);
        document.getElementById('startItem').textContent = this.filteredRows.length === 0 ? 0 : startIndex + 1;
        document.getElementById('endItem').textContent = endIndex;
        document.getElementById('totalItems').textContent = this.filteredRows.length;
    }
}
