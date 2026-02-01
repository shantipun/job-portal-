@extends('admin.layouts.main')

@push('title')
    <title>Jobs - Admin</title>
@endpush

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <div class="row my-4">
                <div class="col-xl-12 col-md-12">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0">All Jobs</h4>
                        <div class="ms-auto">
                            <a href="{{ route('admin.jobs.create') }}"
                               class="btn btn-primary btn-sm text-decoration-none">
                                + Add Job
                            </a>
                        </div>
                    </div>

                    <!-- Jobs Table -->
                    <div class="card mt-3 shadow-sm">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover" id="datatablesSimple">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Posted</th>
                                        <th width="180">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jobs as $index => $job)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->company_name }}</td>
                                            <td>{{ $job->location }}</td>
                                            <td>{{ ucfirst($job->job_type) }}</td>
                                            <td>
                                                @if($job->is_active)
                                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                                @else
                                                    <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $job->created_at->format('d M Y') }}</td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                                   class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('admin.jobs.toggle-status', $job->id) }}"
                                                   class="btn btn-secondary btn-sm">
                                                    {{ $job->is_active ? 'Deactivate' : 'Activate' }}
                                                </a>
                                                <form action="{{ route('admin.jobs.destroy', $job->id) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Delete this job?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                No jobs found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $jobs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


@endsection
