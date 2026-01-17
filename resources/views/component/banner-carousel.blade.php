<div class="promo-carousel-wrapper">
    <div id="promoCarousel" class="carousel slide promo-carousel-container" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            {{-- Slide 1 --}}
            <div class="carousel-item active">
                <div class="promo-banner promo-banner-yellow">
                    {{-- <img src="{{ asset('img/carousel-1.png') }}" alt="Promo 1" class="promo-carousel-image"> --}}
                    <!-- Hapus aja kalau nanti mau ganti gambar -->
                    <div class="promo-content">
                        <div class="promo-circle">
                            <div class="promo-circle-inner">
                                <span class="promo-big-text">{!! __('component_banner.big_sale') !!}</span>
                            </div>
                        </div>
                        <div class="promo-ribbon">
                            {{ __('component_banner.every_friday') }}
                        </div>
                        <div class="promo-discount-badge">
                            <span class="discount-text-top">{{ __('component_banner.up_to') }}</span>
                            <span class="discount-text-bottom">70%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="carousel-item">
                <div class="promo-banner promo-banner-yellow">
                    {{-- <img src="{{ asset('img/carousel-2.png') }}" alt="Promo 2" class="promo-carousel-image"> --}}
                    <!-- Hapus aja kalau nanti mau ganti gambar -->
                    <div class="promo-content">
                        <div class="promo-circle">
                            <div class="promo-circle-inner">
                                <span class="promo-big-text">{!! __('component_banner.new_user') !!}</span>
                            </div>
                        </div>
                        <div class="promo-ribbon">
                            {{ __('component_banner.first_order') }}
                        </div>
                        <div class="promo-discount-badge">
                            <span class="discount-text-top">{{ __('component_banner.up_to') }}</span>
                            <span class="discount-text-bottom">50%</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="carousel-item">
                <div class="promo-banner promo-banner-yellow">
                    {{-- <img src="{{ asset('img/carousel-3.png') }}" alt="Promo 3" class="promo-carousel-image"> --}}
                    <!-- Hapus aja kalau nanti mau ganti gambar -->
                    <div class="promo-content">
                        <div class="promo-circle">
                            <div class="promo-circle-inner">
                                <span class="promo-big-text">{!! __('component_banner.weekend') !!}</span>
                            </div>
                        </div>
                        <div class="promo-ribbon">
                            {{ __('component_banner.saturday_sunday') }}
                        </div>
                        <div class="promo-discount-badge">
                            <span class="discount-text-top">{{ __('component_banner.up_to') }}</span>
                            <span class="discount-text-bottom">60%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon promo-arrow-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('component_banner.previous') }}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon promo-arrow-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{{ __('component_banner.next') }}</span>
        </button>
    </div>
</div>
