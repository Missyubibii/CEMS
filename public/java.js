// Hàm mở modal Thêm/Sửa thiết bị
function toggleDeviceForm(device = null) {
    const formTitle = document.getElementById('formTitle');
    const device_id = document.getElementById('device_id');
    const device_name = document.getElementById('device_name');
    const quantity = document.getElementById('quantity');
    const category = document.getElementById('category');
    const status = document.getElementById('status');

    if (device) {
        formTitle.innerText = 'Cập nhật thiết bị';
        device_id.value = device.id;
        device_name.value = device.device_name;
        quantity.value = device.quantity;
        category.value = device.category;
        status.value = device.status;
    } else {
        formTitle.innerText = 'Thêm thiết bị';
        device_id.value = '';
        device_name.value = '';
        quantity.value = '';
        category.value = '';
        status.value = 'Chưa sử dụng';
    }

    document.getElementById('deviceFormModal').classList.remove('hidden');
}

// Hàm đóng modal
function closeDeviceForm() {
    document.getElementById('deviceFormModal').classList.add('hidden');
}

// AJAX gửi yêu cầu Thêm/Cập nhật thiết bị
document.getElementById('deviceForm').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const id = document.getElementById('device_id').value;
    const url = id ? `/admin/devices/update/${id}` : '/admin/devices/store';
    const method = id ? 'PUT' : 'POST';
    const csrfToken = document.querySelector('input[name="_token"]').value;

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            device_name: document.getElementById('device_name').value,
            quantity: document.getElementById('quantity').value,
            category: document.getElementById('category').value,
            status: document.getElementById('status').value,
        })
    })
    .then(response => response.json())
    .then(data => {
        showAlert(data.success);
        closeDeviceForm();
        fetchDevices();
    })
    .catch(error => {
        showAlert('Có lỗi xảy ra', 'error');
    });
});

// Hàm hiển thị thông báo tùy chỉnh
function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';

    alertDiv.className = `${bgColor} px-4 py-3 rounded relative mb-4`;
    alertDiv.innerHTML = `
        <strong class="font-bold">Thông báo:</strong> <span class="block sm:inline">${message}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.415l-2.934 2.934a1 1 0 1 1-1.414-1.414l2.934-2.934-2.934-2.934a1 1 0 1 1 1.414-1.414L10 8.585l2.934-2.934a1 1 0 0 1 1.414 1.414l-2.934 2.934 2.934 2.934a1 1 0 0 1 0 1.414z"/>
            </svg>
        </span>
    `;

    document.body.prepend(alertDiv);
}

// Xác nhận trước khi xóa thiết bị
function confirmDelete() {
    return confirm('Bạn có chắc muốn xóa thiết bị này?');
}

// Hàm mở modal Thêm/Sửa thiết bị
function toggleRoomForm(room = null) {
    const formTitle = document.getElementById('formTitle');
    const room_id = document.getElementById('room_id');
    const room_name = document.getElementById('room_name');
    const capacity = document.getElementById('capacity');
    const location = document.getElementById('location');
    const status = document.getElementById('status');

    if (room) {
        formTitle.innerText = 'Cập nhật phòng học';
        room_id.value = room.id;
        room_name.value = room.room_name;
        capacity.value = room.capacity;
        location.value = room.location;
        status.value = room.status;
    } else {
        formTitle.innerText = 'Thêm phòng học';
        room_id.value = '';
        room_name.value = '';
        capacity.value = '';
        location.value = '';
        status.value = 'Còn trống';
    }

    document.getElementById('roomFormModal').classList.remove('hidden');
}
// Hàm đóng modal
function closeRoomForm() {
    document.getElementById('roomFormModal').classList.add('hidden');
}
