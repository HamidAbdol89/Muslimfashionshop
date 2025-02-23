@extends('layouts.admin')

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<div class="card">
    <div class="card-header">Sửa Tình Trạng</div>
    <div class="card-body">
        <form action="{{ route('tinhtrang.sua', ['id' => $tinhtrang->id]) }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="tinhtrang">Tên Tình Trạng</label>
                <input type="text" class="form-control @error('tinhtrang') is-invalid @enderror" id="tinhtrang" name="tinhtrang" value="{{ $tinhtrang->tinhtrang }}" required />
                @error('tinhtrang')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
