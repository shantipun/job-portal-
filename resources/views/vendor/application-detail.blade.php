@extends('vendor.layouts.main')

@push('title')
<title>Vendor Order Detail</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
     <main>
        <div class="container-fluid px-4 mt-4">
            <h2 class="mb-4">Application Detail</h2>

            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $application->job->title }}</h5>
                </div>
                <div class="card-body">
                    <h6>Applicant Information</h6>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Name:</strong> {{ $application->user->name }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $application->user->email }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $application->user->phone ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Applied At:</strong> {{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y H:i') }}</li>
                    </ul>

                    <h6>Application Details</h6>
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Cover Letter:</strong> <p>{{ $application->cover_letter }}</p></li>
                        <li class="list-group-item">
                            <strong>Resume:</strong> 
                            @if($application->resume)
                                <a href="{{ asset('storage/'.$application->resume) }}" target="_blank" class="btn btn-sm btn-info">View Resume</a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong> 
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'accepted' => 'bg-success',
                                    'rejected' => 'bg-danger'
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$application->status] ?? 'bg-secondary' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </li>
                    </ul>

                    <a href="{{ url('vendor/applications') }}" class="btn btn-secondary">Back to Applications</a>
                </div>
            </div>
        </div>
    </main>

@endsection
