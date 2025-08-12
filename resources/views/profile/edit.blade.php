@extends('client.layouts.master')

@section('content')

<div class="bg-gradient min-vh-100 py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);">
	<div class="container" style="max-width: 600px;">

		<div class="text-center mb-5">
			<img src="{{ asset('images/profile-avatar.png') }}" alt="Profile" class="rounded-circle shadow" width="90" height="90">
			<h2 class="fw-bold text-primary mt-3">Profile</h2>
			<p class="text-muted">Manage your account settings and personal information</p>
		</div>

		<div class="card shadow-lg rounded-4 mb-4 border-0">
			<div class="card-body">
				<h5 class="card-title mb-3 text-primary"><i class="bi bi-person"></i> Profile Information</h5>
				<p class="text-muted mb-4">Update your account's profile information and email address.</p>
				@include('profile.partials.update-profile-information-form')
			</div>
		</div>

		<div class="card shadow-lg rounded-4 mb-4 border-0">
			<div class="card-body">
				<h5 class="card-title mb-3 text-primary"><i class="bi bi-shield-lock"></i> Update Password</h5>
				<p class="text-muted mb-4">Ensure your account is using a long, random password to stay secure.</p>
				@include('profile.partials.update-password-form')
			</div>
		</div>

		<div class="card shadow-lg rounded-4 border-0">
			<div class="card-body text-center">
				<h5 class="card-title mb-3 text-danger"><i class="bi bi-trash"></i> Delete Account</h5>
				<p class="text-muted mb-4">Permanently delete your account and all associated data.</p>
				@include('profile.partials.delete-user-form')
			</div>
		</div>

	</div>
</div>

@endsection
