@extends('admin.layouts.main')

@push('title')
<title>Edit Blog | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <h2 class="fw-bold my-4">Edit Blog</h2>
            <p class="text-muted mb-4">Update the blog details below.</p>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Card -->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">

                            <!-- Blog Title -->
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                            </div>

                            <!-- Excerpt -->
                            <div class="col-md-6">
                                <label for="excerpt" class="form-label">Excerpt</label>
                                <textarea name="excerpt" id="excerpt" class="form-control" rows="2" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <!-- Content -->
                            <div class="col-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <!-- Current Image -->
                            <div class="col-md-6">
                                <label class="form-label">Current Image</label><br>
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" width="120" class="img-thumbnail mb-2">
                                @else
                                    <p class="text-muted">No image uploaded.</p>
                                @endif
                            </div>

                            <!-- Change Image -->
                            <div class="col-md-6">
                                <label for="image" class="form-label">Change Image (optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <small class="text-muted">Upload a new image to replace the current one.</small>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update Blog</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

@endsection
