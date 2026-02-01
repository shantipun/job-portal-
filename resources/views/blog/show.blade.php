@extends('layouts.main')

@push('title')
<title>{{ $blog->title }} - JobNest</title>
@endpush

@section('content')
<section class="py-5">
    <div class="container">

    

        <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>
        <p class="text-muted mb-4">Published on {{ $blog->created_at->format('M d, Y') }}</p>

        @if($blog->image)
            <img src="{{ asset($blog->image) }}" class="img-fluid mb-4 rounded" alt="{{ $blog->title }}">
        @endif

        <div class="blog-content text-muted fs-6">
            {!! nl2br(e($blog->content)) !!}
        </div>
            <!-- Back Button -->
        <a href="{{ url()->previous() }}" 
   class="btn btn-outline-primary btn-lg mb-4 mt-4 w-40 text-center">
   <i class="fa-solid fa-arrow-left me-2"></i> Back
</a>
    </div>
</section>

@endsection
