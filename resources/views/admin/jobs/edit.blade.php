@extends('admin.layouts.main')

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
                <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Job Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Job Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                    </div>

                    {{-- Job Type --}}
                    <div class="mb-3">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select name="job_type" id="job_type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="full-time" {{ old('job_type', $job->job_type) == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="part-time" {{ old('job_type', $job->job_type) == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="internship" {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                            <option value="freelance" {{ old('job_type', $job->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                    </div>

                    {{-- Company Name --}}
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $job->company_name) }}" required>
                    </div>

                    {{-- Company Website --}}
                    <div class="mb-3">
                        <label for="company_website" class="form-label">Company Website</label>
                        <input type="url" name="company_website" id="company_website" class="form-control" value="{{ old('company_website', $job->company_website) }}">
                    </div>

                    {{-- Location --}}
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                    </div>

                    {{-- Salary --}}
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary (Optional)</label>
                        <input type="text" name="salary" id="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
                    </div>

                    {{-- Last Date --}}
                    <div class="mb-3">
                        <label for="last_date" class="form-label">Application Deadline</label>
                        <input type="date" name="last_date" id="last_date" class="form-control" value="{{ old('last_date', \Carbon\Carbon::parse($job->last_date)->format('Y-m-d')) }}" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Job Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    {{-- Responsibilities --}}
                    <div class="mb-3">
                        <label for="responsibilities" class="form-label">Responsibilities</label>
                        <textarea name="responsibilities" id="responsibilities" class="form-control" rows="3">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                    </div>

                    {{-- Requirements --}}
                    <div class="mb-3">
                        <label for="requirements" class="form-label">Requirements</label>
                        <textarea name="requirements" id="requirements" class="form-control" rows="3">{{ old('requirements', $job->requirements) }}</textarea>
                    </div>

                    {{-- Is Active --}}
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $job->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">Active</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-success w-100">Update Job</button>
                </form>
            </div>

        </div>
    </main>

    {{-- Optional jQuery for dynamic subcategory if needed --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#category').change(function () {
            let categoryId = $(this).val();
            $('#subcategory').html('<option>Loading...</option>');

            if (categoryId) {
                $.get('/get-subcategories/' + categoryId, function (data) {
                    let options = '<option value="">Select Subcategory</option>';
                    data.forEach(function (sub) {
                        options += `<option value="${sub.id}">${sub.name}</option>`;
                    });
                    $('#subcategory').html(options);
                });
            } else {
                $('#subcategory').html('<option value="">Select Subcategory</option>');
            }
        });
    </script>

@endsection
