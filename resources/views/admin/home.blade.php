@extends('layouts.admin')

@section('title')
    <title>Admin Dashboard</title>
@endsection

@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
<div class="container mt-4">
    <h1>Chào mừng đến với quản trị viên</h1>
    <p>Bạn đã đăng nhập thành công! <strong>{{ Auth::user()->name }}</strong>.</p>
</div>
@endsection
