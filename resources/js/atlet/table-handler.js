export class TableHandler {
    constructor(tableId) {
        this.table = document.getElementById(tableId);
        this.tbody = this.table.querySelector('tbody');
        this.itemsPerPageSelect = document.getElementById('itemsPerPage');
        this.searchInput = document.getElementById('searchInput');
        this.stableFilter = document.getElementById('stableFilter');
        this.statusFilter = document.getElementById('statusFilter');
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
        this.stableFilter.addEventListener('change', () => this.applyFilters());
        if (this.statusFilter) this.statusFilter.addEventListener('change', () => this.applyFilters());
        this.itemsPerPageSelect.addEventListener('change', () => {
            this.itemsPerPage = parseInt(this.itemsPerPageSelect.value);
            this.currentPage = 1;
            this.render();
        });
        this.clearFilterBtn.addEventListener('click', () => this.handleClearFilter());
        this.prevBtn.addEventListener('click', () => this.previousPage());
        this.nextBtn.addEventListener('click', () => this.nextPage());
    }

    applyFilters() {
        const search = this.searchInput.value.toLowerCase();
        const stableId = this.stableFilter.value;
        const status = this.statusFilter ? this.statusFilter.value : '';

        this.filteredRows = this.allRows.filter(row => {
            const stableMatch = !stableId || row.dataset.stableId === stableId;
            const statusMatch = !status || row.dataset.status === status;
            const searchMatch = !search || row.textContent.toLowerCase().includes(search);
            return stableMatch && statusMatch && searchMatch;
        });

        this.currentPage = 1;
        this.render();
    }

    handleClearFilter() {
        this.searchInput.value = '';
        this.stableFilter.value = '';
        if (this.statusFilter) this.statusFilter.value = '';
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
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        const paginated = this.filteredRows.slice(start, end);

        this.tbody.innerHTML = '';

        if (paginated.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="10" class="text-center text-gray-500 py-8 text-sm">Tidak ada data atlet</td>`;
            this.tbody.appendChild(row);
        } else {
            paginated.forEach((row, index) => {
                row.cells[0].textContent = start + index + 1;
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

    updatePaginationInfo() {
        const start = this.filteredRows.length === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
        const end = Math.min(this.currentPage * this.itemsPerPage, this.filteredRows.length);
        document.getElementById('startItem').textContent = start;
        document.getElementById('endItem').textContent = end;
        document.getElementById('totalItems').textContent = this.filteredRows.length;
    }

    previousPage() {
        if (this.currentPage > 1) { this.currentPage--; this.render(); }
    }

    nextPage() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        if (this.currentPage < totalPages) { this.currentPage++; this.render(); }
    }
}
