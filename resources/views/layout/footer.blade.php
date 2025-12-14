<footer class="footer">
    <div class="container">
        <div class="row mb-3">

            {{-- About --}}
            <div class="col-lg-4 mb-2">
                <h5>{{ __('footer.about_title') }}</h5>
                <p style="text-align: left; font-weight: 200;">
                    {{ __('footer.about_desc') }}
                </p>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-4 mb-4">
                <h5>{{ __('footer.quick_links') }}</h5>
                <ul style="list-style: none; padding-left: 0;">
                    <li><a href="{{ route('home') }}">{{ __('footer.home') }}</a></li>
                    <li><a href="{{ route('service') }}">{{ __('footer.services') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('footer.contact') }}</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 mb-4">
                <h5>{{ __('footer.contact_info') }}</h5>
                <p>📍 {{ __('footer.address') }}</p>
                <p>📞 {{ __('footer.phone') }}</p>
                <div class="d-flex gap-3">
                    <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
                    <a href="#"><i class="bi bi-linkedin"></i> LinkedIn</a>
                </div>
            </div>

        </div>

        <hr>
        <p class="text-center">
            {{ __('footer.copyright') }}
        </p>
    </div>
</footer>
