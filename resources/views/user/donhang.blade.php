<!-- resources/views/donhang.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Danh sách đơn hàng</h2>

    @foreach($donHangs as $donHang)
        <div class="card mb-4">
            <div class="card-header">
                <h5>Đơn hàng #{{ $donHang->id }} - Tình trạng: {{ $donHang->TinhTrang->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Ngày tạo:</strong> {{ $donHang->created_at }}</p>
                <p><strong>Địa chỉ giao hàng:</strong> {{ $donHang->diachigiaohang }}</p>
                <p><strong>Điện thoại giao hàng:</strong> {{ $donHang->dienthoaigiaohang }}</p>
                
                <h6>Sản phẩm trong đơn hàng</h6>
                @if($donHang->DonHang_ChiTiet->isEmpty())
                    <p>Không có sản phẩm trong đơn hàng này.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donHang->DonHang_ChiTiet as $chiTiet)
                                <tr>
                                    <td>{{ $chiTiet->product->name }}</td>
                                    <td>{{ $chiTiet->soluongban }}</td>
                                    <td>{{ number_format($chiTiet->dongiaban) }} <sup><u>đ</u></sup></td>
                                    <td>{{ number_format($chiTiet->soluongban * $chiTiet->dongiaban) }} <sup><u>đ</u></sup></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <h6>Tổng tiền: 
                    {{ number_format($donHang->DonHang_ChiTiet->sum(function ($chiTiet) { 
                        return $chiTiet->soluongban * $chiTiet->dongiaban; 
                    })) }} <sup><u>đ</u></sup>
                </h6>
            </div>
        </div>
    @endforeach
</div>
@endsection
