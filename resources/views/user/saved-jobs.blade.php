@extends('user.layouts.main')

@push('title')
<title>Saved Jobs - User</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Saved Jobs</h1>

            {{-- Saved Jobs Table --}}
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="fas fa-heart me-1"></i>
                    My Saved Jobs
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Saved At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($savedJobs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->job->title }}</td>
                                    <td>{{ $item->job->company_name }}</td>
                                    <td>{{ $item->job->location ?? 'N/A' }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('job.detail', $item->job->id) }}"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>

                                        <form action="{{ route('job.unsave', $item->job->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center text-muted fst-italic">
                                        You have no saved jobs.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

@endsection
