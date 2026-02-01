@extends('layouts.main')

@push('title')
<title>Jobs | JobNest</title>
@endpush

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-3">Available Jobs</h3>

    @foreach($jobs as $job)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $job->title }}</h5>
                <p class="mb-1">{{ $job->company }} — {{ $job->location }}</p>
                <a href="{{ route('job.detail', $job->id) }}" class="btn btn-sm btn-primary">
                    View Job
                </a>
            </div>
        </div>
    @endforeach

    {{ $jobs->links() }}
</div>
@endsection
