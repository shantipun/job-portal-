@extends('admin.layouts.main')

@push('title')
<title>Add Blog | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <h2 class="fw-bold my-4">Add New Blog</h2>
            <p class="text-muted mb-4">Fill in the details below to create a new blog post.</p>

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
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                            <!-- Blog Title -->
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <!-- Excerpt -->
                            <div class="col-md-6">
                                <label for="excerpt" class="form-label">Excerpt</label>
                                <textarea name="excerpt" id="excerpt" class="form-control" rows="2" required>{{ old('excerpt') }}</textarea>
                            </div>

                            <!-- Content -->
                            <div class="col-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
                            </div>

                            <!-- Image -->
                            <div class="col-md-6">
                                <label for="image" class="form-label">Image (optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <small class="text-muted">Upload an image for the blog post.</small>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Add Blog</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

@endsection
