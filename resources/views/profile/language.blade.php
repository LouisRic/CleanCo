@extends('layout.masternosidebar')
@section('title', __('profile_language.title'))
@section('page_title', __('profile_language.page_title'))

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    {{-- Background blur: profil user --}}
    <div class="profile-info-card blur-bg">
        <div class="info-item">
            <span class="info-label">{{ __('profile_language.name_label') }}</span>
            <span class="info-value">{{ auth()->user()->name ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">{{ __('profile_language.email_label') }}</span>
            <span class="info-value">{{ auth()->user()->email ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">{{ __('profile_language.address_label') }}</span>
            <span class="info-value">{{ auth()->user()->address ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">{{ __('profile_language.gender_label') }}</span>
            <span class="info-value">{{ ucfirst(auth()->user()->gender) ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">{{ __('profile_language.telephone_label') }}</span>
            <span class="info-value">{{ auth()->user()->telephone ?? '-' }}</span>
        </div>
    </div>

    {{-- Pilihan bahasa di tengah layar --}}
    <div class="language-modal">
        <h3>{{ __('profile_language.select_language') }}</h3>
        <a href="{{ route('change.lang', 'en') }}" class="lang-btn">{{ __('profile_language.english') }}</a>
        <a href="{{ route('change.lang', 'id') }}" class="lang-btn">{{ __('profile_language.indonesian') }}</a>
        <a href="{{ route('profile.show') }}" class="close-modal">{{ __('profile_language.back') }}</a>
    </div>
@endsection
