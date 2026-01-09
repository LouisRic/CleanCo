@extends('layout.masterCustomer')

@section('content')
    <div class="container mt-3" id="voucherPage" data-user-points="{{ Auth::user()->points_balance ?? 0 }}">

        <h5 class="fw-bold mb-3">My Vouchers</h5>

        {{-- Available Vouchers --}}
        <h6 class="fw-semibold mb-2">Available Vouchers</h6>
        @forelse ($availableVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                        <small class="text-muted">Code: {{ $voucher->voucher->code }}</small><br>
                        <small class="text-muted">
                            Valid until: {{ $voucher->expires_at?->format('d M Y') ?? '-' }}
                        </small>
                        @if ($voucher->voucher->points_required > 0)
                            <br><small class="text-info">Requires {{ $voucher->voucher->points_required }} points</small>
                        @endif
                    </div>

                    <div class="text-end">
                        <span class="badge bg-success mb-2">Not Used</span><br>
                        <button type="button" class="btn btn-primary btn-sm use-voucher-btn"
                            data-id="{{ $voucher->voucher->id }}" data-name="{{ $voucher->voucher->name }}"
                            data-points="{{ $voucher->voucher->points_required ?? 0 }}"
                            data-expired="{{ $voucher->expires_at && $voucher->expires_at < now() ? 1 : 0 }}">
                            Use Voucher
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-muted mt-2">
                No active vouchers
            </div>
        @endforelse

        {{-- Redeemed Vouchers --}}
        <h6 class="fw-semibold mt-4 mb-2">Used / Redeemed</h6>
        @forelse($redeemedVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>
                        <small class="text-muted">Code: {{ $voucher->voucher->code }}</small><br>
                        <small class="text-muted">
                            Redeemed: {{ $voucher->redeemed_at?->format('d M Y') }}
                        </small>
                    </div>
                    <span class="badge bg-secondary align-self-center">Used</span>
                </div>
            </div>
        @empty
            <div class="text-muted mt-2">
                No redeemed vouchers
            </div>
        @endforelse

    </div>

    {{-- Modal Konfirmasi --}}
    <div id="confirmModal"
        class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center">
        <div class="bg-white p-4 rounded shadow" style="width: 400px;">
            <h5 class="mb-3">Confirm Voucher</h5>
            <p id="modalText"></p>
            <div class="d-flex justify-content-end">
                <button id="cancelBtn" class="btn btn-secondary me-2">Cancel</button>
                <form id="confirmForm" method="POST" action="">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Load JS khusus voucher --}}
    <script src="{{ asset('js/voucher.js') }}"></script>
@endsection
