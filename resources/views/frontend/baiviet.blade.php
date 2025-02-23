  @extends('layouts.master')
  @section('title', $title)
  @section('content')


  <link rel="stylesheet" href="{{ asset('frontends/blog/css/blog.css') }}">
  <div class="container pb-5 mb-2 mb-md-4">
    <div class="pt-3 mt-md-3">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
          function LayHinhDauTien($strNoiDung)
          {
            $first_img = '';
            ob_start();
            ob_end_clean();
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strNoiDung, $matches);
            if(empty($output))
              return asset('public/img/noimage.png');
            else
              return str_replace('&amp;', '&', $matches[1][0]);
          }
        @endphp
  @foreach($baiviet as $value)
  <div class="card">
    <a class="blog-entry-thumb" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}">
      <img class="card-img-top object-cover w-full" src="{{ LayHinhDauTien($value->noidung) }}" alt="image" />
    </a>
    <div class="card-body">
      <h2 class="blog-entry-title">
        <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}">
          {{ $value->tieude }}
        </a>
      </h2>
      <p class="fs-md text-justify text-muted">{!! $value->tomtat !!}</p>
      <a class="btn-tag" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => $value->ChuDe->tenchude_slug]) }}">{{ $value->ChuDe->tenchude }}</a>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-between">
      <a class="blog-entry-meta-link" href="#user">
        <div class="blog-entry-author-ava">
          <img src="{{ asset('images/insta-item6.jpg') }}" class="rounded-circle" width="30" height="30" alt="author"/>
        </div>
        {{ $value->User->name }}
      </a>
      <div class="ms-auto text-nowrap">
        <a class="blog-entry-meta-link text-nowrap" href="#date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</a>
        <span class="blog-entry-meta-divider mx-2"></span>
        <a class="blog-entry-meta-link text-nowrap" href="#view"><i class="ci-eye"></i>{{ $value->luotxem }}</a>
      </div>
    </div>
  </div>
  @endforeach

    
      </div>
      <hr class="mb-4">
      @include('frontend.instagram')
      <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Prev</a></li>
        </ul>
        <ul class="pagination">
          <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">5</a></li>
        </ul>
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
        </ul>
      </nav>
    </div>
  </div>
  @endsection
  <script src="blog/js/app.js"></script>

