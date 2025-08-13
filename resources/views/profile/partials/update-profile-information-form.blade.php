<section class="mb-4">
    <header class="mb-3">
        <h2 class="h5 text-primary">
            <i class="bi bi-person-circle"></i> {{ __('Profile Information') }}
        </h2>
        <p class="text-muted small">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Resend verification form -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update profile form -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-warning mb-2">
                        {{ __('Your email address is unverified.') }}
                    </p>
                    <button form="send-verification" type="submit" class="btn btn-link p-0 small">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success mt-2">
                            <i class="bi bi-check-circle"></i> {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save button -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small ms-2">
                    <i class="bi bi-check-circle"></i> {{ __('Saved.') }}
                </span>
            @endif
        </div>
    </form>
</section>
