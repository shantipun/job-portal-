@extends('vendor.layouts.main')

@push('title')
<title>Job Applications - Vendor</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">
            <h2 class="mb-4">Job Applications</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @forelse($jobs as $job)
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $job->title }}</h5>
                        <span class="badge bg-light text-dark">{{ $job->applications->count() }} Applications</span>
                    </div>
                    <div class="card-body p-0">
                        @if($job->applications->count() > 0)
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-hover table-bordered mb-0 align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Applicant Name</th>
                                            <th>Email</th>
                                            <th>Cover Letter</th>
                                            <th>Resume</th>
                                            <th>Status</th>
                                            <th>Applied At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($job->applications as $app)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $app->user->name }}</td>
                                                <td>{{ $app->user->email }}</td>
                                                   {{-- Cover Letter --}}
                                                <td>
                                                    @if($app->cover_letter)
                                                        <a href="{{ asset('storage/'.$app->cover_letter) }}" target="_blank" class="btn btn-sm btn-info">
                                                            View
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                                                            <td>
                                                    @if($app->resume)
                                                        <a href="{{ asset('storage/'.$app->resume) }}" target="_blank" class="btn btn-sm btn-info">
                                                            View
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                            @if($app->status == 'pending')
                                                <form action="{{ route('vendor.application.update', $app->id) }}" method="POST" class="d-flex gap-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button class="btn btn-success btn-sm" type="submit">Accept</button>
                                                </form>

                                                <form action="{{ route('vendor.application.update', $app->id) }}" method="POST" class="d-flex gap-1 mt-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                                </form>
                                            @else
                                                <span class="badge {{ $statusClasses[$app->status] ?? 'bg-secondary' }}">
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @endif
                                        </td>
                                              <td>{{ \Carbon\Carbon::parse($app->created_at)->format('d-m-Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-3 text-center text-muted fst-italic">
                                No applications yet for this job.
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    You have not posted any jobs yet.
                </div>
            @endforelse
        </div>
    </main>


{{-- Datatables JS --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tables = document.querySelectorAll("#datatablesSimple");
    tables.forEach((table) => {
        new simpleDatatables.DataTable(table, {
            searchable: true,
            fixedHeight: true,
            perPage: 10,
        });
    });
});
</script>
@endsection
