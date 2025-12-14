<section class="services-section" id="services">
    <div class="container text-center">
        <h2 class="services-title">
            {{ __('home.title') }}
        </h2>

        <div class="services-cards">
            <div class="service-card">
                <img src="{{ asset('images/Rectangle 7.png') }}" class="service-img">
                <div class="service-label">
                   {{ __('home.fast_laundry') }}
                    <span class="service-badge">{{ __('home.only_2_days') }}</span>
                </div>
            </div>

            <div class="service-card">
                <img src="{{ asset('images/Rectangle 9.png') }}" class="service-img">
                <div class="service-label">
                    {{ __('home.regular_laundry') }}
                    <span class="service-badge">{{ __('home.only_3_days') }}</span>
                </div>
            </div>

            <div class="service-card">
                <img src="{{ asset('images/Rectangle 10.png') }}" class="service-img">
                <div class="service-label">
                    {{ __('home.premium_laundry') }}
                    <span class="service-badge"> {{ __('home.only_1_day') }}</span>
                </div>
            </div>
        </div>

        <div class="services-icons">
            <div class="icon-item">
                <img src="{{ asset('images/Cleaning.svg') }}">
                <div class="icon-text">
                    <h4>{{ __('home.cleaning_title') }}</h4>
                    <p>{{ __('home.cleaning_desc') }}</p>
                </div>
            </div>

            <div class="icon-item">
                <img src="{{ asset('images/Dry.svg') }}">
                <div class="icon-text">
                   <h4>{{ __('home.dry_title') }}</h4>
                    <p>{{ __('home.dry_desc') }}</p>
                </div>    
            </div>

            <div class="icon-item">
                <img src="{{ asset('images/Iron.svg') }}">
                <div class="icon-text">
                    <h4>{{ __('home.iron_title') }}</h4>
                    <p>{{ __('home.iron_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
