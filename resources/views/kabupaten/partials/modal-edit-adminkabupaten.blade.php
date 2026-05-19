<!-- Modal Edit Admin -->
<div id="editModal" class="modal-hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
        <h3 class="text-lg font-bold mb-4">Edit Status Admin</h3>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" id="editId" value="">
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Admin</p>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p id="editName" class="font-semibold text-gray-900"></p>
                    <p id="editEmail" class="text-sm text-gray-600 mt-1"></p>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" id="editStatus" name="isActive" value="1" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                    <span class="ml-3 text-sm text-gray-700">Admin Aktif</span>
                </label>
            </div>
            
            <div class="flex gap-3">
                <button type="button" class="close-modal flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
