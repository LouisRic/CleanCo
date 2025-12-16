@php
    $couponCount = $couponCount ?? (Auth::check() ? Auth::user()->customerVouchers()->where('is_redeemed', false)->count() : 0);
    $pointsBalance = $pointsBalance ?? (Auth::check() ? Auth::user()->points_balance : 0);
@endphp

<div class="coupon-info-bar mb-3">
    <div class="d-flex justify-content-between align-items-center p-3 bg-white rounded shadow-sm">
        <div class="d-flex align-items-center gap-3">
            <div class="coupon-icon-wrapper">
                <i class="bi bi-ticket coupon-icon"></i>
            </div>
            <div>
                <span class="coupon-label">Coupon</span>
                <span class="coupon-count">{{ $couponCount }}</span>
            </div>

            <a href="{{ route('customer.vouchers') }}" class="btn btn-sm btn-outline-primary ms-3">
                Voucher
            </a>
        </div>

        <div class="points-display">
            <span class="points-text">{{ $pointsBalance }} points</span>
        </div>
    </div>
</div>


