@extends('layout.masternosidebar')
@section('title', 'Change Password')
@section('page_title', 'Change Password')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="edit-profile-container">

        <div class="edit-topbar">
            <h2>Change Your Password Here!</h2>
        </div>

        <div class="edit-card">
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password">
                    @error('current_password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password">
                    @error('new_password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation">
                </div>

                <button type="submit" class="btn-update-password">Update Password</button>
            </form>

        </div>
    </div>
@endsection
