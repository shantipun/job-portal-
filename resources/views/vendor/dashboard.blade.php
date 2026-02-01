@extends('vendor.layouts.main')

@push('title')
<title>Dashboard - Vendor</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Dashboard</h1>

            {{-- ===== STATS CARDS ===== --}}
            <div class="row">
                {{-- Total Jobs --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-dark">Total Jobs Posted</h5>
                            <h2 class="text-dark">{{ $totalJobs ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                {{-- Applications Received --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-dark">Applications Received</h5>
                            <h2 class="text-dark">{{ $totalApplications ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                {{-- Pending Applications --}}
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body text-center">
                            <h5 class="text-dark">Pending Applications</h5>
                            <h2 class="text-dark">{{ $pendingApplications ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>

          

        </div>
    </main>

@endsection
