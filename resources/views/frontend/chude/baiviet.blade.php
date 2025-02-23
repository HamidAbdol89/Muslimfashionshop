@extends('layouts.master')

@section('content')
    <h1>Bài viết theo chuyên mục: {{ $chude->tenchude }}</h1>

    @if($baiviet->isEmpty())
        <p>Không có bài viết nào trong chuyên mục này.</p>
    @else
        <ul>
            @foreach ($baiviet as $bv)
                <li>
                    <a href="{{ route('frontend.baiviet.show', $bv->id) }}">
                        {{ $bv->tieude }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
