@extends('layout.masternosidebar')
@section('title', 'Profile')
@section('page_title', 'Profile')

@php
    $noSidebar = true;
@endphp
@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif
    {{-- Header --}}
    <div class="profile-header">
        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}"
            alt="Profile Photo" class="profile-avatar">

        <h2 class="profile-name">{{ auth()->user()->name }}</h2>
        <p class="profile-email">{{ auth()->user()->email }}</p>
    </div>

    <div class="profile-info-card">
        <div class="info-item">
            <span class="info-label">Name:</span>
            <span class="info-value">{{ auth()->user()->name ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Email:</span>
            <span class="info-value">{{ auth()->user()->email ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Address:</span>
            <span class="info-value">{{ auth()->user()->address ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Gender:</span>
            <span class="info-value">{{ ucfirst(auth()->user()->gender) ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Telephone:</span>
            <span class="info-value">{{ auth()->user()->telephone ?? '-' }}</span>
        </div>
    </div>

    {{-- Menu --}}
    <div class="profile-menu">

        <a href="{{ route('profile.edit') }}" class="profile-menu-item">
            <span class="profile-menu-left">📷 Edit Profile</span>
            <span class="profile-menu-arrow">›</span>
        </a>

        <a href="{{ route('profile.language') }}" class="profile-menu-item">
            <span class="profile-menu-left">🌐 Language</span>
            <span class="profile-menu-arrow">›</span>
        </a>

        <a href="{{ route('profile.logout') }}" class="profile-menu-item profile-logout-btn">
            <span class="profile-menu-left">➡️ Log Out</span>
            <span class="profile-menu-arrow">›</span>
        </a>

    </div>
@endsection
