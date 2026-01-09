@extends('layout.masternosidebar')
@section('title', 'Language')
@section('page_title', 'Language Settings')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    {{-- Background blur: profil user --}}
    <div class="profile-info-card blur-bg">
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

    {{-- Pilihan bahasa di tengah layar --}}
    <div class="language-modal">
        <h3>Select Language</h3>
        <a href="#" class="lang-btn">English</a>
        <a href="#" class="lang-btn">Bahasa Indonesia</a>
        <a href="{{ route('profile.show') }}" class="close-modal">Back</a>
    </div>
@endsection
