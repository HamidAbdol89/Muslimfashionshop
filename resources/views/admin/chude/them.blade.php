@extends('layouts.admin')
@section('content')
@include('partials.content-header', ['name' => '', 'key' => ''])
 <div class="card">
 <div class="card-header">Thêm chủ đề</div>
 <div class="card-body">
 <form action="{{ route('admin.chude.them') }}" method="post">
 @csrf
 
 <div class="mb-3">
 <label class="form-label" for="tenchude">Tên chủ đề</label>
 <input type="text" class="form-control @error('tenchude') is-invalid @enderror" id="tenchude" name="tenchude" value="{{ old('tenchude') }}" required />
 @error('tenchude')
 <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
 @enderror
 </div>
 
 <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
 </form>
 </div>
 </div>
@endsection