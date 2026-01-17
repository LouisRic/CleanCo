@extends('layout.masterCustomer')

@section('content')
<div class="container mt-3" id="voucherPage" data-user-points="{{ Auth::user()->points_balance ?? 0 }}">

    <h5 class="fw-bold mb-3">{{ __('voucher.my_vouchers') }}</h5>

    {{-- Available Vouchers --}}
    <h6 class="fw-semibold mb-2">{{ __('voucher.available_vouchers') }}</h6>

    @forelse ($availableVouchers as $voucher)
        @php
            $isPointsOnly = (bool)($voucher->points_only ?? false);
            $expiredAt = $voucher->expired_at ?? null;

            // ✅ FIX UTAMA: "alreadyRedeemedEver" hanya berlaku untuk points-only
            $alreadyRedeemedEver = $isPointsOnly ? (bool)($voucher->is_redeemed ?? false) : false;

            // canRedeem:
            $canRedeem = $isPointsOnly ? (bool)($voucher->can_redeem ?? false) : true;

            // id dikirim:
            $sendId = $isPointsOnly ? $voucher->voucher->id : $voucher->id;
        @endphp

        <div class="card shadow-sm border-0 mb-2">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                    <small class="text-muted">{{ __('voucher.code') }}: {{ $voucher->voucher->code }}</small><br>
                    <small class="text-muted">
                        {{ __('voucher.valid_until') }}: {{ $expiredAt?->format('d M Y') ?? '-' }}
                    </small>
                    @if ($voucher->voucher->points_required > 0)
                        <br><small class="text-info">
                            {{ __('voucher.requires_points', ['points' => $voucher->voucher->points_required]) }}
                        </small>
                    @endif
                </div>

                <div class="text-end">
                    <button type="button"
                        class="btn btn-primary btn-sm use-voucher-btn {{ $alreadyRedeemedEver ? 'btn-secondary' : 'btn-primary' }}"
                        data-id="{{ $sendId }}"
                        data-name="{{ $voucher->voucher->name }}"
                        data-points="{{ $voucher->voucher->points_required ?? 0 }}"
                        data-expired="{{ $expiredAt && $expiredAt < now() ? 1 : 0 }}"
                        {{ ($alreadyRedeemedEver || !$canRedeem) ? 'disabled' : '' }}>
                        {{ $alreadyRedeemedEver ? 'Redeemed' : 'Tukar' }}
                    </button>

                    @if($isPointsOnly && !$alreadyRedeemedEver && !$canRedeem)
                        <br><small class="text-danger">Poin kamu belum cukup</small>
                    @endif
                </div>
            </div>
        </div>

    @empty
        <div class="text-muted mt-2">
            {{ __('voucher.no_active_vouchers') }}
        </div>
    @endforelse

    {{-- Redeemed Vouchers --}}
    <h6 class="fw-semibold mt-4 mb-2">{{ __('voucher.used_redeemed') }}</h6>

    @forelse($redeemedVouchers as $voucher)
        @php
            $redeemCode = 'CV-' . str_pad($voucher->id, 6, '0', STR_PAD_LEFT);
        @endphp

        <div class="card shadow-sm border-0 mb-2">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                    <small class="text-muted">{{ __('voucher.code') }}: {{ $voucher->voucher->code }}</small><br>
                    <small class="text-muted">
                        {{ __('voucher.redeemed') }}: {{ $voucher->redeemed_at?->format('d M Y') }}
                    </small>
                    <br>
                    <small class="text-muted">
                        Code: <span class="fw-bold">{{ $redeemCode }}</span>
                    </small>
                </div>
                <span class="badge bg-secondary align-self-center">Redeemed</span>
            </div>
        </div>
    @empty
        <div class="text-muted mt-2">
            {{ __('voucher.no_redeemed_vouchers') }}
        </div>
    @endforelse

</div>

{{-- Modal Konfirmasi --}}
<div id="confirmModal"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:9999;">
    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
        <div class="bg-white p-4 rounded shadow" style="width: 400px;">
            <h5 class="mb-3">{{ __('voucher.confirm_voucher') }}</h5>
            <p id="modalText"></p>
            <div class="d-flex justify-content-end">
                <button id="cancelBtn" type="button" class="btn btn-secondary me-2">
                    {{ __('voucher.cancel') }}
                </button>
                <form id="confirmForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-success">{{ __('voucher.confirm') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
