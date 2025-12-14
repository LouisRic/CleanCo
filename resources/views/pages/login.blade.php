<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.login_title') }} - CleanCo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style-login.css') }}" rel="stylesheet">
</head>

<body>

    <div class="login-card">
        <h1 class="mb-2">{{ __('auth.login_title') }}</h1>
        <p class="welcome-text">{{ __('auth.welcome_back') }}</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger p-2 mb-3 small text-start">
                    {{ __('auth.error_message') }}
                </div>
            @endif

            <div class="mb-3">
                <input type="email" name="email"
                    class="form-control custom-login-input @error('email') is-invalid @enderror"
                    placeholder="{{ __('auth.email') }}"
                    required value="{{ old('email') }}">

                @error('email')
                    <div class="invalid-feedback text-start ms-4">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password"
                    class="form-control custom-login-input @error('password') is-invalid @enderror"
                    placeholder="{{ __('auth.password') }}"
                    required>

                @error('password')
                    <div class="invalid-feedback text-start ms-4">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('auth.remember_me') }}
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-custom-login">
                {{ __('auth.login_button') }}
            </button>
        </form>

        <div class="mt-4">
            <span class="text-muted">{{ __('auth.no_account') }}</span>
            <a href="{{ route('register') }}"
               class="text-decoration-none fw-bold"
               style="color: #0d6efd;">
                {{ __('auth.register_here') }}
            </a>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}"
               class="inline-block px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                ⬅ {{ __('auth.back_home') }}
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
