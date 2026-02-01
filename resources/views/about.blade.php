@extends('layouts.main')

@push('title')
<title>About Us | JobNest</title>
@endpush

@section('content')

{{-- Hero Section --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">About JobNest</h1>
        <p class="text-muted fs-5">
            Connecting talent with opportunity — smarter, faster, better.
        </p>
    </div>
</section>

{{-- Who We Are --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h3 class="fw-bold mb-3">Who We Are</h3>
                <p class="text-muted">
                    JobNest is a modern job portal designed to bridge the gap
                    between job seekers and trusted employers. We aim to
                    simplify job searching by providing verified job listings,
                    user-friendly tools, and a secure hiring environment.
                </p>
                <p class="text-muted">
                    Whether you're a fresh graduate or an experienced professional,
                    JobNest helps you find opportunities that match your skills.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/companies/2.jpg') }}" 
                    class="img-fluid rounded shadow" 
                    alt="About JobNest">
            </div>
        </div>

        {{-- Mission Vision --}}
        <div class="row text-center g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <i class="fa-solid fa-bullseye fa-2x text-primary mb-3"></i>
                        <h5 class="fw-semibold">Our Mission</h5>
                        <p class="text-muted">
                            To make job searching transparent, reliable,
                            and accessible to everyone.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <i class="fa-solid fa-eye fa-2x text-primary mb-3"></i>
                        <h5 class="fw-semibold">Our Vision</h5>
                        <p class="text-muted">
                            To become Nepal’s most trusted job portal for
                            both job seekers and employers.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 p-3">
                    <div class="card-body">
                        <i class="fa-solid fa-star fa-2x text-primary mb-3"></i>
                        <h5 class="fw-semibold">Why JobNest?</h5>
                        <p class="text-muted">
                            Verified jobs, easy applications,
                            and a smooth user experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Our Values --}}
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-4">Our Values</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded shadow-sm">
                        <i class="fa-solid fa-handshake fa-2x text-primary mb-2"></i>
                        <h6>Trust</h6>
                        <p class="text-muted">Building a reliable connection between job seekers and employers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded shadow-sm">
                        <i class="fa-solid fa-lightbulb fa-2x text-primary mb-2"></i>
                        <h6>Innovation</h6>
                        <p class="text-muted">Using smart technology to make job searching easy and efficient.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded shadow-sm">
                        <i class="fa-solid fa-award fa-2x text-primary mb-2"></i>
                        <h6>Excellence</h6>
                        <p class="text-muted">Providing high-quality experience for all users and employers.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- How It Works --}}
        <div class="mb-5">
            <h3 class="fw-bold text-center mb-4">How It Works</h3>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <i class="fa-solid fa-user-plus fa-2x text-primary mb-2"></i>
                    <h6>Register</h6>
                    <p class="text-muted">Create your account quickly as a job seeker or employer.</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fa-solid fa-briefcase fa-2x text-primary mb-2"></i>
                    <h6>Browse Jobs</h6>
                    <p class="text-muted">Search and filter job listings based on your skills.</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fa-solid fa-paper-plane fa-2x text-primary mb-2"></i>
                    <h6>Apply</h6>
                    <p class="text-muted">Send your application directly to verified employers.</p>
                </div>
                <div class="col-md-3 text-center">
                    <i class="fa-solid fa-handshake-angle fa-2x text-primary mb-2"></i>
                    <h6>Get Hired</h6>
                    <p class="text-muted">Connect with employers and land your dream job.</p>
                </div>
            </div>
        </div>


    </div>
</section>

@endsection
