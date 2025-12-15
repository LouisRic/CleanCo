@extends('admin.layout.master')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="edit-profile-container">

        {{-- Top Bar --}}
        <div class="edit-topbar">
            <h2>Edit Profile</h2>
        </div>

        {{-- Card --}}
        <div class="edit-card">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Avatar --}}
                <div class="avatar-wrapper">
                    <label for="photo">
                        <img id="avatarPreview"
                            src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}"
                            class="avatar">
                        <span class="edit-avatar">Change</span>
                    </label>
                    <input type="file" name="photo" id="photo" hidden onchange="previewAvatar(event)">
                </div>

                {{-- Fields --}}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ auth()->user()->address }}">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" name="telephone" value="{{ auth()->user()->telephone }}">
                </div>

                {{-- Actions --}}
                <div class="button-row">
                    <a href="{{ route('profile.edit-password') }}" class="btn-password">
                        🔒 Change Password
                    </a>
                    <button type="submit" class="btn-save">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection
