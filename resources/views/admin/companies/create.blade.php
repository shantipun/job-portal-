@extends('admin.layouts.main')

@push('title')
<title>Add Company | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <h2 class="fw-bold my-4">Add New Company</h2>
            <p class="text-muted mb-4">Fill in the details below to create a new company.</p>

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
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">

                            <!-- Company Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name') }}" required>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Company Website -->
                        <div class="col-md-6">
                            <label for="website" class="form-label">Company Website</label>
                            <input
                                type="url"
                                name="website"
                                id="website"
                                class="form-control"
                                placeholder="https://example.com"
                                value="{{ old('website') }}"
                            >
                        </div>

                                                    <!-- Location -->
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control"
                                       value="{{ old('location') }}">
                            </div>

                            <!-- Logo -->
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Company Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control">
                                <small class="text-muted">Upload company logo (optional, jpg/png, max 2MB)</small>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Add Company
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

@endsection
