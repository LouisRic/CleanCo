<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.register_title') }} - CleanCo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style-register.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">

            <div class="col-md-6 d-none d-md-block bg-image"></div>

            <div class="col-md-6 bg-form">
                <div class="form-container">
                    <h2 class="text-center mb-4">
                        {{ __('auth.register_title') }}
                    </h2>
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name"
                                class="form-control custom-input @error('name') is-invalid @enderror"
                                placeholder="{{ __('auth.name') }}"
                                value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email"
                                class="form-control custom-input @error('email') is-invalid @enderror"
                                placeholder="{{ __('auth.email') }}"
                                value="{{ old('email') }}" required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="address"
                                class="form-control custom-input @error('address') is-invalid @enderror"
                                placeholder="{{ __('auth.address') }}"
                                value="{{ old('address') }}">

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('auth.gender') }}</label>

                            <div class="custom-radio-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="genderMale" value="male"
                                        {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderMale">
                                        {{ __('auth.male') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="genderFemale" value="female"
                                        {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="genderFemale">
                                        {{ __('auth.female') }}
                                    </label>
                                </div>
                            </div>

                            @error('gender')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text" name="telephone"
                                class="form-control custom-input @error('telephone') is-invalid @enderror"
                                placeholder="{{ __('auth.telephone') }}"
                                value="{{ old('telephone') }}">

                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password"
                                class="form-control custom-input @error('password') is-invalid @enderror"
                                placeholder="{{ __('auth.password') }}" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password_confirmation"
                                class="form-control custom-input"
                                placeholder="{{ __('auth.confirm_password') }}" required>
                        </div>

                        <div class="text-center text-md-end mb-3">
                            <button type="submit" class="btn btn-orange">
                                {{ __('auth.register_button') }}
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <span class="text-muted">
                                {{ __('auth.already_have_account') }}
                            </span>
                            <a href="{{ route('login') }}"
                               class="text-decoration-none fw-bold"
                               style="color: #0d6efd;">
                                {{ __('auth.login') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
