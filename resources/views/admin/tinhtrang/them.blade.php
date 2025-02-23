@extends('layouts.admin')


@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<h1>Thêm Tình Trạng</h1>
<form action="{{ route('tinhtrang.them') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="tinhtrang" class="form-label">Tên Tình Trạng</label>
        <input type="text" class="form-control" id="tinhtrang" name="tinhtrang" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm Tình Trạng</button>
</form>


@endsection
