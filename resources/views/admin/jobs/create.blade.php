@extends('admin.layouts.main')

@push('title')
<title>Add Job Post</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Post a New Job</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">

                    <form action="{{ route('admin.jobs.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            {{-- Job Title --}}
                            <div class="col-md-6">
                                <label for="title" class="form-label">Job Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            {{-- Job Type --}}
                            <div class="col-md-6">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select name="job_type" id="job_type" class="form-select" required>
                                    <option value="">Select Type</option>
                                    <option value="full-time" {{ old('job_type')=='full-time' ? 'selected' : '' }}>Full-Time</option>
                                    <option value="part-time" {{ old('job_type')=='part-time' ? 'selected' : '' }}>Part-Time</option>
                                    <option value="internship" {{ old('job_type')=='internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="freelance" {{ old('job_type')=='freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>

                            {{-- Company Name --}}
                            <div class="col-md-6">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', Auth::guard('vendor')->user()->company_name ?? '') }}" required>
                            </div>

                            {{-- Company Website --}}
                            <div class="col-md-6">
                                <label for="company_website" class="form-label">Company Website</label>
                                <input type="url" name="company_website" id="company_website" class="form-control" value="{{ old('company_website') }}">
                            </div>

                            {{-- Location --}}
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                            </div>

                            {{-- Salary --}}
                            <div class="col-md-6">
                                <label for="salary" class="form-label">Salary (Optional)</label>
                                <input type="text" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
                            </div>

                            {{-- Last Date --}}
                            <div class="col-md-6">
                                <label for="last_date" class="form-label">Application Deadline</label>
                                <input type="date" name="last_date" id="last_date" class="form-control" value="{{ old('last_date') }}" required>
                            </div>

                            {{-- Is Active --}}
                          <div class="mb-3 form-check">
                            <input type="hidden" name="is_active" value="0"> <!-- ensures false if unchecked -->
                            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label for="is_active" class="form-check-label">Active</label>
                        </div>

                            {{-- Job Description --}}
                            <div class="col-12">
                                <label for="description" class="form-label">Job Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                            </div>

                            {{-- Responsibilities --}}
                            <div class="col-12">
                                <label for="responsibilities" class="form-label">Responsibilities</label>
                                <textarea name="responsibilities" id="responsibilities" class="form-control" rows="3">{{ old('responsibilities') }}</textarea>
                            </div>

                            {{-- Requirements --}}
                            <div class="col-12">
                                <label for="requirements" class="form-label">Requirements</label>
                                <textarea name="requirements" id="requirements" class="form-control" rows="3">{{ old('requirements') }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 w-100">Post Job</button>
                    </form>

                </div>
            </div>
        </div>
    
    </main>


{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Fetch subcategories dynamically
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
