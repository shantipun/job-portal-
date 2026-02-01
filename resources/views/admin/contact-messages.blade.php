@extends('admin.layouts.main')

@push('title')
<title>Contact Messages | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 py-4">

            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Contact Messages</h2>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Contact Messages Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th> <!-- Optional -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $msg)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $msg->name }}</td>
                                    <td>{{ $msg->email }}</td>
                                    <td>{{ $msg->subject }}</td>
                                    <td>{{ Str::limit($msg->message, 50) }}</td> <!-- Truncate long messages -->
                                    <td>{{ $msg->created_at->format('d M Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.contact.messages.delete', $msg->id) }}" 
                                              method="POST" 
                                              class="d-inline-block" 
                                              onsubmit="return confirm('Are you sure you want to delete this message?');">
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
                                        No contact messages found
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
