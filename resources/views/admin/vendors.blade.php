@extends('admin.layouts.main')
@push('title')
<title>Dashboard -admin</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <div class="row my-5">
                <div class="col-xl-12 col-md-12">
                    <div class="d-flex">
                        <h4>Vendors</h4>
                        <div class="ms-auto">
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-dark btn-sm text-decoration-none">View All</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <table class="table" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Vendor Name</th>
                              
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vendor->name }}</td>
                             
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->location ?? '-' }}</td>
                                    <td>
                                        @if($vendor->status)
                                            <span class="badge rounded-pill text-bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($vendor->status)
                                            <a href="{{ route('admin.users.block', $vendor->id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></a>
                                        @else
                                            <a href="{{ route('admin.users.unblock', $vendor->id) }}" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                                    
                    </div>
                </main>
                

    @endsection
