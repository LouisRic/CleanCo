@extends('layout.masternosidebar')
@section('title', __('profile_edit.title'))
@section('page_title', __('profile_edit.page_title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="edit-profile-container">

        {{-- Top Bar --}}
        <div class="edit-topbar">
            <h2>{{ __('profile_edit.edit_profile') }}</h2>
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
                        <span class="edit-avatar">{{ __('profile_edit.change_avatar') }}</span>
                    </label>
                    <input type="file" name="photo" id="photo" hidden onchange="previewAvatar(event)">
                </div>

                {{-- Fields --}}
                <div class="form-group">
                    <label>{{ __('profile_edit.name') }}</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}">
                </div>

                <div class="form-group">
                    <label>{{ __('profile_edit.email') }}</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}">
                </div>

                <div class="form-group">
                    <label>{{ __('profile_edit.address') }}</label>
                    <input type="text" name="address" value="{{ auth()->user()->address }}">
                </div>

                <div class="form-group">
                    <label>{{ __('profile_edit.gender') }}</label>
                    <select name="gender">
                        <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>{{ __('profile_edit.male') }}</option>
                        <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>{{ __('profile_edit.female') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>{{ __('profile_edit.telephone') }}</label>
                    <input type="text" name="telephone" value="{{ auth()->user()->telephone }}">
                </div>

                {{-- Actions --}}
                <div class="button-row">
                    <a href="{{ route('profile.edit-password') }}" class="btn-password">
                        {{ __('profile_edit.change_password') }}
                    </a>
                    <button type="submit" class="btn-save">{{ __('profile_edit.save') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
