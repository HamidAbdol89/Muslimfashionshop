@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => 'Vải & chăm sóc', 'key' => 'Danh sách'])

<!-- Nút thêm mới sản phẩm -->
<a href="{{ route('vai_chamsoc.create') }}" class="btn btn-primary">Thêm mới</a>
 <!-- Hiển thị phân trang -->
 <div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-4') }}
</div>
<table class="min-w-full table-auto">
    <thead>
        <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Tên Sản phẩm</th>
            <th class="px-4 py-2 border">Vải</th>
            <th class="px-4 py-2 border">Chăm sóc vải</th>
            <th class="px-4 py-2 border">Trọng Lượng</th>
            <th class="px-4 py-2 border">Mã Vải</th>
            <th class="px-4 py-2 border">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td class="px-4 py-2 border">{{ $product->id }}</td>
                <td class="px-4 py-2 border">{{ $product->name }}</td>
    
                <!-- Hiển thị thông tin vải -->
                <td class="px-4 py-2 border">
                    @if($product->vaiChamsoc && $product->vaiChamsoc->count() > 0)
                        @foreach($product->vaiChamsoc as $vai)
                            @if($vai && isset($vai->vai))
                                <div>{{ $vai->vai }}</div>
                            @endif
                        @endforeach
                    @else
                        <div>Không có thông tin vải</div>
                    @endif
                </td>
    
                <!-- Hiển thị thông tin chăm sóc vải -->
                <td class="px-4 py-2 border">
                    @if($product->vaiChamsoc && $product->vaiChamsoc->count() > 0)
                        @foreach($product->vaiChamsoc as $vai)
                            @if($vai && isset($vai->cham_soc_vai))
                                <div>{{ $vai->cham_soc_vai }}</div> <!-- Hiển thị giá trị thật của cham_soc_vai -->
                            @endif
                        @endforeach
                    @else
                        <div>Không có thông tin chăm sóc vải</div>
                    @endif
                </td>
                
    
                <!-- Hiển thị trọng lượng vải -->
                <td class="px-4 py-2 border">
                    @if($product->vaiChamsoc && $product->vaiChamsoc->count() > 0)
                        @foreach($product->vaiChamsoc as $vai)
                            @if($vai && isset($vai->trong_luong_vai))
                                <div>{{ $vai->trong_luong_vai }}</div>
                            @endif
                        @endforeach
                    @else
                        <div>Không có trọng lượng vải</div>
                    @endif
                </td>
    
                <!-- Hiển thị mã vải -->
                <td class="px-4 py-2 border">
                    @if($product->vaiChamsoc && $product->vaiChamsoc->count() > 0)
                        @foreach($product->vaiChamsoc as $vai)
                            @if($vai && isset($vai->ma_vai))
                                <div>{{ $vai->ma_vai }}</div>
                            @endif
                        @endforeach
                    @else
                        <div>Không có mã vải</div>
                    @endif
                </td>
    
                <!-- Các nút hành động -->
                <td class="px-4 py-2 border">
                    <a href="{{ route('vai_chamsoc.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
    
                    <form action="{{ route('vai_chamsoc.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    
    
    
    
</table>

@endsection
