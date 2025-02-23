@extends('layouts.master')

@section('title')
    <title>Hakim Home</title>
@endsection

@section('content')
    <div class="preloader text-white fs-6 text-uppercase overflow-hidden"></div>
    
    @include('frontend.billboard-section')

    @include('frontend.features')

    @include('frontend.categories')

    @include('frontend.new-arrival')

    @include('frontend.collection')

    @include('frontend.best-sellers')

    @include('frontend.video')

    @include('frontend.testimonials')

    @include('frontend.related-products')

    @include('frontend.blog')

    @include('frontend.logo')

    @include('frontend.newsletter')

    @include('frontend.icons')

    @include('frontend.instagram')

@endsection


@section('js')
<script src="{{ asset('frontends/bosuutap/bosuutap.js') }}"></script>
@endsection