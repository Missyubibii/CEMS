<section id="deviceFormModal" class="hidden fixed inset-0 overflow-y-auto bg-gray-900/60 w-full">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 id="formTitle" class="text-lg font-semibold text-gray-900 capitalize">Thêm thiết bị học</h2>
            <form id="deviceForm" class="gap-6 mt-4 sm:grid-cols-2">
                @csrf
                @method('PUT')
                <input type="hidden" id="device_id">
                <div class="mb-4">
                    <label for="device_name" class="block text-sm font-medium text-gray-700">Tên thiết bị</label>
                    <input type="text" id="device_name" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Số lượng</label>
                    <input type="number" id="quantity" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Loại thiết bị</label>
                    <input type="text" id="category" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Tình trạng</label>
                    <select id="status" class="w-full p-2 border rounded">
                        <option value="Chưa sử dụng">Chưa sử dụng</option>
                        <option value="Đang sử dụng">Đang sử dụng</option>
                        <option value="Đang bảo trì">Đang bảo trì</option>
                        <option value="Hỏng hóc">Hỏng hóc</option>
                    </select>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="closeDeviceForm()" class="mr-2 px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-red-700 rounded-md hover:bg-red-500 focus:outline-none">Hủy</button>
                    <button type="submit" class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-blue-700 rounded-md hover:bg-blue-500 focus:outline-none">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</section>
