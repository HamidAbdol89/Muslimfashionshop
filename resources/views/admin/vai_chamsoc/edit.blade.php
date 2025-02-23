@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Vải & chăm sóc', 'key' => 'chỉnh sửa'])

<!-- Hiển thị thông báo thành công nếu có -->
@if(session('success'))
<div class="bg-green-500 text-white p-4 rounded-md shadow-md mb-6">
    {{ session('success') }}
</div>
@endif

<!-- Form Chỉnh sửa -->
<form action="{{ route('vai_chamsoc.update', $vaiChamsoc->id) }}" method="POST" class="space-y-6 bg-white p-8 rounded-xl shadow-xl">
    @csrf
    @method('PUT') <!-- Chỉ ra đây là phương thức PUT để cập nhật -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Chọn sản phẩm (Datalist) -->
        <div>
            <label for="product_id" class="block text-lg font-semibold text-gray-700 mb-2">Chọn sản phẩm</label>
            <input type="text" id="product_id" name="product_id" class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" list="products" placeholder="Chọn sản phẩm" value="{{ $vaiChamsoc->product_id }}" required>
            <datalist id="products">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $vaiChamsoc->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </datalist>
            @error('product_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Vải -->
        <div>
            <label for="vai" class="block text-lg font-semibold text-gray-700 mb-2">Vải</label>
            <input type="text" name="vai" id="vai" class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('vai', $vaiChamsoc->vai) }}" required>
            @error('vai')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Chăm sóc vải -->
        <div>
            <label for="cham_soc_vai" class="block text-lg font-semibold text-gray-700 mb-2">Chăm sóc vải</label>
            <input type="text" name="cham_soc_vai" id="cham_soc_vai" class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('cham_soc_vai', $vaiChamsoc->cham_soc_vai) }}" required>
            @error('cham_soc_vai')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

     <!-- Trọng lượng -->
<div>
    <label for="trong_luong_vai" class="block text-lg font-semibold text-gray-700 mb-2">Trọng lượng vải (kg, m, g, ...)</label>
    <input type="text" name="trong_luong_vai" id="trong_luong_vai" class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('trong_luong_vai', $vaiChamsoc->trong_luong_vai) }}" placeholder="Trung bình (175 gsm)" required>
    @error('trong_luong_vai')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>


        <!-- Mã vải -->
        <div>
            <label for="ma_vai" class="block text-lg font-semibold text-gray-700 mb-2">Mã vải</label>
            <input type="text" name="ma_vai" id="ma_vai" class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('ma_vai', $vaiChamsoc->ma_vai) }}" required>
            @error('ma_vai')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <!-- Nút Submit -->
    <div class="flex justify-between items-center mt-8">
        <button type="submit" class="inline-block bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Cập nhật thông tin
        </button>
        <a href="{{ route('vai_chamsoc.index') }}" class="text-indigo-600 hover:text-indigo-800 transition duration-200 ease-in-out">
            Quay lại danh sách
        </a>
    </div>
</form>
@endsection
