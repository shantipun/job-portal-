@extends('admin.layouts.main')

@push('title')
    <title>Admin Dashboard</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">
            <h1 class="mb-4">Welcome, {{ Auth::user()->name }}</h1>

            <div class="row mb-4">
                {{-- Total Users --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body text-center mt-3">
                            <h5 class="text-dark">Total Users</h5>
                            <h2 class="text-dark">{{ $totalUsers ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                {{-- Total Vendors --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body text-center mt-3">
                            <h5 class="text-dark">Total Vendors</h5>
                            <h2 class="text-dark">{{ $totalVendors ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                {{-- Total Jobs --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body text-center mt-3">
                            <h5 class="text-dark">Total Jobs</h5>
                            <h2 class="text-dark">{{ $totalJobs ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>

       
        </div>
    </main>

@endsection
