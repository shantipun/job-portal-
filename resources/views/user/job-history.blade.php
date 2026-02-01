@extends('user.layouts.main')

@push('title')
<title>My Job Applications</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 py-4">
            <h1 class="mb-4">My Job Applications</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-briefcase me-1"></i>
                    Applications History
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Applied At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $app)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('job.detail', $app->job->id) }}" class="text-decoration-none">
                                                {{ $app->job->title }}
                                            </a>
                                        </td>
                                        <td>{{ $app->job->company_name }}</td>
                                        <td>{{ $app->job->location }}</td>
                                       <td>
                                        @if($app->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($app->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($app->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>

                                        <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d-m-Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">You haven't applied to any jobs yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
