@extends('admin.layouts.main')

@push('title')
<title>Companies | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center my-4">
                <h2 class="fw-bold">Companies</h2>
                <a href="{{ route('companies.create') }}" class="btn btn-primary">
                    + Add Company
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Companies Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Company Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th> <!-- New column -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($companies as $company)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- Logo -->
                                    <td>
                                        @if($company->logo)
                                            <img src="{{ asset('storage/'.$company->logo) }}" 
                                                 alt="{{ $company->name }}" width="50" height="50" 
                                                 class="rounded">
                                        @else
                                            <span class="text-muted">No Logo</span>
                                        @endif
                                    </td>

                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->category->name }}</td>
                                    <td>{{ $company->location ?? '-' }}</td>
                                    <td>
                                        @if($company->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <a href="{{ route('companies.edit', $company->id) }}" 
                                           class="btn btn-sm btn-warning mb-1">
                                           Edit
                                        </a>

                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        No companies found
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
