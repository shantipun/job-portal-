@extends('admin.layouts.main')

@push('title')
<title>Edit Admin Profile | Admin Panel</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h2 class="fw-bold my-4">Edit Profile</h2>
            <p class="text-muted mb-4">Update your account information below.</p>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Using POST, no @method('PUT') -->

                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $admin->name) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{ old('email', $admin->email) }}" required>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <small class="text-muted">(leave blank to keep current)</small></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>

                            <!-- Profile Image -->
                            <div class="col-md-6">
                                <label for="profile_image" class="form-label">Profile Photo</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                                @if($admin->profile_image)
                                    <img src="{{ asset('storage/' . $admin->profile_image) }}" 
                                         alt="Profile Photo" class="img-thumbnail mt-2" width="100">
                                @endif
                            </div>

                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
