@extends('layout.masterCustomer')

@section('content')
    <div class="container mt-3">

        <h5 class="fw-bold mb-3">My Vouchers</h5>

        <h6 class="fw-semibold mb-2">Available Vouchers</h6>

        @forelse($availableVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">

                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>

                        <small class="text-muted">
                            Code: {{ $voucher->voucher->code }}
                        </small><br>

                        <small class="text-muted">
                            Valid until: {{ $voucher->expires_at?->format('d M Y') ?? '-' }}
                        </small>
                    </div>

                    <div class="text-end">

                        <span class="badge bg-success mb-2">Not Used</span>
                        <br>

                        <button type="button" class="btn btn-primary btn-sm use-voucher-btn" data-id="{{ $voucher->id }}"
                            data-name="{{ $voucher->voucher->name }}" data-points="{{ $voucher->voucher->points_required }}"
                            data-expired="{{ $voucher->expires_at && $voucher->expires_at->isPast() ? 1 : 0 }}">
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

        <h6 class="fw-semibold mt-4 mb-2">Used / Redeemed</h6>

        @forelse($redeemedVouchers as $voucher)
            <div class="card shadow-sm border-0 mb-2">
                <div class="card-body d-flex justify-content-between">

                    <div>
                        <div class="fw-bold">{{ $voucher->voucher->name }}</div>

                        <small class="text-muted">
                            Code: {{ $voucher->voucher->code }}
                        </small><br>

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

    <!-- Modal Konfirmasi -->
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

    <script>
        const modal = document.getElementById('confirmModal');
        const modalText = document.getElementById('modalText');
        const confirmForm = document.getElementById('confirmForm');
        const cancelBtn = document.getElementById('cancelBtn');

        document.querySelectorAll('.use-voucher-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const points = parseInt(btn.dataset.points);
                const expired = parseInt(btn.dataset.expired);

                // Cek expired
                if (expired) {
                    alert("Voucher sudah kadaluarsa!");
                    return;
                }

                // Cek points
                const userPoints = {{ Auth::user()->points_balance }};
                if (points > 0 && points > userPoints) {
                    alert("Points tidak cukup untuk redeem voucher ini!");
                    return;
                }

                modalText.textContent =
                    `Are you sure you want to use voucher "${name}"${points > 0 ? ' (costs ' + points + ' points)' : ''}?`;
                confirmForm.action = `/customer/voucher/use/${id}`;
                modal.classList.remove('d-none');
            });
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('d-none');
        });
    </script>
@endsection
