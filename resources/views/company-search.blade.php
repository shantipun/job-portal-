@extends('layouts.main')

@push('title')
<title>Find Companies | Job Portal</title>
@endpush

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-2">Find great places to work</h2>
    <p class="mb-4">Search companies, read reviews, and explore jobs</p>

    <!-- Search Form -->
    <form method="GET" action="{{ route('company.search.results') }}" class="mb-5">
        <div class="row g-2">
            <div class="col-md-9">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Company name or job title">
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">Find Companies</button>
            </div>
        </div>
    </form>

<!-- Browse Companies by Industry -->
<h5 class="mb-3">Browse companies by industry</h5>
<div class="row g-4 mb-5">
    @foreach($categories as $category)
        <div class="col-md-3">
            <div class="card text-center shadow-sm hover-shadow h-100">
                @if($category->icon)
                    <div class="p-3">
                        <i class="{{ $category->icon }} fs-1 text-primary"></i>
                    </div>
                @else
                    <div class="p-3">
                        <i class="bi bi-briefcase fs-1 text-primary"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h6 class="card-title mb-0">{{ $category->name }}</h6>
                    <a href="{{ route('company.search.results', ['category' => $category->id]) }}" 
                       class="stretched-link"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>


    <!-- Companies List -->
    <h5 class="mb-3">Popular Companies</h5>
    <div class="row g-4 mb-5">
        @forelse($popularCompanies as $company)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 hover-shadow">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" 
                                     alt="{{ $company->name }}"
                                     class="rounded-circle me-3" style="width:50px;height:50px;">
                            @endif
                            <h5 class="card-title mb-0">
                                {{ $company->name }}
                                @if($company->is_featured ?? false)
                                    <span class="badge bg-warning text-dark ms-1">Featured</span>
                                @endif
                                @if($company->created_at && $company->created_at->diffInDays(now()) <= 30)
                                    <span class="badge bg-success ms-1">New</span>
                                @endif
                            </h5>
                        </div>

                        <!-- Ratings & Reviews -->
                        <p class="card-text mb-2">
                            <span class="text-warning">
                                @for($i = 0; $i < ($company->rating ?? 4); $i++) ★ @endfor
                                @for($i = ($company->rating ?? 4); $i < 5; $i++) ☆ @endfor
                            </span>
                            <small class="text-muted ms-2">{{ $company->reviews_count ?? 10 }} reviews</small>
                        </p>

                        <!-- Location -->
                        <p class="card-text mb-3">
                            <span class="ms-2 text-muted">{{ $company->location ?? 'Nepal' }}</span>
                        </p>

                        <!-- Job Stats -->
                        <p class="card-text mb-3">
                            Jobs posted: <strong>{{ $company->jobs_count }}</strong>
                        </p>

                        <!-- Tags -->
                        <div class="mb-3">
                            @foreach($company->tags ?? ['Full-time','Remote'] as $tag)
                                <span class="badge bg-secondary me-1">{{ $tag }}</span>
                            @endforeach
                        </div>

                        <!-- View Jobs & Follow -->
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('company.jobs', $company->id) }}" 
                               class="btn btn-outline-primary btn-sm">View Jobs</a>
                            <button class="btn btn-outline-success btn-sm">Follow</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No companies found for this filter.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($popularCompanies->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $popularCompanies->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
</style>
@endsection
