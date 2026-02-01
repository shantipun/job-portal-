@extends('admin.layouts.main')

@push('title')
<title>Job Categories | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Job Categories</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Categories Table --}}
            <div class="card shadow-sm mb-5">
                <div class="card-body">

                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Icon</th>
                                        <th>Image</th>
                                        <th>Jobs Count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>

                                            {{-- Icon --}}
                                            <td>
                                                @if($category->icon)
                                                    <i class="{{ $category->icon }}"></i> {{ $category->icon }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            {{-- Image --}}
                                            <td>
                                                @if($category->image)
                                                    <img src="{{ asset('storage/'.$category->image) }}" 
                                                         alt="{{ $category->name }}" width="50" height="50" class="rounded">
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>

                                            <td>{{ $category->jobs_count ?? 0 }}</td>

                                            <td>
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                                
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline-block" 
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>

                    @else
                        <p class="text-muted mb-0">No categories found. <a href="{{ route('admin.categories.create') }}">Add a new category</a>.</p>
                    @endif

                </div>
            </div>

        </div>
    </main>

@endsection
