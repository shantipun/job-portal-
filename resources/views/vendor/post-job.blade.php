@extends('vendor.layouts.main')

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

                    <form action="{{ route('vendor.jobs.store') }}" method="POST">
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
                                     <option value="urgent" {{ old('job_type')=='urgent' ? 'selected' : '' }}>Urgent</option>
                              
                                    <option value="part-time" {{ old('job_type')=='part-time' ? 'selected' : '' }}>Part-Time</option>
                                    <option value="internship" {{ old('job_type')=='internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="freelance" {{ old('job_type')=='freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>

                           
                <div class="col-md-6">
                    <label class="form-label">Company</label>
                    <select name="company_id" id="company_id" class="form-select" required>
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}"
                                data-logo="{{ $company->logo ? asset('storage/'.$company->logo) : '' }}"
                                {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Logo preview -->
                    <div class="mt-2">
                        <img id="companyLogoPreview" src="" alt="Company Logo" style="height:50px; display:none;">
                    </div>
                </div>

                        <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
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
                                <input type="hidden" name="is_active" value="0">
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
$(document).ready(function(){
    // Category card selection
    $('.category-card').click(function(){
        let catId = $(this).data('id');
        $('#category_id').val(catId);
        $('.category-card').removeClass('border-primary');
        $(this).addClass('border-primary');
    });
     // Show company logo when dropdown changes
    $('#company_id').on('change', function() {
        var logoUrl = $(this).find('option:selected').data('logo');
        if(logoUrl){
            $('#companyLogoPreview').attr('src', logoUrl).show();
        } else {
            $('#companyLogoPreview').hide();
        }
    });

    // Trigger change on page load (useful for old values)
    $('#company_id').trigger('change');
});

</script>
@endsection
