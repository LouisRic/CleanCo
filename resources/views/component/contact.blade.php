@extends('layout.master')

@section('content')
    <div class="contact-section">

        <div class="contact-left">
            <div class="info-badge black-badge">
                {{ __('home.call_us') }}
            </div>

            <div class="qr-code-box">
                <img src="{{ asset('images/barcodes.png') }}" alt="QR Code" class="qr-code">
                <div class="qr-text">{{ __('contact.scan_me') }}</div>
            </div>

            <div class="phone-number">
                0825-4848-5766
            </div>
            <div class="phone-desc">
                {{ __('home.phone_desc') }}
            </div>
        </div>

        <div class="contact-right">
            <h2> {{ __('contact.best_services') }}</h2>
            <div class="line"></div>

            <div class="service-address">
                {{ __('contact.address') }}
            </div>

            <p class="service-desc">
                {{ __('contact.description') }}
            </p>

            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="bi bi-instagram"></i> Instagram
                </a>

                <a href="#" class="social-link">
                    <i class="bi bi-globe"></i> Website
                </a>
            </div>
        </div>

    </div>
@endsection
