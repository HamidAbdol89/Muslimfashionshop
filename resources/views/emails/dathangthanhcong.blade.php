<x-mail::message>
Xin chào {{ Auth::user()->name }}! 

Xin cảm ơn bạn đã đặt hàng tại {{ config('app.name', 'Laravel') }}. 

## Thông tin giao hàng: 

Điện thoại: **{{ $donhang->dienthoaigiaohang }}** 

Địa chỉ giao hàng: **{{ $donhang->diachigiaohang }}** 

## Thông tin đơn hàng đã đặt: 

<x-mail::table> 
| #    | Sản phẩm                       | SL    | Đơn giá   | Thành tiền  | 
|:-----|:-------------------------------|:-----:|----------:|------------:| 
@php $tongtien = 0; @endphp 
@foreach($donhang->DonHang_ChiTiet as $chitiet) 
| {{ $loop->iteration }} | {{ $chitiet->product->name }} | {{ $chitiet->soluongban }} | {{ number_format($chitiet->dongiaban) }}đ | 
{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}đ | 
@php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp 
@endforeach 
||||| **{{ number_format($tongtien) }}đ** | 
</x-mail::table> 

Trân trọng,<br> 
{{ config('app.name', 'Laravel') }} 
</x-mail::message>
