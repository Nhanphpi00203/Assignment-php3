@extends('client.layouts.master')

@section('content')

<div class="min-vh-100 py-5" style="background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);">
    <div class="container" style="max-width: 720px;">

        <!-- Avatar & Header -->
        <div class="text-center mb-5">
            <div class="position-relative d-inline-block">
                <img src="{{ asset('images/profile-avatar.png') }}" alt="Profile" class="rounded-circle shadow-lg border border-4 border-white" width="110" height="110">
                <span class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                    <i class="bi bi-camera-fill text-white"></i>
                </span>
            </div>
            <h2 class="fw-bold text-dark mt-3 mb-1">Your Profile</h2>
            <p class="text-muted fs-6">Manage your personal information and account settings</p>
        </div>

        <!-- Profile Info -->
        <div class="card shadow border-0 rounded-4 mb-4 hover-card">
            <div class="card-body p-4">

                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="card shadow border-0 rounded-4 mb-4 hover-card">
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card shadow border-0 rounded-4 hover-card">
            <div class="card-body p-4 text-center">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>

<!-- Custom Hover Effect -->
<style>
    .hover-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hover-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08) !important;
    }

</style>

@endsection
