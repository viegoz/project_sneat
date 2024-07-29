@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Profile</h5>
            </div>
            <div class="card-body text-center">
                <div class="profile-avatar mb-4">
                    <img src="{{ asset(Auth::user()->profile_picture ? 'storage/' . Auth::user()->profile_picture : 'assets/img/avatars/1.png') }}" alt="Profile Picture" class="w-px-150 h-auto rounded-circle">
                </div>
                <div class="profile-details">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Update Profile Picture</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Picture</button>
                </form>
            </div>
        </div>
    </div>
@endsection
