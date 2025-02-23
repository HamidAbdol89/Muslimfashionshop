@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])

<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold text-center mb-6">Danh sách Liên Hệ</h1>

    <!-- Thêm ô tìm kiếm email -->
    <div class="mb-4">
        <input type="text" id="emailSearchInput" class="form-control" placeholder="Tìm kiếm theo Email..." />
    </div>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Tên</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Số điện thoại</th>
                <th class="px-4 py-2 text-left">Tin nhắn</th>
                <th class="px-4 py-2 text-left">Ngày tạo</th>
                <th class="px-4 py-2 text-left">Ngày cập nhật</th>
            </tr>
        </thead>
        <tbody id="contactsTableBody">
            @foreach($contacts as $contact)
                <tr>
                    <td class="px-4 py-2">{{ $contact->id }}</td>
                    <td class="px-4 py-2">{{ $contact->name }}</td>
                    <td class="px-4 py-2">{{ $contact->email }}</td>
                    <td class="px-4 py-2">{{ $contact->phone }}</td>
                    <td class="px-4 py-2">{{ $contact->message }}</td>
                    <td class="px-4 py-2">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-4 py-2">{{ $contact->updated_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailSearchInput = document.getElementById('emailSearchInput');
        const contactsTableBody = document.getElementById('contactsTableBody');

        emailSearchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();

            // Gửi yêu cầu tìm kiếm email tới route
            fetch(`contact/search?email=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Làm mới bảng danh sách liên hệ dựa trên kết quả lọc
                    contactsTableBody.innerHTML = '';
                    data.contacts.forEach(contact => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="px-4 py-2">${contact.id}</td>
                            <td class="px-4 py-2">${contact.name}</td>
                            <td class="px-4 py-2">${contact.email}</td>
                            <td class="px-4 py-2">${contact.phone}</td>
                            <td class="px-4 py-2">${contact.message}</td>
                            <td class="px-4 py-2">${contact.created_at}</td>
                            <td class="px-4 py-2">${contact.updated_at}</td>
                        `;
                        contactsTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Có lỗi khi tải dữ liệu:', error));
        });
    });
</script>
@endsection
