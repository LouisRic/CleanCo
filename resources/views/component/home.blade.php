    <section class="hero-section">
        <div class="container hero-container">
            <div class="hero-left">

                <div class="hero-image-wrap">
                    <div class="blue-bg"></div>
                    <img src="{{ asset('images/portrait-energetic-positive-cute-female-looking-directly-camera-with-happiness 1.svg') }}"
                        class="hero-woman" />
                    <div class="badge-wrapper">
                        <div class="hero-badge badge-1">
                            <div class="badge-circle">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            {{ __('home.badge_open') }}
                        </div>

                        <div class="hero-badge badge-2">
                            <div class="badge-circle">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            {{ __('home.badge_safe') }}
                        </div>

                        <div class="hero-badge badge-3">
                            <div class="badge-circle">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            {{ __('home.badge_member') }}
                        </div>
                    </div>

                    <div class="white-gradient-cover"></div>
                </div>

            </div>
            <div class="hero-right">
                <h1>{!! __('home.hero_title') !!}</h1>
                <p class="mx-auto mx-lg-0">
                    {{ __('home.hero_description') }}
                </p>

                <div class="hero-buttons">
                    @guest
                        <!-- User belum login -->
                        <a href="{{ route('register') }}">
                            <button class="btn-black">{{ __('home.btn_get_started') }}</button>
                        </a>
                    @else
                        <!-- User sudah login -->
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <button class="btn-black">{{ __('home.btn_get_started') }}</button>
                            </a>
                        @else
                            <a href="{{ route('customer.dashboard') }}">
                                <button class="btn-black">{{ __('home.btn_get_started') }}</button>
                            </a>
                        @endif
                    @endguest

                    <a href="#services" class="btn-grey" style="text-decoration:none; display:inline-block;">
                        {{ __('home.btn_learn_more') }}
                    </a>
                </div>
            </div>

        </div>
    </section>
