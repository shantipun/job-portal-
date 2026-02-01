@extends('layouts.main')

@push('title')
<title>Salaries Page</title>
@endpush

@section('content')
<div class="py-5">

    <!-- ================= HEADING ================= -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Discover your earning potential</h2>
        <p class="text-muted">Explore salaries and job openings by industry and location.</p>
    </div>

    <!-- ================= SEARCH FORM ================= -->
    <form class="mb-4" method="GET" action="{{ route('find.salaries') }}">
        <div class="row g-2 justify-content-center">
            <div class="col-md-5">
                <label class="form-label fw-semibold">What</label>
                <input type="text" name="title"
                       value="{{ request('title') }}"
                       class="form-control"
                       placeholder="Job title, keyword">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Where</label>
                <input type="text" name="location"
                       value="{{ request('location') }}"
                       class="form-control"
                       placeholder="City, state, or remote">
            </div>

            <div class="col-md-2 d-grid">
                <label>&nbsp;</label>
                <button class="btn btn-primary btn-lg">Search</button>
            </div>
        </div>
    </form>

    <!-- ================= INDUSTRY FILTER ================= -->
    <div class="mb-4" style="max-width: 400px;">
        <h1>Choose an Job Type</h1>
        <form method="GET" action="{{ route('find.salaries') }}">
            
            <select name="industry" class="form-select" onchange="this.form.submit()">
                <option value="">All Job Type</option>
                <option value="full-time" {{ request('industry')=='full-time'?'selected':'' }}>Full-time</option>
                <option value="part-time" {{ request('industry')=='part-time'?'selected':'' }}>Part-time</option>
                <option value="remote" {{ request('industry')=='remote'?'selected':'' }}>Remote</option>
            </select>
        </form>
    </div>

    <!-- ================= JOB CARDS ================= -->
    <div class="row g-4">
        @forelse($jobs as $job)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm hover-shadow">
                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">{{ $job->title }}</h5>

                    <p class="text-success mb-2">
                        <i class="fa-solid fa-coins me-1"></i>
                        Average Salary: <strong>{{ $job->salary }}</strong>
                    </p>

                    <p class="text-muted mb-1">
                        <i class="fa-solid fa-location-dot me-1"></i>{{ $job->location }}
                    </p>

                    <p class="text-muted mb-2">{{ $job->company_name }}</p>

                    <span class="badge bg-info text-dark mb-3">{{ ucfirst($job->job_type) }}</span>

                    <div class="mt-auto">
                        <a href="{{ route('job.detail', $job->id) }}" class="btn btn-outline-primary btn-sm w-100">
                            View Job Openings
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No salary data found.
            </div>
        </div>
        @endforelse
    </div>

    <!-- ================= PAGINATION ================= -->
  

</div>

<!-- ================= STYLES ================= -->
<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
</style>
@endsection
