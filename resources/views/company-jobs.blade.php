@extends('layouts.main')

@push('title')
<title>{{ $company->name }} - Jobs | Job Portal</title>
@endpush

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-3">{{ $company->name }} - Job Openings</h2>
    <p class="text-muted mb-4">{{ $company->location ?? 'Nepal' }}</p>

    @if($company->jobs->count() > 0)
        <div class="row g-4">
            @foreach($company->jobs as $job)
                <div class="col-md-6">
                    <div class="card shadow-sm h-100 hover-shadow">
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">{{ $job->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                Location: {{ $job->location ?? 'Not specified' }} <br>
                                Salary: {{ $job->salary ?? 'Negotiable' }}
                            </p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('job.detail', $job->id) }}" 
                                   class="btn btn-outline-primary btn-sm">View Job</a>
                                <button class="btn btn-outline-success btn-sm">Follow</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No jobs posted for this company yet.</p>
    @endif

</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>
@endsection
