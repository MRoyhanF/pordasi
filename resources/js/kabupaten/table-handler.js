/**
 * Table Handler
 * Handles table filtering, pagination, and display
 */

class TableHandler {
    constructor(tableId, options = {}) {
        this.table = document.getElementById(tableId);
        this.tbody = document.getElementById('tableBody');
        this.searchInput = document.getElementById('searchInput');
        this.itemsPerPageSelect = document.getElementById('itemsPerPage');
        this.clearFilterBtn = document.getElementById('clearFilter');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.pageNumbersContainer = document.getElementById('pageNumbers');
        
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.allRows = [];
        this.filteredRows = [];
        
        this.init();
        this.attachEventListeners();
    }
    
    init() {
        // Ambil semua baris dari table, kecuali empty state row
        const rows = Array.from(this.table.querySelectorAll('tbody tr')).filter(row => {
            // Skip empty state row yang berisi "Tidak ada data"
            return !row.textContent.includes('Tidak ada data');
        });
        
        this.allRows = rows.map(row => ({
            element: row,
            name: row.querySelector('td:nth-child(2) a')?.textContent?.toLowerCase() || '',
            html: row.innerHTML
        }));
        
        if (this.allRows.length > 0) {
            this.filteredRows = [...this.allRows];
            this.render();
        }
    }
    
    attachEventListeners() {
        this.searchInput.addEventListener('input', () => this.handleSearch());
        this.itemsPerPageSelect.addEventListener('change', () => this.handleItemsPerPageChange());
        this.clearFilterBtn.addEventListener('click', () => this.handleClearFilter());
        this.prevBtn.addEventListener('click', () => this.previousPage());
        this.nextBtn.addEventListener('click', () => this.nextPage());
    }
    
    handleSearch() {
        const searchTerm = this.searchInput.value.toLowerCase();
        
        if (searchTerm === '') {
            this.filteredRows = [...this.allRows];
        } else {
            this.filteredRows = this.allRows.filter(row => 
                row.name.includes(searchTerm)
            );
        }
        
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
        this.itemsPerPageSelect.value = 10;
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
        const paginatedRows = this.filteredRows.slice(start, end);
        
        if (paginatedRows.length === 0) {
            this.tbody.innerHTML = `<tr><td colspan="7" class="text-center text-gray-500 py-8 text-sm">Tidak ada data yang cocok</td></tr>`;
            return;
        }
        
        this.tbody.innerHTML = paginatedRows.map((row, index) => {
            const rowNumber = start + index + 1;
            const tr = document.createElement('tr');
            tr.innerHTML = row.html;
            
            // Update nomor urut
            const noCell = tr.querySelector('td:first-child');
            if (noCell) noCell.textContent = rowNumber;
            
            tr.className = 'hover:bg-gray-50 border-b border-gray-100 transition';
            
            return tr.outerHTML;
        }).join('');
    }
    
    renderPagination() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        this.pageNumbersContainer.innerHTML = '';
        
        if (totalPages <= 1) {
            this.prevBtn.disabled = true;
            this.nextBtn.disabled = true;
            return;
        }
        
        // Calculate page range to show
        let startPage = Math.max(1, this.currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);
        
        // Previous button
        this.prevBtn.disabled = this.currentPage === 1;
        
        // First page ellipsis
        if (startPage > 1) {
            const btn = this.createPageButton(1);
            this.pageNumbersContainer.appendChild(btn);
            
            if (startPage > 2) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'px-2 py-2 text-gray-500';
                ellipsis.textContent = '...';
                this.pageNumbersContainer.appendChild(ellipsis);
            }
        }
        
        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            const btn = this.createPageButton(i);
            this.pageNumbersContainer.appendChild(btn);
        }
        
        // Last page ellipsis
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'px-2 py-2 text-gray-500';
                ellipsis.textContent = '...';
                this.pageNumbersContainer.appendChild(ellipsis);
            }
            
            const btn = this.createPageButton(totalPages);
            this.pageNumbersContainer.appendChild(btn);
        }
        
        // Next button
        this.nextBtn.disabled = this.currentPage === totalPages;
    }
    
    createPageButton(pageNum) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = pageNum;
        btn.className = `px-3 py-2 rounded-lg text-sm font-medium transition ${
            this.currentPage === pageNum 
                ? 'bg-blue-600 text-white border border-blue-600' 
                : 'border border-gray-300 text-gray-700 hover:bg-gray-200'
        }`;
        
        btn.addEventListener('click', () => this.goToPage(pageNum));
        return btn;
    }
    
    updatePaginationInfo() {
        const totalPages = Math.ceil(this.filteredRows.length / this.itemsPerPage);
        const start = this.filteredRows.length === 0 ? 0 : (this.currentPage - 1) * this.itemsPerPage + 1;
        const end = Math.min(this.currentPage * this.itemsPerPage, this.filteredRows.length);
        const total = this.filteredRows.length;
        
        document.getElementById('startItem').textContent = start;
        document.getElementById('endItem').textContent = end;
        document.getElementById('totalItems').textContent = total;
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

export { TableHandler };
