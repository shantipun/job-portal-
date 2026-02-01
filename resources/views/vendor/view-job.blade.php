@extends('vendor.layouts.main')

@push('title')
<title>Dashboard - Vendor</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="row my-5">
                <div class="col-xl-12 col-md-12">
                   

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Your Posted Jobs</h2>
        <a href="{{ url('vendor/post-job') }}" class="btn btn-primary shadow-sm">Post New Job</a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Last Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                        <tr class="align-middle">
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->location }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ ucfirst($job->job_type) }}</span>
                            </td>
                            <td>{{ $job->salary ?? 'N/A' }}</td>
                            <td>
                                @if($job->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($job->last_date)->format('d M, Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('vendor.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('vendor.jobs.destroy', $job->id) }}" method="POST" class="d-inline-block mb-1" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">You haven’t posted any jobs yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



        </div>
    </main>

@endsection
