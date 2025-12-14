@extends('layout.masternosidebar')
@section('title', 'Logout')
@section('page_title', 'Logout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <div class="logout-page">

        {{-- Profile --}}
        <div class="profile-header">
            <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}"
                alt="Profile Photo" class="profile-avatar">

            <h2 class="profile-name">{{ auth()->user()->name }}</h2>
            <p class="profile-email">{{ auth()->user()->email }}</p>
        </div>

        {{-- Confirmation --}}
        <p class="logout-text">
            Are you sure you want to log out?
        </p>

        {{-- Logout Button --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout">
                Log Out
            </button>
        </form>

    </div>
@endsection
