@extends('user.layouts.main')

@push('title')
<title>Dashboard - User</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Dashboard</h1>

            {{-- Top Stats --}}
            <div class="row g-4 mb-4">

                <div class="col-xl-6 col-md-6">
                    <div class="card bg-primary text-white text-center">
                        <div class="card-body">
                            <h6>Applied Jobs</h6>
                            <h2>{{ $appliedCount }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6">
                    <div class="card bg-success text-white text-center">
                        <div class="card-body">
                            <h6>Saved Jobs</h6>
                            <h2>{{ $savedCount }}</h2>
                        </div>
                    </div>
                </div>


            </div>

            {{-- User Info --}}
            <div class="row g-4 mb-4">

                <div class="col-xl-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img
                                src="{{ $user->image ? asset('storage/'.$user->image) : asset('dashboard/assets/img/review/user.png') }}"
                                class="rounded-circle mb-3"
                                style="width:140px; height:140px; object-fit:cover;"
                            >
                            <h5>{{ $user->name }}</h5>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>User Details</h5>
                            <hr>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Recent Applications --}}
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    My Recent Applications
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Applied At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $app)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $app->job->title }}</td>
                                    <td>{{ $app->job->company_name }}</td>
                                    <td>
                                        <span class="badge
                                            @if($app->status == 'pending') bg-warning text-dark
                                            @elseif($app->status == 'accepted') bg-success
                                            @elseif($app->status == 'rejected') bg-danger
                                            @else bg-secondary
                                            @endif
                                        ">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $app->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('job.detail', $app->job->id) }}"
                                           class="btn btn-sm btn-primary">
                                            View Job
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="text-center text-muted fst-italic">
                                        No applications found.
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
