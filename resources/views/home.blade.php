@extends('layouts.main')

@push('title')
<title>Home page</title>
@endpush

@section('content')

<!-- ================= HERO SECTION ================= -->
<section class="hero-section text-center py-5" style="background: linear-gradient(90deg, #e3f2fd, #ffffff);">
    <div class="container">
        <h1 class="display-3 fw-bold text-primary">JobNest</h1>
        <h4 class="fw-bold mt-3">Your next job starts here</h4>
        <p class="text-muted mt-2">
            Create an account or sign in to see your personalized job recommendations.
        </p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3 px-5">
            Get Started <i class="fa-solid fa-arrow-right ms-2"></i>
        </a>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="fw-semibold text-primary">Post your resume</a>
            <span class="text-muted"> – It only takes a few seconds</span>
        </div>

        <!-- ================= SEARCH BAR INSIDE HERO ================= -->
        <form method="GET" action="{{ route('home') }}" class="search-box mx-auto mt-4 p-3 shadow rounded bg-white" style="max-width: 900px;">
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fa-solid fa-magnifying-glass text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0" 
                               placeholder="Job title, keywords, or company" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fa-solid fa-location-dot text-muted"></i>
                        </span>
                        <input type="text" name="location" class="form-control border-0" 
                               placeholder='Location' value="{{ request('location') }}">
                    </div>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary btn-lg">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ================= JOB LISTINGS ================= -->
<section class="job-listings py-5 bg-light">
    <div class="container">
        <h5 class="fw-bold mb-4">Recommended Jobs</h5>
        <div class="row g-4">
            @forelse($jobs as $job)
                <div class="col-md-6">
                    <div class="card job-card shadow-sm h-100 p-3 hover-card">
                        <div class="d-flex justify-content-between align-items-start">
                            
                            <div class="d-flex gap-3">
                                {{-- Company Logo --}}
                                <div>
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ asset('storage/'.$job->company->logo) }}" 
                                             alt="{{ $job->company->name }}" 
                                             width="60" height="60" class="rounded">
                                    @else
                                        <div class="bg-secondary rounded text-white text-center" 
                                             style="width:60px; height:60px; line-height:60px;">
                                            N/A
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <a href="{{ route('job.detail', $job->id) }}" 
                                       class="h5 job-title text-decoration-none text-primary">
                                        {{ $job->title }}
                                    </a>
                                    <div class="company text-muted">{{ $job->company_name }}</div>
                                    <div class="location text-muted">{{ $job->location }}</div>

                                    <div class="job-tags mt-2 mb-2">
                                        <span class="badge bg-info text-dark">{{ ucfirst($job->job_type) }}</span>
                                        @if($job->salary)
                                            <span class="badge bg-warning text-dark">Rs. {{ $job->salary }}</span>
                                        @endif
                                    </div>

                                    <p class="job-desc text-muted">
                                        {{ Str::limit($job->description, 100) }}
                                    </p>

                                    <small class="text-muted">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('jobs.save', $job->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-light save-btn shadow-sm">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No jobs available at the moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>


        <!-- ================= PAGINATION ================= -->
        @if($jobs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</section>
<section class="job-listings py-5 bg-light">
    <div class="container">
        <h5 class="fw-bold mb-4 text-danger">🔥 Hot Jobs</h5>

        <div class="row g-4">
            @forelse($hotJobs as $job)
                <div class="col-md-6">
                    <div class="card job-card shadow-sm h-100 p-3 hover-card border-danger">
                        <div class="d-flex justify-content-between align-items-start">

                            <div class="d-flex gap-3">
                                {{-- Company Logo --}}
                                <div>
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ asset('storage/'.$job->company->logo) }}"
                                             alt="{{ $job->company->name }}"
                                             width="60" height="60" class="rounded">
                                    @else
                                        <div class="bg-secondary rounded text-white text-center"
                                             style="width:60px;height:60px;line-height:60px;">
                                            N/A
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <a href="{{ route('job.detail', $job->id) }}"
                                       class="h5 job-title text-decoration-none text-danger">
                                        {{ $job->title }}
                                    </a>

                                    <div class="company text-muted">{{ $job->company_name }}</div>
                                    <div class="location text-muted">{{ $job->location }}</div>

                                    <div class="job-tags mt-2 mb-2">
                                        <span class="badge bg-danger">Urgent</span>
                                        @if($job->salary)
                                            <span class="badge bg-warning text-dark">Rs. {{ $job->salary }}</span>
                                        @endif
                                    </div>

                                    <p class="job-desc text-muted">
                                        {{ Str::limit($job->description, 100) }}
                                    </p>

                                    <small class="text-muted">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('jobs.save', $job->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-light save-btn shadow-sm">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No hot jobs available.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
<section class="job-listings py-5">
    <div class="container">
        <h5 class="fw-bold mb-4 text-primary">⭐ Top Jobs</h5>

        <div class="row g-4">
            @forelse($topJobs as $job)
                <div class="col-md-6">
                    <div class="card job-card shadow-sm h-100 p-3 hover-card border-primary">
                        <div class="d-flex justify-content-between align-items-start">

                            <div class="d-flex gap-3">
                                {{-- Company Logo --}}
                                <div>
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ asset('storage/'.$job->company->logo) }}"
                                             alt="{{ $job->company->name }}"
                                             width="60" height="60" class="rounded">
                                    @else
                                        <div class="bg-secondary rounded text-white text-center"
                                             style="width:60px;height:60px;line-height:60px;">
                                            N/A
                                        </div>
                                    @endif
                                </div>

                                <div>
                                    <a href="{{ route('job.detail', $job->id) }}"
                                       class="h5 job-title text-decoration-none text-primary">
                                        {{ $job->title }}
                                    </a>

                                    <div class="company text-muted">{{ $job->company_name }}</div>
                                    <div class="location text-muted">{{ $job->location }}</div>

                                    <div class="job-tags mt-2 mb-2">
                                        <span class="badge bg-primary">Full Time</span>
                                        @if($job->salary)
                                            <span class="badge bg-warning text-dark">Rs. {{ $job->salary }}</span>
                                        @endif
                                    </div>

                                    <p class="job-desc text-muted">
                                        {{ Str::limit($job->description, 100) }}
                                    </p>

                                    <small class="text-muted">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('jobs.save', $job->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-light save-btn shadow-sm">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No top jobs available.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>




<!-- ================= WHY CHOOSE JobNest ================= -->
<section class="why-choose py-5">
    <div class="container text-center">
        <h5 class="fw-bold mb-4">Why Choose JobNest?</h5>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-card p-4 shadow-sm rounded hover-card">
                    <i class="fa-solid fa-bolt fa-2x text-primary mb-3 animate-icon"></i>
                    <h6>Quick Apply</h6>
                    <p class="text-muted">Apply to jobs in just a few clicks.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card p-4 shadow-sm rounded hover-card">
                    <i class="fa-solid fa-user-check fa-2x text-primary mb-3 animate-icon"></i>
                    <h6>Verified Companies</h6>
                    <p class="text-muted">Work with trusted employers.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card p-4 shadow-sm rounded hover-card">
                    <i class="fa-solid fa-briefcase fa-2x text-primary mb-3 animate-icon"></i>
                    <h6>Personalized Jobs</h6>
                    <p class="text-muted">Get job recommendations based on your profile.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card p-4 shadow-sm rounded hover-card">
                    <i class="fa-solid fa-file-lines fa-2x text-primary mb-3 animate-icon"></i>
                    <h6>Free Resume Posting</h6>
                    <p class="text-muted">Create and share your resume with top employers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section class="testimonials py-5 bg-light">
    <div class="container text-center">
        <h5 class="fw-bold mb-4">What Our Users Say</h5>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100 testimonial-card">
                    <p class="text-muted">"JobNest helped me land my dream job in just 2 weeks!"</p>
                    <div class="fw-bold mt-2">Ramesh K.</div>
                    <small class="text-muted">Software Engineer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100 testimonial-card">
                    <p class="text-muted">"The platform is easy to use and the job recommendations are spot on."</p>
                    <div class="fw-bold mt-2">Sita P.</div>
                    <small class="text-muted">UI/UX Designer</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4 h-100 testimonial-card">
                    <p class="text-muted">"I love the quick apply feature! It saved me so much time."</p>
                    <div class="fw-bold mt-2">Mina S.</div>
                    <small class="text-muted">Marketing Specialist</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TESTIMONIALS HOVER CSS ================= -->
<style>
.testimonial-card {
    transition: all 0.3s ease;
    cursor: pointer;
}
.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}
</style>

<!-- ================= BLOG / LATEST JOBS ================= -->
<section class="latest-jobs py-5">
    <div class="container">
        <h5 class="fw-bold mb-4 text-center">Latest Jobs & Blog</h5>
        <div class="row g-4">
            @foreach($blogs as $blog)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 hover-card">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}" class="img-fluid mb-4 rounded" alt="{{ $blog->title }}">
                        @endif

                        <div class="card-body">
                            <h6 class="card-title">{{ $blog->title }}</h6>
                            <p class="card-text text-muted">{{ $blog->excerpt }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" 
                               class="text-primary fw-semibold">
                               Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



@endsection

<!-- ================= OPTIONAL CSS ================= -->
@push('styles')
<style>
    .hover-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease-in-out;
    }
    .animate-icon {
        transition: transform 0.5s;
    }
    .feature-card:hover .animate-icon {
        transform: rotate(15deg) scale(1.2);
    }
</style>
@endpush
