@extends('layouts.admin')



@section('content')

    @include('partials.content-header', ['name' => '', 'key' => ''])
    <div class="card">
        <div class="card-header">Bài viết</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.baiviet.them') }}" class="btn btn-info"><i class="fas fa-plus"></i> Thêm mới</a>
            </p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="20%">Chủ đề</th>
                        <th width="55%">Thông tin bài viết</th>
                        <th width="20%" colspan="4" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($baiviet as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->ChuDe->tenchude }}</td>
                            <td>
                                <span class="d-block fw-bold text-primary"><a
                                        href="{{ route('admin.baiviet.sua', ['id' => $value->id]) }}">{{ $value->tieude }}</a></span>
                                <span class="d-block small">
                                    Ngày đăng:
                                    <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}</strong>
                                    <br />Người đăng: <strong>{{ $value->User->name }}</strong>
                                    <br />Có <strong>{{ $value->luotxem }}</strong> lượt xem
                                </span>
                            </td>
                            <td class="text-center" title="Trạng thái kiểm duyệt">
                                <a href="{{ route('admin.baiviet.kiemduyet', ['id' => $value->id]) }}">
                                    @if ($value->kiemduyet == 1)
                                        <i class="fas fa-circle-check"></i>
                                    @else
                                        <i class="fas fa-circle-xmark text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center" title="Trạng thái hiển thị">
                                <a href="{{ route('admin.baiviet.kichhoat', ['id' => $value->id]) }}">
                                    @if ($value->kichhoat == 1)
                                        <i class="fas fa-eye"></i>
                                    @else
                                        <i class="fas fa-eye-slash text-danger"></i>
                                    @endif
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.baiviet.sua', ['id' => $value->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.baiviet.xoa', ['id' => $value->id]) }}"
                                    onclick="return confirm('Bạn có muốn xóa bài viết {{ $value->tieude }} không?')">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
