@extends('admin.layouts.main')

@push('title')
<title>Edit Company | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <h2 class="fw-bold my-4">Edit Company</h2>
            <p class="text-muted mb-4">Update the details of the company below.</p>

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
                    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <!-- Company Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $company->name) }}" required>
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $company->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control"
                                       value="{{ old('location', $company->location) }}">
                            </div>
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

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status', $company->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $company->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <!-- Logo -->
                            <div class="col-md-6">
                                <label for="logo" class="form-label">Company Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control">
                                @if($company->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }}" width="100" class="rounded">
                                    </div>
                                @endif
                                <small class="text-muted">Upload new logo to replace existing one (optional)</small>
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Company
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

@endsection
