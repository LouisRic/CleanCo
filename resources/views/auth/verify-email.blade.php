<!DOCTYPE html>
<html>

<head>
    <title>{{ __('auth_verify_email.title') }}</title>
</head>

<body>
    <h1>{{ __('auth_verify_email.heading') }}</h1>

    <p>
        {{ __('auth_verify_email.message') }}
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">{{ __('auth_verify_email.resend') }}</button>
    </form>
</body>

</html>
