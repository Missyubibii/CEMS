{{-- <div class="relative min-h-screen lg:flex">
    <main class="flex-1 pb-12 space-y-6 overflow-y-auto bg-gray-100 lg:h-screen md:space-y-8 w-full">
        <section id="room-management" class="flex-grow w-full">
            <section class="flex flex-col w-full px-6 md:justify-between md:items-center md:flex-row">
                @if(auth()->guard('admin')->check())
                <div>
                    <h2 class="text-3xl font-medium text-gray-800">Quản lý phòng học</h2>
                </div>
                <div class="flex flex-col mt-6 md:flex-row md:-mx-1 md:mt-0">
                    <button onclick="toggleRoomForm()" class="px-6 py-3 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                        <div class="flex items-center justify-center -mx-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <h2 id="formTitle" class="mx-1 text-sm capitalize">Thêm phòng học</h2>
                        </div>
                    </button>
                </div>
            </section>
            <div class="flex flex-col mt-6 w-full ml-5">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 w-full">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 w-full">
                        <div class="overflow-hidden border border-gray-200 md:rounded-lg w-full">
                            <table class="min-w-full divide-y divide-gray-200 w-full items-center">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">ID</th>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">Tên phòng học</th>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">Sức chứa</th>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">Địa chỉ</th>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">Tình trạng</th>
                                        <th scope="col" class="py-3.5 px-4 text-base font-medium text-left rtl:text-right text-gray-900 ">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-200">
                                    @foreach($rooms as $room)
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $room->id }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900  whitespace-nowrap">{{ $room->room_name }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900  whitespace-nowrap">{{ $room->capacity }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-900  whitespace-nowrap">{{ $room->location }}</td>
                                        <td class="px-4 py-2">
                                            <span class="
                                                text-left rtl:text-right
                                                {{ $room->status === 'Còn trống' ?    ' text-base font-medium text-green-600 rounded-nor ' : '' }}
                                                {{ $room->status === 'Đang sử dụng' ? ' text-base font-medium text-blue-600 rounded-full ' : '' }}
                                                {{ $room->status === 'Đang bảo trì' ? ' text-base font-medium text-yellow-600 rounded-full ' : '' }}
                                                {{ $room->status === 'Hỏng hóc'     ? ' text-base font-medium text-red-600 rounded-nor ' : '' }}
                                            ">
                                                {{ $room->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900  whitespace-nowrap">
                                            <button type="button" onclick="toggleRoomForm({{ $room->id }})" class="px-6 py-1.5 text-base font-medium text-blue-600 rounded-full bg-blue-400/60">Sửa</button>
                                            <form action="{{ route('admin.rooms.delete', $room->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-6 py-1.5 text-base font-medium text-pink-600 rounded-full bg-pink-400/60">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </main>
</div>

 --}}
