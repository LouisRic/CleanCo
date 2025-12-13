@extends('layout.master')

@section('content')
    <div class="contact-section">

        <div class="contact-left">
            <div class="info-badge black-badge">
                PLEASE CALL US AT
            </div>

            <div class="qr-code-box">
                <img src="{{ asset('images/barcodes.png') }}" alt="QR Code" class="qr-code">
                <div class="qr-text">SCAN ME</div>
            </div>

            <div class="phone-number">
                0825-4848-5766
            </div>
            <div class="phone-desc">
                Scan here! Contact us here!
            </div>
        </div>

        <div class="contact-right">
            <h2>BEST SERVICES</h2>
            <div class="line"></div>

            <div class="service-address">
                123 Cleanhouse Jakarta Barat
            </div>

            <p class="service-desc">
                We provide fast, reliable, and quality laundry services for your convenience.
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
