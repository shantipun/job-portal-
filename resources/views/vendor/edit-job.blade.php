@extends('vendor.layouts.main')

@push('title')
<title>Edit Job</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4 mt-4">

        <h2 class="mb-4">Edit Job</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm p-4">
            <form action="{{ route('vendor.jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Job Title --}}
                    <div class="col-md-6">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                    </div>

                    {{-- Job Type --}}
                    <div class="col-md-6">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select name="job_type" id="job_type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="full-time" {{ old('job_type', $job->job_type)=='full-time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="part-time" {{ old('job_type', $job->job_type)=='part-time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="internship" {{ old('job_type', $job->job_type)=='internship' ? 'selected' : '' }}>Internship</option>
                            <option value="freelance" {{ old('job_type', $job->job_type)=='freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                    </div>

                    {{-- Company Dropdown --}}
                    <div class="col-md-6">
                        <label for="company_id" class="form-label">Company</label>
                        <select name="company_id" id="company_id" class="form-select" required>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $job->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category Dropdown --}}
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-6">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                    </div>

                    {{-- Salary --}}
                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary (Optional)</label>
                        <input type="text" name="salary" id="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
                    </div>

                    {{-- Last Date --}}
                    <div class="col-md-6">
                        <label for="last_date" class="form-label">Application Deadline</label>
                        <input type="date" name="last_date" id="last_date" class="form-control" value="{{ old('last_date', \Carbon\Carbon::parse($job->last_date)->format('Y-m-d')) }}" required>
                    </div>

                    {{-- Is Active --}}
                    <div class="col-md-6 form-check mt-4">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $job->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label for="description" class="form-label">Job Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    {{-- Responsibilities --}}
                    <div class="col-12">
                        <label for="responsibilities" class="form-label">Responsibilities</label>
                        <textarea name="responsibilities" id="responsibilities" class="form-control" rows="3">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                    </div>

                    {{-- Requirements --}}
                    <div class="col-12">
                        <label for="requirements" class="form-label">Requirements</label>
                        <textarea name="requirements" id="requirements" class="form-control" rows="3">{{ old('requirements', $job->requirements) }}</textarea>
                    </div>

                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success w-100 mt-4">Update Job</button>
            </form>
        </div>

    </div>
</main>
@endsection
