@extends('layout.masternosidebar')
@section('title', __('profile_logout.title'))
@section('page_title', __('profile_logout.title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="logout-page">

        {{-- Profile --}}
        <div class="profile-header">
            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}"
                alt="{{ __('profile_logout.profile_photo_alt') }}" class="profile-avatar">

            <h2 class="profile-name">{{ auth()->user()->name }}</h2>
            <p class="profile-email">{{ auth()->user()->email }}</p>
        </div>

        {{-- Confirmation --}}
        <p class="logout-text">
            {{ __('profile_logout.confirmation') }}
        </p>

        {{-- Logout Button --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout">
                {{ __('profile_logout.logout_button') }}
            </button>
        </form>

    </div>
@endsection
