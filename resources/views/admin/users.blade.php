@extends('admin.layouts.main')

@push('title')
    <title>Users - Admin</title>
@endpush

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <div class="row my-4">
                <div class="col-xl-12 col-md-12">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0">Users</h4>
                        <div class="ms-auto">
                            <a href="{{ route('admin.users.index') }}"
                               class="btn btn-dark btn-sm text-decoration-none">
                                View All
                            </a>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="card mt-3 shadow-sm">
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="datatablesSimple">
                                <thead class="table-light">
                                    <tr>
                                        <th>S.N</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th width="120">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->location ?? '-' }}</td>
                                            <td>
                                                @if ($user->status)
                                                    <span class="badge rounded-pill text-bg-success">
                                                        Unblock
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill text-bg-danger">
                                                        Block
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->status)
                                                    <a href="{{ route('admin.users.block', $user->id) }}"
                                                       class="btn btn-danger btn-sm"
                                                       title="Block User">
                                                        <i class="fa-solid fa-ban"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.users.unblock', $user->id) }}"
                                                       class="btn btn-success btn-sm"
                                                       title="Unblock User">
                                                        <i class="fa-solid fa-unlock"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                No users found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


@endsection
