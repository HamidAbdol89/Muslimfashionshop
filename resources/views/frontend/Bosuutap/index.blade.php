@extends('layouts.master')

<link rel="stylesheet" href="{{ asset('frontends/bosuutap/bosuutap.css') }}">
@section('content')

    <div class="container mx-auto py-12">
        <h1 class="collection-title text-4xl font-bold text-center text-gray-800 mb-10">Collection</h1>

        <!-- Bộ sưu tập slider -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 masonry">
            @foreach ($sliders as $slider)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ asset('storage/' . str_replace('http://localhost:8001/storage/', '', $slider->image_path)) }}"
                        alt="{{ $slider->name }}" class="w-full object-cover h-auto rounded-lg">
                </div>
            @endforeach
        </div>
        
    </div>

@endsection
