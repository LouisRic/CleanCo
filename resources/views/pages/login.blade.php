<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CleanCo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style-login.css') }}" rel="stylesheet">
</head>

<body>

    <div class="login-card">
        <h1 class="mb-2">Login</h1>
        <p class="welcome-text">Welcome Back to CleanCo!</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger p-2 mb-3 small text-start">
                Email or password is wrong!
            </div>
            @endif

            <div class="mb-3">
                <input type="email" name="email" class="form-control custom-login-input @error('email') is-invalid @enderror"
                    placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback text-start ms-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control custom-login-input @error('password') is-invalid @enderror"
                    placeholder="Password" required>
                @error('password')
                <div class="invalid-feedback text-start ms-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-custom-login">Login</button>
        </form>

        <div class="mt-4">
            <span class="text-muted">Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #0d6efd;">Register Here</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>