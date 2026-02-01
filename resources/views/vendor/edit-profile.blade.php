@extends('vendor.layouts.main')

@push('title')
<title>Edit Profile - Vendor</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4 mt-4">

        <h2 class="mb-4">Edit Profile</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @php
            $vendor = Auth::user(); // get logged-in vendor dynamically
        @endphp

        <div class="card shadow-sm p-4">
            <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name & Email --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $vendor->name) }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $vendor->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Phone & Location --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $vendor->phone) }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $vendor->location) }}">
                        @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- Bio --}}
                <div class="mb-3">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="3">{{ old('bio', $vendor->bio) }}</textarea>
                    @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Profile Image --}}
                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                    @if($vendor->profile_image)
                        <img src="{{ asset('storage/'.$vendor->profile_image) }}" class="img-thumbnail mt-2" width="120">
                    @endif
                    @error('profile_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Password --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-success w-100">Update Profile</button>
            </form>
        </div>

    </div>
</main>
@endsection
