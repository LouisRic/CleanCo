@extends('layout.masternosidebar')
@section('title', __('profile_password.title'))
@section('page_title', __('profile_password.title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="edit-profile-container">

        <div class="edit-topbar">
            <h2>{{ __('profile_password.heading') }}</h2>
        </div>

        <div class="edit-card">
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>{{ __('profile_password.current_password') }}</label>
                    <input type="password" name="current_password">
                    @error('current_password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('profile_password.new_password') }}</label>
                    <input type="password" name="new_password">
                    @error('new_password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('profile_password.confirm_new_password') }}</label>
                    <input type="password" name="new_password_confirmation">
                </div>

                <button type="submit" class="btn-update-password">{{ __('profile_password.update_password') }}</button>
            </form>

        </div>
    </div>
@endsection
