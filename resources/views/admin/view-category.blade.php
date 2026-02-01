@extends('admin.layouts.main')
@push('title')
<title>Dashboard -admin</title>
@endpush

@section('content')
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    
            
        
                      <div class="row my-5">
                <div class="col-xl-lg-12 col-md-12">
                    <div class="d-flex">
                        <h4>View Category</h4>
                        <div class="ms-auto">
                            <a href="{{ route('admin.categories') }}" class="btn btn-dark btn-sm text-decoration-none">View All</a>
                        </div>
                    </div>

                    <div class="mt-3">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Category</th>
                                    <th>Commission (%)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->commission }}</td>
                                    <td>
                                        <a href="{{ url('admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ url('admin/delete-category/'.$category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-trash"></i>
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

                                    
                    </div>
                </main>
                

    @endsection
