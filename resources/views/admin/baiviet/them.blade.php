@extends('layouts.admin')
@section('content')
    @include('partials.content-header', ['name' => '', 'key' => ''])
    <div class="card">
        <div class="card-header">Thêm bài viết</div>
        <div class="card-body">
            <form action="{{ route('admin.baiviet.them') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="chude_id">Chủ đề</label>
                    <select class="form-select @error('chude_id') is-invalid @enderror" id="chude_id" name="chude_id"
                        required>
                        <option value="">-- Chọn --</option>
                        @foreach ($chude as $value)
                            <option value="{{ $value->id }}">{{ $value->tenchude }}</option>
                        @endforeach
                    </select>
                    @error('chude_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tieude">Tiêu đề</label>
                    <input type="text" class="form-control @error('tieude') is-invalid @enderror" id="tieude"
                        name="tieude" value="{{ old('tieude') }}" required />
                    @error('tieude')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tomtat">Tóm tắt</label>
                    <textarea class="form-control" id="tomtat" name="tomtat">{{ old('tomtat') }}</textarea>
                    @error('tomtat')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="noidung">Nội dung bài viết</label>
                    <textarea id="noidung" name="noidung" class="form-control" style="display: none;"></textarea>
                    @error('noidung')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendor/ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#noidung'))
            .then(editor => {
                window.editor = editor;

                // Đồng bộ nội dung với <textarea> trước khi submit
                document.querySelector('form').addEventListener('submit', function() {
                    document.querySelector('#noidung').value = editor.getData();
                });
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });

        document.querySelector('form').addEventListener('submit', function(e) {
            // Lấy nội dung từ CKEditor
            const content = window.editor.getData();

            if (!content.trim()) {
                e.preventDefault(); // Ngăn gửi form
                alert('Nội dung không được để trống!');
            } else {
                // Đồng bộ nội dung với <textarea> trước khi submit
                document.querySelector('#noidung').value = content;
            }
        });
    </script>
@endsection
