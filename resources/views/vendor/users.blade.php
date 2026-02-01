@extends('vendor.layouts.main')

@push('title')
<title>Dashboard - Vendor</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="d-flex mb-3">
                        <h4>Users</h4>
                        <div class="ms-auto">
                            <a href="{{ route('vendor.users') }}" class="btn btn-dark btn-sm">Refresh</a>
                        </div>
                    </div>

                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address ?? '-' }}</td>
                                    <td>
                                        
                                        <form action="{{ route('vendor.user.delete', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>


@push('scripts')
<!-- DataTables JS (make sure you have included jQuery and DataTables library in layout) -->
<script>
    $(document).ready(function () {
        $('#datatablesSimple').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
        });
    });
</script>
@endpush

@endsection
