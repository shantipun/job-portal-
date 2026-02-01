@extends('admin.layouts.main')

@push('title')
<title>Add Job Category | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <h2 class="fw-bold my-4">Add New Job Category</h2>
            <p class="text-muted mb-4">Fill in the details below to create a new job category.</p>

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
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">
                                <label for="icon" class="form-label">Icon (optional)</label>
                                <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon') }}">
                                <small class="text-muted">Use Bootstrap icon class (e.g., bi-laptop)</small>
                            </div>
                            <div class="col-md-6">
                            <label for="image" class="form-label">Industry Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <small class="text-muted">Optional image/logo for the industry</small>

                            @if(isset($category) && $category->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$category->image) }}" width="100" alt="{{ $category->name }}">
                                </div>
                            @endif
                        </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('keyup', function() {
        let slug = this.value.toLowerCase()
                     .replace(/ /g, '-')
                     .replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endpush
@endsection
