@extends('layouts.main')

@push('title')
<title>{{ $job->title }}</title>
@endpush

@section('content')
@php
    $isExpired = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($job->last_date));
@endphp
<div class="container py-5">
    <div class="row g-4">

        <!-- Left Column: Job Details -->
        <div class="col-lg-7">
            <h2>{{ $job->title }}</h2>
            <p class="text-muted">
                {{ $job->company_name }} • {{ $job->location }}
            </p>

            <span class="badge bg-info text-dark">
                {{ ucfirst($job->job_type) }}
            </span>
            
{{-- Application Deadline --}}
<h5 class="mt-3">Application Deadline</h5>
<p class="fw-bold {{ $isExpired ? 'text-danger' : 'text-success' }}">
    {{ \Carbon\Carbon::parse($job->last_date)->format('F d, Y') }}
    @if($isExpired)
        (Expired)
    @else
        (Open)
    @endif
</p>

            <hr>

            <h5>Salary</h5>
            <p class="text-success fw-bold">
                {{ $job->salary ?? 'Negotiable' }}
            </p>

            <h5>Description</h5>
            <p>{{ $job->description }}</p>

            <h5>Requirements</h5>
                @if($job->requirements)
                    <ol>
                        @foreach(explode("\n", $job->requirements) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                @endif

                <h5>Responsibilities</h5>
                @if($job->responsibilities)
                    <ol>
                        @foreach(explode("\n", $job->responsibilities) as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                @endif

        </div>

        <!-- Right Column: Apply Section -->
        <div class="col-lg-5">
    <div class="card shadow-sm p-4 sticky-top" style="top: 20px;">
        <h5 class="mb-3">Apply for this job</h5>

      

        <div class="mt-3">

            {{-- JOB EXPIRED --}}
            @if($isExpired)
                <button class="btn btn-danger w-100" disabled>
                    Application Closed
                </button>

            @else
                @auth

                    {{-- USER --}}
                    @if(auth()->user()->role === 'user')
                        <form action="{{ route('job.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Cover Letter Upload --}}
                            <div class="mb-2">
                                <label>Cover Letter (.pdf, .doc, .docx)</label>
                                <input type="file" name="cover_letter" accept=".pdf,.doc,.docx" class="form-control" required>
                            </div>
                            <div class="mb-2">
                                <label>Resume (PDF)</label>
                                <input type="file"
                                       name="resume"
                                       accept="application/pdf"
                                       class="form-control"
                                       required>
                            </div>

                            <button class="btn btn-primary w-100">
                                Apply Now
                            </button>
                        </form>

                    {{-- ADMIN --}}
                    @elseif(auth()->user()->role === 'admin')
                        <button class="btn btn-secondary w-100" disabled>
                            Admin cannot apply for jobs
                        </button>

                    {{-- VENDOR / OTHER --}}
                    @else
                        <button class="btn btn-secondary w-100" disabled>
                            Only users can apply
                        </button>
                    @endif

                @else
                    {{-- GUEST --}}
                    <form action="{{ route('login') }}" method="GET">
                        <input type="hidden" name="redirect" value="{{ route('job.detail', $job->id) }}">
                        <button class="btn btn-primary w-100" type="submit">
                            Login to Apply
                        </button>
                    </form>
                @endauth
            @endif

        </div>
    </div>
</div>


    </div>

    <!-- Related Jobs -->
    <hr class="my-5">
    <h5>Other jobs at {{ $job->company_name }}</h5>

    <div class="row g-3 mt-2">
        @foreach($relatedJobs as $related)
            @if($related->id != $job->id)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm p-3">
                        <h6 class="fw-bold">{{ $related->title }}</h6>
                        <p class="text-muted mb-1">{{ $related->location }}</p>

                        <span class="badge bg-info text-dark">
                            {{ ucfirst($related->job_type) }}
                        </span>

                        <p class="text-success mt-2">
                            {{ $related->salary ?? 'Negotiable' }}
                        </p>

                        <a href="{{ route('job.detail', $related->id) }}"
                           class="btn btn-outline-primary btn-sm">
                            View Job
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
