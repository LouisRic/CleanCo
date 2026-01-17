@extends('layout.masterCustomer')

@section('content')
    <div class="container mt-3" id="voucherPage" data-user-points="{{ Auth::user()->points_balance ?? 0 }}">

        <h5 class="fw-bold mb-3">{{ __('voucher.my_vouchers') }}</h5>

        {{-- Available Vouchers --}}
        <h6 class="fw-semibold mb-2">{{ __('voucher.available_vouchers') }}</h6>
        @forelse ($availableVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                        <small class="text-muted">Kode: {{ $voucher->voucher->code }}</small><br>
                        <small class="text-info">
                            Memerlukan {{ $voucher->voucher->points_required }} poin
                        </small>
                    </div>
                    <div class="text-end">
                        <form action="{{ route('customer.voucher.use', $voucher->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                Gunakan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-muted mt-2">Tidak ada voucher aktif</div>
        @endforelse

        {{-- Redeemed Vouchers --}}
        <h6 class="fw-semibold mt-4 mb-2">{{ __('voucher.used_redeemed') }}</h6>
        @forelse($redeemedVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                        <small class="text-muted">{{ __('voucher.code') }}: {{ $voucher->voucher->code }}</small><br>
                        <small class="text-muted">
                            {{ __('voucher.redeemed') }}: {{ $voucher->redeemed_at?->format('d M Y') }}
                        </small>
                    </div>
                    <span class="badge bg-secondary align-self-center">{{ __('voucher.used') }}</span>
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
        class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center">
        <div class="bg-white p-4 rounded shadow" style="width: 400px;">
            <h5 class="mb-3">{{ __('voucher.confirm_voucher') }}</h5>
            <p id="modalText"></p>
            <div class="d-flex justify-content-end">
                <button id="cancelBtn" class="btn btn-secondary me-2">{{ __('voucher.cancel') }}</button>
                <form id="confirmForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-success">{{ __('voucher.confirm') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Load JS khusus voucher --}}
    <script src="{{ asset('js/voucher.js') }}"></script>
@endsection
