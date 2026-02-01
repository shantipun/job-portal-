@extends('admin.layouts.main')

@push('title')
<title>Blogs | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Blogs</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add Blog Button --}}
            <div class="mb-3">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-1"></i> Add New Blog
                </a>
            </div>

            {{-- Blogs Table --}}
            <div class="card shadow-sm mb-5">
                <div class="card-body">

                    @if($blogs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Published At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->slug }}</td>
                                            <td>
                                                @if($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" width="80" class="rounded">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                
                                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this blog?');">
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

                        

                    @else
                        <p class="text-muted mb-0">No blogs found. <a href="{{ route('admin.blogs.create') }}">Add a new blog</a>.</p>
                    @endif

                </div>
            </div>

        </div>
    </main>

@endsection
