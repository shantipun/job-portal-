@extends('user.layouts.main')

@push('title')
<title>Edit Profile - User</title>
@endpush

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <h1 class="my-4">Edit Profile</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-4">

                {{-- Profile Image --}}
                <div class="col-xl-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img
                                src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('dashboard/assets/img/review/user.png') }}"
                                class="rounded-circle mb-3"
                                style="width:140px; height:140px; object-fit:cover;"
                            >
                            <h5>{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Edit Form --}}
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Name --}}
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Password --}}
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <small class="text-muted">Leave blank to keep current password</small>
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Password Confirmation --}}
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                {{-- Role --}}
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" name="role" class="form-control" value="{{ old('role', $user->role) }}">
                                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Phone --}}
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Location --}}
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{ old('location', $user->location) }}">
                                    @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Skills --}}
                                <div class="mb-3">
                                    <label class="form-label">Skills</label>
                                    <input type="text" name="skills" class="form-control" value="{{ old('skills', $user->skills) }}">
                                    @error('skills') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- LinkedIn URL --}}
                                <div class="mb-3">
                                    <label class="form-label">LinkedIn URL</label>
                                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                    @error('linkedin_url') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Bio --}}
                                <div class="mb-3">
                                    <label class="form-label">Bio</label>
                                    <textarea name="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Profile Image --}}
                                <div class="mb-3">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control">
                                    @error('profile_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                {{-- Resume --}}
                                <div class="mb-3">
                                    <label class="form-label">Resume</label>
                                    <input type="file" name="resume" class="form-control">
                                    @if($user->resume)
                                        <a href="{{ asset('storage/'.$user->resume) }}" target="_blank" class="btn btn-sm btn-secondary mt-1">View Current Resume</a>
                                    @endif
                                    @error('resume') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

@endsection
