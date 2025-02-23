@extends('layouts.admin')
@section('content')
    @include('partials.content-header', ['name' => '', 'key' => ''])
    <div class="card">
        <div class="card-header">Bình luận bài viết</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.binhluanbaiviet.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm
                    mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Người đăng</th>
                        <th width="55%">Thông tin bình luận</th>
                        <th width="20%" colspan="4" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($binhluanbaiviet as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->NguoiDung->name }}</td>
                            <td style="text-align:justify">
                                <span class="d-block fw-bold text-primary"><a
                                        href="{{ route('admin.binhluanbaiviet.sua', ['id' => $value->id]) }}">{{ $value->BaiViet->tieude }}</a></span>
                                <span class="d-block small">
                                    Ngày đăng:
                                    <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}</strong>
                                    <br />Nội dung bình luận: <strong>{{ $value->noidungbinhluan }}</strong>
                                </span>
                            </td>
                            <td class="text-center" title="Trạng thái kiểm duyệt">
                                <a href="{{ route('admin.binhluanbaiviet.kiemduyet', ['id' => $value->id]) }}">
                                    @if ($value->kiemduyet == 1)
                                        <i class="fas fa-lg fa-circle-check"></i>
                                    @else
                                        <i class="fas fa-lg fa-circle-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center" title="Trạng thái hiển thị">
                                <a href="{{ route('admin.binhluanbaiviet.kichhoat', ['id' => $value->id]) }}">
                                    @if ($value->kichhoat == 1)
                                        <i class="fas fa-lg fa-eye"></i>
                                    @else
                                        <i class="fas fa-lg fa-eye-slash text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.binhluanbaiviet.sua', ['id' => $value->id]) }}">
                                    <i class="fas fa-lg fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.binhluanbaiviet.xoa', ['id' => $value->id]) }}"
                                    onclick="return confirm('Bạn có muốn xóa bình luận của bài viết {{ $value->BaiViet->tieude }} không?')">
                                    <i class="fas fa-lg fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
